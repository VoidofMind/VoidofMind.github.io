<html lang="en">
<head>
<meta charset="UTF-8">
<title>Claude Chat</title>

<script src="https://js.puter.com/v2/"></script>

<style>
body {
    margin: 0;
    background: #1e1e1e;
    color: white;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    height: 100vh;
}

#chat {
    width: 700px;
    display: flex;
    flex-direction: column;
}

#messages {
    flex: 1;
    overflow-y: auto;
    padding: 15px;
    background: #252526;
}

.message {
    margin-bottom: 15px;
    padding: 10px;
    border-radius: 8px;
    white-space: pre-wrap;
}

.user {
    background: #0e639c;
}

.ai {
    background: #3c3c3c;
}

#bottom {
    display: flex;
    padding: 10px;
    background: #333;
}

input {
    flex: 1;
    font-size: 16px;
    padding: 10px;
    border: none;
    outline: none;
}

button {
    width: 100px;
    border: none;
    background: #0078d4;
    color: white;
    cursor: pointer;
}

button:hover {
    background: #1490ff;
}
</style>
</head>

<body>

<div id="chat">

<div id="messages"></div>

<div id="bottom">
<input id="prompt" placeholder="Ask Claude something...">
<button id="send">Send</button>
</div>

</div>

<script>

const messages = document.getElementById("messages");
const input = document.getElementById("prompt");

function addMessage(text, cls) {

    const div = document.createElement("div");
    div.className = "message " + cls;
    div.textContent = text;

    messages.appendChild(div);
    messages.scrollTop = messages.scrollHeight;

    return div;
}

async function send() {

    const prompt = input.value.trim();

    if (!prompt)
        return;

    input.value = "";

    addMessage(prompt, "user");

    const thinking = addMessage("Thinking...", "ai");

    try {

        const response = await puter.ai.chat(prompt, {
            model: "claude-code"
        });

        thinking.textContent = response.message.content;

    } catch (err) {

        thinking.textContent =
            "Error:\n\n" + err.message;

    }

}

document.getElementById("send").onclick = send;

input.addEventListener("keydown", e => {
    if (e.key === "Enter")
        send();
});

</script>

</body>
</html>
