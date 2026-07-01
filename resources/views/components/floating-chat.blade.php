@php
$apiKey = config('services.gemini.api_key');
@endphp

@if ($apiKey)
<style>
#chatFab {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 9999;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #095890;
    color: #fff;
    border: none;
    box-shadow: 0 4px 20px rgba(9, 88, 144, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
#chatFab:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 28px rgba(9, 88, 144, 0.55);
}
#chatFab i {
    font-size: 28px;
    line-height: 1;
}

#chatPanel {
    position: fixed;
    bottom: 100px;
    right: 24px;
    z-index: 9999;
    width: 400px;
    height: 600px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
    display: none;
    flex-direction: column;
    overflow: hidden;
    animation: chatFadeIn 0.25s ease-out;
}
#chatPanel.open {
    display: flex;
}

@keyframes chatFadeIn {
    from { opacity: 0; transform: translateY(16px) scale(0.96); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}

#chatHeader {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 18px;
    background: #095890;
    color: #fff;
    flex-shrink: 0;
}
.chat-header-left {
    display: flex;
    align-items: center;
    gap: 10px;
}
.chat-header-left i {
    font-size: 24px;
}
.chat-header-info h6 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
}
.chat-header-info small {
    font-size: 12px;
    opacity: 0.85;
}
#chatClose {
    background: none;
    border: none;
    color: #fff;
    font-size: 24px;
    cursor: pointer;
    padding: 0 4px;
    opacity: 0.8;
    transition: opacity 0.15s;
    line-height: 1;
}
#chatClose:hover {
    opacity: 1;
}

#chatBody {
    flex: 1;
    overflow-y: auto;
    padding: 16px;
    background: #f8f9fa;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.chat-bubble {
    max-width: 85%;
    padding: 10px 14px;
    border-radius: 16px;
    font-size: 14px;
    line-height: 1.5;
    word-wrap: break-word;
    animation: bubbleIn 0.2s ease-out;
}
.chat-bubble-user {
    align-self: flex-end;
    background: #095890;
    color: #fff;
    border-bottom-right-radius: 4px;
}
.chat-bubble-ai {
    align-self: flex-start;
    background: #e9ecef;
    color: #212529;
    border-bottom-left-radius: 4px;
}
.chat-bubble-ai p {
    margin-bottom: 0;
}
.chat-bubble-ai p + p {
    margin-top: 8px;
}
.chat-bubble-ai ul, .chat-bubble-ai ol {
    padding-left: 20px;
    margin-bottom: 0;
    margin-top: 4px;
}
.chat-bubble-ai code {
    background: #dee2e6;
    padding: 1px 5px;
    border-radius: 4px;
    font-size: 13px;
}
.chat-bubble-ai pre {
    background: #dee2e6;
    padding: 10px;
    border-radius: 8px;
    overflow-x: auto;
    font-size: 13px;
    margin: 6px 0 0;
}
.chat-bubble-ai pre code {
    background: none;
    padding: 0;
}
.chat-bubble-ai h1, .chat-bubble-ai h2, .chat-bubble-ai h3,
.chat-bubble-ai h4, .chat-bubble-ai h5, .chat-bubble-ai h6 {
    font-size: 15px;
    font-weight: 600;
    margin: 8px 0 4px;
}
.chat-bubble-ai h1:first-child, .chat-bubble-ai h2:first-child,
.chat-bubble-ai h3:first-child {
    margin-top: 0;
}
.chat-bubble-ai strong {
    font-weight: 600;
}
.chat-bubble-typing {
    align-self: flex-start;
    background: #e9ecef;
    color: #6c757d;
    padding: 12px 18px;
    border-radius: 16px;
    border-bottom-left-radius: 4px;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
}
.chat-bubble-typing .dot {
    width: 6px;
    height: 6px;
    background: #6c757d;
    border-radius: 50%;
    animation: dotPulse 1.2s infinite;
}
.chat-bubble-typing .dot:nth-child(2) {
    animation-delay: 0.2s;
}
.chat-bubble-typing .dot:nth-child(3) {
    animation-delay: 0.4s;
}
@keyframes dotPulse {
    0%, 60%, 100% { opacity: 0.3; }
    30% { opacity: 1; }
}
@keyframes bubbleIn {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
}

