import argparse
import asyncio
import json
import logging
from pathlib import Path
from typing import Dict, Set

from aiohttp import web

from p2p_node import P2PNode

logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s [%(levelname)s] %(name)s: %(message)s",
)
logger = logging.getLogger("P2P")

ROOT_DIR = Path(__file__).parent
STATIC_DIR = ROOT_DIR / "static"


async def main() -> None:
    parser = argparse.ArgumentParser(description="P2P chat with local web UI.")
    parser.add_argument("--host", default="0.0.0.0", help="Host to bind P2P listener.")
    parser.add_argument("--port", type=int, required=True, help="Port to bind P2P listener.")
    parser.add_argument("--web-host", default="127.0.0.1", help="Host for local web UI.")
    parser.add_argument("--web-port", type=int, default=8000, help="Port for local web UI.")
    parser.add_argument(
        "--connect",
        action="append",
        default=[],
        help="Remote peer in host:port format (can be repeated).",
    )
    args = parser.parse_args()

    # State
    ws_clients: Set[web.WebSocketResponse] = set()

    async def handle_message(peer_id: str, payload: Dict) -> None:
        msg = payload.get("message", "")
        name = payload.get("display_name") or None
        for ws in set(ws_clients):
            try:
                await ws.send_json(
                    {
                        "type": "peer_message",
                        "from": peer_id,
                        "from_name": name,
                        "message": msg,
                    }
                )
            except Exception:
                ws_clients.discard(ws)

    node = P2PNode(args.host, args.port, on_message=handle_message)
    await node.start()

    # Connect to provided peers
    for target in args.connect:
        if ":" not in target:
            logger.warning("Skipping invalid peer address: %s", target)
            continue
        host, port_str = target.split(":", 1)
        try:
            port = int(port_str)
        except ValueError:
            logger.warning("Skipping invalid port: %s", target)
            continue
        await node.connect(host, port)

    app = web.Application()

    async def index_handler(request: web.Request) -> web.Response:
        return web.FileResponse(STATIC_DIR / "index.html")

    async def ws_handler(request: web.Request) -> web.WebSocketResponse:
        ws = web.WebSocketResponse()
        await ws.prepare(request)
        ws_clients.add(ws)
        await ws.send_json({"type": "info", "port": args.port, "public_key": node.public_key_b64})
        await ws.send_json({"type": "status", "status": "Connected to local peer"})

        async for msg in ws:
            if msg.type == web.WSMsgType.TEXT:
                try:
                    data = json.loads(msg.data)
                except json.JSONDecodeError:
                    await ws.send_json({"type": "status", "status": "Invalid JSON"})
                    continue

                action = data.get("action")
                if action == "connect_peer":
                    ip = data.get("ip")
                    port = data.get("port")
                    try:
                        await node.connect(ip, int(port))
                        await ws.send_json({"type": "status", "status": f"Connected to {ip}:{port}"})
                    except Exception as exc:
                        await ws.send_json({"type": "status", "status": f"Failed: {exc}"})
                elif action == "send_message":
                    text = data.get("message", "")
                    display_name = data.get("display_name") or ""
                    payload = {"message": text, "display_name": display_name}
                    try:
                        await node.broadcast(payload)
                    except Exception as exc:
                        await ws.send_json({"type": "status", "status": f"Failed: {exc}"})
                else:
                    await ws.send_json({"type": "status", "status": "Unknown action"})
            elif msg.type == web.WSMsgType.ERROR:
                logger.warning("WebSocket error: %s", ws.exception())

        ws_clients.discard(ws)
        return ws

    app.router.add_get("/", index_handler)
    app.router.add_get("/ws", ws_handler)
    app.router.add_static("/static", str(STATIC_DIR))

    runner = web.AppRunner(app)
    await runner.setup()
    site = web.TCPSite(runner, args.web_host, args.web_port)
    await site.start()
    logger.info("Web UI available at http://%s:%s", args.web_host, args.web_port)

    try:
        while True:
            await asyncio.sleep(3600)
    except KeyboardInterrupt:
        logger.info("Shutting down...")
    finally:
        await node.stop()
        await runner.cleanup()


if __name__ == "__main__":
    asyncio.run(main())

