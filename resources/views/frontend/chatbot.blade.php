<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chatbot</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root {
      --bg: #f7f7f7;
      --card-bg: #ffffff;
      --text: #1f2937;
      --muted: #6b7280;
      --border: #e5e7eb;
      --shadow: 0 2px 12px rgba(0,0,0,0.06);
      --bubble-user-bg: #0d6efd;
      --bubble-user-text: #ffffff;
      --bubble-bot-bg: #f1f3f5;
      --bubble-bot-text: #111827;
    }
    [data-theme="dark"] {
      --bg: #0b1220;
      --card-bg: #0f172a;
      --text: #e5e7eb;
      --muted: #94a3b8;
      --border: #1f2937;
      --shadow: 0 2px 12px rgba(0,0,0,0.4);
      --bubble-user-bg: #2563eb;
      --bubble-user-text: #ffffff;
      --bubble-bot-bg: #111827;
      --bubble-bot-text: #e5e7eb;
    }
    body { background: var(--bg); color: var(--text); }
    .chat-container { max-width: 800px; margin: 40px auto; background: var(--card-bg); border-radius: 8px; box-shadow: var(--shadow); }
    .chat-header { padding: 16px 20px; border-bottom: 1px solid var(--border); font-weight: 600; display: flex; align-items: center; justify-content: space-between; }
    .theme-toggle { display: inline-flex; align-items: center; gap: 8px; font-size: 14px; color: var(--muted); cursor: pointer; border: 1px solid var(--border); padding: 6px 10px; border-radius: 8px; background: transparent; }
    .chat-body { height: 60vh; overflow-y: auto; padding: 16px 20px; }
    .msg { margin-bottom: 12px; }
    .msg-user { text-align: right; }
    .bubble { display: inline-block; padding: 10px 14px; border-radius: 14px; max-width: 85%; white-space: pre-wrap; }
    .bubble-user { background: var(--bubble-user-bg); color: var(--bubble-user-text); }
    .bubble-bot { background: var(--bubble-bot-bg); color: var(--bubble-bot-text); }
    .chat-footer { padding: 12px; border-top: 1px solid var(--border); }
    .form-control { background: var(--card-bg); color: var(--text); border-color: var(--border); }
    .form-control::placeholder { color: var(--muted); }
  </style>
</head>
<body>
  <div class="chat-container">
    <div class="chat-header">
      <span>Chatbot</span>
      <button id="themeToggle" type="button" class="theme-toggle" aria-label="Toggle theme">
        <span id="themeLabel">Light</span>
      </button>
    </div>
    <div id="chatBody" class="chat-body">
      <div class="msg">
        <div class="bubble bubble-bot">Xin chào! Mình có thể giúp gì cho bạn?</div>
      </div>
    </div>
    <div class="chat-footer">
      <form id="chatForm" class="d-flex gap-2">
        <input id="message" name="message" class="form-control" placeholder="Nhập tin nhắn..." autocomplete="off" />
        <button class="btn btn-primary" type="submit">Gửi</button>
      </form>
    </div>
  </div>

  <script>
    // Theme setup
    (function(){
      const key = 'theme-preference';
      const root = document.documentElement;
      const btn = document.getElementById('themeToggle');
      const label = document.getElementById('themeLabel');
      const apply = (mode) => {
        if (mode === 'dark') { root.setAttribute('data-theme','dark'); label.textContent='Dark'; }
        else { root.removeAttribute('data-theme'); label.textContent='Light'; }
      };
      const saved = localStorage.getItem(key) || 'light';
      apply(saved);
      btn.addEventListener('click', () => {
        const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        localStorage.setItem(key, next);
        apply(next);
      });
    })();

    const chatBody = document.getElementById('chatBody');
    const form = document.getElementById('chatForm');
    const input = document.getElementById('message');

    function appendMessage(text, isUser) {
      const wrap = document.createElement('div');
      wrap.className = 'msg' + (isUser ? ' msg-user' : '');
      const bubble = document.createElement('div');
      bubble.className = 'bubble ' + (isUser ? 'bubble-user' : 'bubble-bot');
      bubble.textContent = text;
      wrap.appendChild(bubble);
      chatBody.appendChild(wrap);
      chatBody.scrollTop = chatBody.scrollHeight;
    }

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const text = input.value.trim();
      if (!text) return;
      appendMessage(text, true);
      input.value = '';

      // Show typing indicator
      const typing = document.createElement('div');
      typing.className = 'msg';
      const typingBubble = document.createElement('div');
      typingBubble.className = 'bubble bubble-bot';
      typingBubble.textContent = 'Đang soạn...';
      typing.appendChild(typingBubble);
      chatBody.appendChild(typing);
      chatBody.scrollTop = chatBody.scrollHeight;

      try {
        const res = await fetch("{{ route('frontend.chatbot.message') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ message: text })
        });
        const data = await res.json();
        typing.remove();
        if (data.reply) {
          appendMessage(data.reply, false);
        } else if (data.error) {
          const more = data.detail ? ('\nChi tiết: ' + data.detail) : (data.status ? ('\nMã trạng thái: ' + data.status) : '');
          appendMessage('Lỗi: ' + (data.error || 'Không xác định') + more, false);
        } else {
          appendMessage('Không có phản hồi từ máy chủ.', false);
        }
      } catch (err) {
        typing.remove();
        appendMessage('Lỗi kết nối: ' + err.message, false);
      }
    });
  </script>
</body>
</html>
