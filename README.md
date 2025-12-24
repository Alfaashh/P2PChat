# P2P Chat (End-to-End Encrypted)

Demo aplikasi chat P2P sederhana untuk tugas Sistem Terdistribusi. Tiap peer punya key pair, melakukan handshake public key, lalu memakai session key (HKDF + AES-GCM) untuk enkripsi pesan end-to-end.

## Persyaratan
- Python 3.10+
- Paket: `aiohttp`, `cryptography`

Instal:
```bash
pip install aiohttp cryptography
```

## Menjalankan
1) Jalankan peer A (contoh port P2P 6000, web UI 8000):
```bash
python P2P.py --port 6000 --web-port 8000
```
2) Jalankan peer B (contoh port P2P 6001, web UI 8001, bisa di mesin sama dengan 127.0.0.1):
```bash
python P2P.py --port 6001 --web-port 8001
```
3) Buka UI lokal:
   - Peer A: http://localhost:8000
   - Peer B: http://localhost:8001
4) Di UI, isi display name (opsional), masukkan `IP:Port` lawan (mis. `127.0.0.1` dan `5001`), klik **Connect**.
5) Kirim pesan melalui kotak input. Pesan dikirim terenkripsi setelah handshake selesai.

## Catatan Keamanan
- Session key dibuat dari X25519 + HKDF, pesan disegel AES-GCM.
- Public key ditampilkan di UI (dipotong) sebagai identitas peer.
- Mode discovery manual: user memasukkan IP:Port lawan.

## Struktur Utama
- `P2P.py` — entrypoint, HTTP+WebSocket untuk UI, integrasi P2PNode.
- `p2p_node.py` — listener P2P, handshake public key, enkripsi/dekripsi pesan.
- `crypto_utils.py` — utilitas kriptografi (X25519, HKDF, AES-GCM).
- `static/index.html`, `static/app.js` — UI sederhana.