.chat-action-card {
    margin-top: 10px;
    padding: 12px;
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.chat-action-card .action-buttons {
    display: flex;
    gap: 8px;
    margin-top: 8px;
}
.chat-action-card .btn-action {
    flex: 1;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: background 0.15s;
}
.chat-action-card .btn-action-go {
    background: #095890;
    color: #fff;
}
.chat-action-card .btn-action-go:hover {
    background: #0a6aae;
}
.chat-action-card .btn-action-cancel {
    background: #e9ecef;
    color: #495057;
}
.chat-action-card .btn-action-cancel:hover {
    background: #dee2e6;
}

#chatFooter {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    background: #fff;
    border-top: 1px solid #dee2e6;
    flex-shrink: 0;
}
#chatInput {
    flex: 1;
    border-radius: 20px;
    border: 1px solid #ced4da;
    padding: 8px 16px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.15s;
}
#chatInput:focus {
    border-color: #095890;
}
#chatSend {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #095890;
    color: #fff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.15s;
    flex-shrink: 0;
}
#chatSend:hover {
    background: #0a6aae;
}
#chatSend i {
    font-size: 18px;
}
#chatSend:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

@media (max-width: 480px) {
    #chatPanel {
        width: calc(100% - 32px);
        height: calc(100% - 140px);
        right: 16px;
        bottom: 88px;
    }
}
</style>

<button id="chatFab" onclick="toggleChat()" aria-label="Buka chat" title="Buka chat">
    <i class="bi bi-robot"></i>
</button>

<div id="chatPanel">
    <div id="chatHeader">
        <div class="chat-header-left">
            <i class="bi bi-robot"></i>
            <div class="chat-header-info">
                <h6>SIPI AI</h6>
                <small>Asisten Pembelajaran</small>
            </div>
        </div>
        <button id="chatClose" onclick="closeChat()">&times;</button>
    </div>

    <div id="chatBody"></div>

    <div id="chatFooter">
        <input type="text" id="chatInput" placeholder="Ketik pesan..." autocomplete="off">
        <button id="chatSend" onclick="sendMessage()" aria-label="Kirim">
            <i class="bi bi-send-fill"></i>
        </button>
    </div>
</div>

<script>
let chatVisible = false;

function toggleChat() {
    chatVisible = !chatVisible;
    document.getElementById('chatPanel').classList.toggle('open', chatVisible);
    document.getElementById('chatFab').style.display = chatVisible ? 'none' : 'flex';
    if (chatVisible) {
        document.getElementById('chatInput').focus();
    }
}

function closeChat() {
    chatVisible = false;
    document.getElementById('chatPanel').classList.remove('open');
    document.getElementById('chatFab').style.display = 'flex';
}

document.addEventListener('click', function (e) {
    const panel = document.getElementById('chatPanel');
    const fab = document.getElementById('chatFab');
    if (panel.classList.contains('open')) {
        if (!panel.contains(e.target) && !fab.contains(e.target)) {
            closeChat();
        }
    }
});

document.getElementById('chatInput').addEventListener('keydown', function (e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
});

function escapeHtml(text) {
    const d = document.createElement('div');
    d.textContent = text;
    return d.innerHTML;
}

