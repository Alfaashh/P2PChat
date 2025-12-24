(() => {
  const ws = new WebSocket(`ws://${location.host}/ws`);
  const statusEl = document.getElementById("status");
  const messagesEl = document.getElementById("messages");
  const chatInput = document.getElementById("chatInput");
  const btnSend = document.getElementById("btnSend");
  const btnConnect = document.getElementById("btnConnect");
  const displayNameInput = document.getElementById("displayName");
  const remoteIpInput = document.getElementById("remoteIp");
  const remotePortInput = document.getElementById("remotePort");
  const myPortEl = document.getElementById("myPort");
  const myPubKeyEl = document.getElementById("myPubKey");

  let state = {
    connected: false,
    displayName: "",
  };

  function appendMessage(text, who = "peer", name) {
    const div = document.createElement("div");
    div.className = `msg ${who === "me" ? "me" : "peer"}`;
    if (name) {
      const label = document.createElement("div");
      label.className = "msg-label";
      label.textContent = name;
      div.appendChild(label);
    }
    const body = document.createElement("div");
    body.textContent = text;
    div.appendChild(body);
    messagesEl.appendChild(div);
    messagesEl.scrollTop = messagesEl.scrollHeight;
  }

  function saveDisplayName() {
    state.displayName = displayNameInput.value.trim() || "";
  }

  ws.onopen = () => {
    statusEl.textContent = "Connected to local peer";
  };

  ws.onmessage = (event) => {
    const data = JSON.parse(event.data);
    if (data.type === "peer_message") {
      const fromName = data.from_name || "Peer";
      appendMessage(data.message || "", "peer", fromName);
    } else if (data.type === "status") {
      statusEl.textContent = data.status;
    } else if (data.type === "info") {
      if (data.port) myPortEl.value = data.port;
      if (data.public_key) myPubKeyEl.value = data.public_key.slice(0, 30) + "...";
    }
  };

  ws.onclose = () => {
    statusEl.textContent = "Disconnected";
  };

  function sendMessage() {
    const msg = chatInput.value.trim();
    if (!msg) return;
    saveDisplayName();
    ws.send(JSON.stringify({ action: "send_message", message: msg, display_name: state.displayName }));
    appendMessage(msg, "me", state.displayName || "Me");
    chatInput.value = "";
  }

  btnSend.onclick = sendMessage;
  chatInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter" && !e.shiftKey) {
      e.preventDefault();
      sendMessage();
    }
  });

  btnConnect.onclick = () => {
    saveDisplayName();
    const ip = remoteIpInput.value.trim();
    const port = parseInt(remotePortInput.value.trim(), 10);
    if (!ip || Number.isNaN(port)) {
      alert("Isi IP dan port yang valid");
      return;
    }
    ws.send(JSON.stringify({ action: "connect_peer", ip, port }));
  };

  displayNameInput.addEventListener("blur", saveDisplayName);
  displayNameInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
      e.preventDefault();
      saveDisplayName();
    }
  });
  remotePortInput.addEventListener("blur", saveDisplayName);
})();

