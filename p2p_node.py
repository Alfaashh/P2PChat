import asyncio
import json
import logging
from typing import Awaitable, Callable, Dict, Optional

import json as _json
import time as _time
from crypto_utils import (
    derive_shared_key,
    encrypt_payload,
    decrypt_payload,
    generate_x25519_keypair,
    public_key_to_base64,
    public_key_from_base64,
)

logger = logging.getLogger(__name__)


class P2PNode:
    """Secure P2P node with end-to-end encryption over TCP.

    Responsibilities:
    - Start a TCP listener on given host/port.
    - Accept incoming connections and keep a registry of peers.
    - Initiate outgoing connections to remote peers.
    - Send/receive encrypted JSON-framed messages (newline-delimited).
    - Perform X25519 key exchange and establish session keys for each peer.
    - Encrypt outgoing messages and decrypt incoming messages using ChaCha20-Poly1305.
    """

    def __init__(
        self,
        host: str,
        port: int,
        on_message: Optional[Callable[[str, Dict], Awaitable[None]]] = None,
        loop: Optional[asyncio.AbstractEventLoop] = None,
    ) -> None:
        self.host = host
        self.port = port
        self.on_message = on_message
        self.loop = loop or asyncio.get_event_loop()
        self.server: Optional[asyncio.AbstractServer] = None
        self.peers: Dict[str, asyncio.StreamWriter] = {}
        self.sessions: Dict[str, bytes] = {}
        self.peer_by_pubkey: Dict[str, str] = {}  # pubkey_b64 -> peer_id
        self.pubkey_by_peerid: Dict[str, str] = {}  # peer_id -> pubkey_b64
        self._private_key, public_key = generate_x25519_keypair()
        self.public_key_b64 = public_key_to_base64(public_key)
        self._lock = asyncio.Lock()
        self._log_path = (
            r"c:\Users\Dell\Documents\KULIAH SEM 5\Sistem Terdistribusi\.cursor\debug.log"
        )

    def _dlog(self, hypothesis_id: str, location: str, message: str, data: Dict) -> None:
        # #region agent log
        try:
            entry = {
                "sessionId": "debug-session",
                "runId": "run1",
                "hypothesisId": hypothesis_id,
                "location": location,
                "message": message,
                "data": data,
                "timestamp": int(_time.time() * 1000),
            }
            with open(self._log_path, "a", encoding="utf-8") as f:
                f.write(_json.dumps(entry) + "\n")
        except Exception:
            pass
        # #endregion

    async def start(self) -> None:
        self.server = await asyncio.start_server(
            self._handle_connection, self.host, self.port
        )
        addr = ", ".join(str(sock.getsockname()) for sock in self.server.sockets)
        logger.info("P2P listener started at %s", addr)

    async def stop(self) -> None:
        if self.server:
            self.server.close()
            await self.server.wait_closed()
            logger.info("P2P listener stopped")
        async with self._lock:
            for peer_id, writer in list(self.peers.items()):
                writer.close()
                logger.info("Closed connection to %s", peer_id)
            self.peers.clear()

    async def connect(self, host: str, port: int) -> str:
        reader, writer = await asyncio.open_connection(host, port)
        peer_id = f"{host}:{port}"
        async with self._lock:
            self.peers[peer_id] = writer
        logger.info("Connected to peer %s", peer_id)
        await self._send_handshake(peer_id, writer)
        self.loop.create_task(self._read_loop(peer_id, reader, writer))
        return peer_id

    async def send(self, peer_id: str, payload: Dict) -> None:
        async with self._lock:
            writer = self.peers.get(peer_id)
            session_key = self.sessions.get(peer_id)
        if not writer:
            raise ValueError(f"Unknown peer {peer_id}")
        if not session_key:
            raise ValueError(f"No session key established with {peer_id}")
        self._dlog("H1", "p2p_node.py:send", "pre-send", {"peer_id": peer_id, "has_writer": bool(writer), "has_session": bool(session_key)})
        try:
            encrypted = encrypt_payload(session_key, payload)
            data = json.dumps(encrypted).encode() + b"\n"
            writer.write(data)
            await writer.drain()
        except Exception as exc:
            self._dlog("H1", "p2p_node.py:send", "send-exception", {"peer_id": peer_id, "error": str(exc)})
            logger.warning("Failed sending to %s: %s", peer_id, exc)
            await self._cleanup_peer(peer_id, writer)
            raise

    async def broadcast(self, payload: Dict) -> None:
        async with self._lock:
            peers = list(self.peers.items())
            sessions = self.sessions.copy()
        self._dlog("H2", "p2p_node.py:broadcast", "pre-broadcast", {"peer_ids": [p for p, _ in peers], "session_count": len(sessions)})
        for peer_id, writer in peers:
            try:
                session_key = sessions.get(peer_id)
                if not session_key:
                    raise ValueError(f"No session key with {peer_id}")
                encrypted = encrypt_payload(session_key, payload)
                data = json.dumps(encrypted).encode() + b"\n"
                writer.write(data)
                await writer.drain()
            except Exception as exc:  # pragma: no cover - best effort
                self._dlog("H2", "p2p_node.py:broadcast", "broadcast-exception", {"peer_id": peer_id, "error": str(exc)})
                logger.warning("Failed sending to %s: %s", peer_id, exc)
                await self._cleanup_peer(peer_id, writer)

    async def _handle_connection(
        self, reader: asyncio.StreamReader, writer: asyncio.StreamWriter
    ) -> None:
        peer_host, peer_port, *_ = writer.get_extra_info("peername")
        peer_id = f"{peer_host}:{peer_port}"
        self._dlog("H3", "p2p_node.py:_handle_connection", "accepted", {"peer_id": peer_id})
        async with self._lock:
            self.peers[peer_id] = writer
        logger.info("Accepted connection from %s", peer_id)
        await self._send_handshake(peer_id, writer)
        try:
            await self._read_loop(peer_id, reader, writer)
        finally:
            async with self._lock:
                self.peers.pop(peer_id, None)
                self.sessions.pop(peer_id, None)
                pubkey = self.pubkey_by_peerid.pop(peer_id, None)
                if pubkey:
                    self.peer_by_pubkey.pop(pubkey, None)
            writer.close()
            logger.info("Peer %s disconnected", peer_id)

    async def _read_loop(
        self, peer_id: str, reader: asyncio.StreamReader, writer: asyncio.StreamWriter
    ) -> None:
        while True:
            line = await reader.readline()
            if not line:
                break
            try:
                payload = json.loads(line.decode())
            except json.JSONDecodeError:
                logger.warning("Discarding invalid JSON from %s", peer_id)
                continue
            msg_type = payload.get("type")
            if msg_type == "handshake":
                keep = await self._handle_handshake(peer_id, payload, writer)
                if not keep:
                    break
                continue
            if msg_type == "data":
                session_key = self.sessions.get(peer_id)
                if not session_key:
                    logger.warning("No session key for %s; drop message", peer_id)
                    continue
                try:
                    decrypted = decrypt_payload(session_key, payload)
                except Exception as exc:  # pragma: no cover - defensive
                    logger.warning("Failed to decrypt from %s: %s", peer_id, exc)
                    continue
                if self.on_message:
                    await self.on_message(peer_id, decrypted)

    async def _send_handshake(self, peer_id: str, writer: asyncio.StreamWriter) -> None:
        handshake = {"type": "handshake", "public_key": self.public_key_b64}
        writer.write(json.dumps(handshake).encode() + b"\n")
        await writer.drain()

    async def _handle_handshake(
        self, peer_id: str, payload: Dict, writer: asyncio.StreamWriter
    ) -> bool:
        peer_pub_b64 = payload.get("public_key")
        if not peer_pub_b64:
            return True
        peer_public = public_key_from_base64(peer_pub_b64)
        session_key = derive_shared_key(self._private_key, peer_public)
        async with self._lock:
            existing = self.peer_by_pubkey.get(peer_pub_b64)
            if existing and existing != peer_id:
                self._dlog("H3", "p2p_node.py:_handle_handshake", "duplicate-detected", {"existing": existing, "incoming": peer_id})
                logger.info(
                    "Duplicate connection for peer %s detected at %s; closing duplicate",
                    existing,
                    peer_id,
                )
                self.peers.pop(peer_id, None)
                self.sessions.pop(peer_id, None)
                self.pubkey_by_peerid.pop(peer_id, None)
                writer.close()
                return False
            self.peer_by_pubkey[peer_pub_b64] = peer_id
            self.pubkey_by_peerid[peer_id] = peer_pub_b64
            self.sessions[peer_id] = session_key
        self._dlog("H3", "p2p_node.py:_handle_handshake", "session-established", {"peer_id": peer_id})
        logger.info("Session key established with %s", peer_id)
        return True

    async def _cleanup_peer(self, peer_id: str, writer: Optional[asyncio.StreamWriter]) -> None:
        async with self._lock:
            self.peers.pop(peer_id, None)
            self.sessions.pop(peer_id, None)
            pubkey = self.pubkey_by_peerid.pop(peer_id, None)
            if pubkey:
                self.peer_by_pubkey.pop(pubkey, None)
        self._dlog("H4", "p2p_node.py:_cleanup_peer", "cleanup", {"peer_id": peer_id})
        if writer:
            try:
                writer.close()
            except Exception:
                pass