function markdownToHtml(text) {
    text = escapeHtml(text);

    text = text.replace(/```(\w*)\n([\s\S]*?)```/g, '<pre><code>$2</code></pre>');

    text = text.replace(/`([^`]+)`/g, '<code>$1</code>');

    text = text.replace(/^### (.+)$/gm, '<h6>$1</h6>');
    text = text.replace(/^## (.+)$/gm, '<h5>$1</h5>');
    text = text.replace(/^# (.+)$/gm, '<h4>$1</h4>');

    text = text.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
    text = text.replace(/\*(.+?)\*/g, '<em>$1</em>');

    text = text.replace(/^- (.+)$/gm, '<li>$1</li>');
    text = text.replace(/((?:<li>.*<\/li>\n?)+)/g, '<ul>$1</ul>');

    const lines = text.split('\n');
    const result = [];
    for (let i = 0; i < lines.length; i++) {
        const line = lines[i].trim();
        if (!line) {
            continue;
        }
        if (line.startsWith('<h') || line.startsWith('<pre') || line.startsWith('<ul') || line.startsWith('<li')) {
            result.push(line);
        } else {
            result.push('<p>' + line + '</p>');
        }
    }
    return result.join('\n');
}

function addUserBubble(text) {
    const body = document.getElementById('chatBody');
    const div = document.createElement('div');
    div.className = 'chat-bubble chat-bubble-user';
    div.textContent = text;
    body.appendChild(div);
    body.scrollTop = body.scrollHeight;
}

function addAiBubble(html) {
    const body = document.getElementById('chatBody');
    const div = document.createElement('div');
    div.className = 'chat-bubble chat-bubble-ai';
    div.innerHTML = html;
    body.appendChild(div);
    body.scrollTop = body.scrollHeight;
    return div;
}

function addActionCard(bubbleEl, action, actionUrl) {
    const card = document.createElement('div');
    card.className = 'chat-action-card';

    const buttons = document.createElement('div');
    buttons.className = 'action-buttons';

    const goBtn = document.createElement('button');
    goBtn.className = 'btn-action btn-action-go';
    goBtn.textContent = action.button || 'Buka';
    goBtn.addEventListener('click', function () {
        if (actionUrl) {
            window.location.href = actionUrl;
        }
    });

    const cancelBtn = document.createElement('button');
    cancelBtn.className = 'btn-action btn-action-cancel';
    cancelBtn.textContent = 'Batal';
    cancelBtn.addEventListener('click', function () {
        card.remove();
    });

    buttons.appendChild(goBtn);
    buttons.appendChild(cancelBtn);
    card.appendChild(buttons);
    bubbleEl.appendChild(card);
    bubbleEl.parentNode.scrollTop = bubbleEl.parentNode.scrollHeight;
}

function showTyping() {
    const body = document.getElementById('chatBody');
    const div = document.createElement('div');
    div.className = 'chat-bubble-typing';
    div.id = 'chatTyping';
    div.innerHTML = '<span class="dot"></span><span class="dot"></span><span class="dot"></span>';
    body.appendChild(div);
    body.scrollTop = body.scrollHeight;
}

function hideTyping() {
    const el = document.getElementById('chatTyping');
    if (el) el.remove();
}

async function sendMessage() {
    const input = document.getElementById('chatInput');
    const text = input.value.trim();
    if (!text) return;

    input.value = '';
    document.getElementById('chatSend').disabled = true;

    addUserBubble(text);
    showTyping();

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!csrfToken) return;

    try {
        const response = await fetch('/ai/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ message: text }),
        });

        const result = await response.json();
        hideTyping();

        if (result.success) {
            const bubble = addAiBubble(markdownToHtml(result.data));
            if (result.action && result.action_url) {
                addActionCard(bubble, result.action, result.action_url);
            }
        } else {
            addAiBubble('<p>' + escapeHtml(result.message || 'Maaf, AI sedang tidak dapat dihubungi. Silakan coba lagi.') + '</p>');
        }
    } catch (e) {
        hideTyping();
        addAiBubble('<p>Maaf, AI sedang tidak dapat dihubungi. Silakan coba lagi.</p>');
    } finally {
        document.getElementById('chatSend').disabled = false;
        document.getElementById('chatInput').focus();
    }
}
</script>
@endif
