import base64
import os
from typing import Dict

from cryptography.hazmat.primitives import hashes, serialization
from cryptography.hazmat.primitives.asymmetric import x25519
from cryptography.hazmat.primitives.ciphers.aead import AESGCM
from cryptography.hazmat.primitives.kdf.hkdf import HKDF


def generate_x25519_keypair():
    private_key = x25519.X25519PrivateKey.generate()
    public_key = private_key.public_key()
    return private_key, public_key


def public_key_to_base64(public_key) -> str:
    raw = public_key.public_bytes(
        encoding=serialization.Encoding.Raw,
        format=serialization.PublicFormat.Raw,
    )
    return base64.b64encode(raw).decode()


def public_key_from_base64(data: str):
    raw = base64.b64decode(data.encode())
    return x25519.X25519PublicKey.from_public_bytes(raw)


def derive_shared_key(private_key, peer_public_key) -> bytes:
    shared = private_key.exchange(peer_public_key)
    hkdf = HKDF(
        algorithm=hashes.SHA256(),
        length=32,
        salt=None,
        info=b"p2p-chat-session",
    )
    return hkdf.derive(shared)


def encrypt_payload(key: bytes, payload: Dict) -> Dict:
    aesgcm = AESGCM(key)
    nonce = os.urandom(12)
    data = aesgcm.encrypt(nonce, _json_bytes(payload), None)
    return {
        "type": "data",
        "nonce": base64.b64encode(nonce).decode(),
        "ciphertext": base64.b64encode(data).decode(),
    }


def decrypt_payload(key: bytes, envelope: Dict) -> Dict:
    nonce = base64.b64decode(envelope["nonce"])
    ciphertext = base64.b64decode(envelope["ciphertext"])
    plaintext = AESGCM(key).decrypt(nonce, ciphertext, None)
    return _json_loads(plaintext)


def _json_bytes(payload: Dict) -> bytes:
    # late import to keep dependency surface minimal in this helper
    import json

    return json.dumps(payload).encode()


def _json_loads(data: bytes) -> Dict:
    import json

    return json.loads(data.decode())

