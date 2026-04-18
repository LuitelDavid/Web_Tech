<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
$current_user_id = $_SESSION['user_id'];
$current_user_name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ChatApp</title>
    <style>
        :root {
            --primary: #6366f1;
            --bg: #0f172a;
            --card-bg: #1e293b;
            --text: #f8fafc;
            --text-muted: #94a3b8;
            --border: rgba(255, 255, 255, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--card-bg);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 30px 20px;
        }

        .sidebar h2 {
            font-size: 22px;
            margin-bottom: 30px;
            background: linear-gradient(to right, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-info {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: auto;
        }

        .user-info p {
            margin: 0;
            font-size: 14px;
            color: var(--text-muted);
        }

        .user-info strong {
            display: block;
            color: var(--text);
            font-size: 16px;
            margin-top: 4px;
        }

        .logout-btn {
            padding: 12px;
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            text-decoration: none;
            border-radius: 10px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid rgba(239, 68, 68, 0.2);
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background: #ef4444;
            color: white;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-image: radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.05), transparent);
        }

        .header {
            padding: 20px 40px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h3 { margin: 0; font-size: 18px; }

        .messages-container {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .message-card {
            max-width: 80%;
            background: var(--card-bg);
            padding: 16px 20px;
            border-radius: 16px;
            border: 1px solid var(--border);
            position: relative;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .message-card.own {
            align-self: flex-end;
            background: rgba(99, 102, 241, 0.1);
            border-color: rgba(99, 102, 241, 0.2);
        }

        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .username {
            font-size: 13px;
            font-weight: 600;
            color: var(--primary);
        }

        .own .username { color: #818cf8; }

        .timestamp {
            font-size: 11px;
            color: var(--text-muted);
        }

        .content {
            font-size: 15px;
            line-height: 1.5;
            color: var(--text);
            word-break: break-word;
        }

        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            display: none;
            font-size: 12px;
        }

        .message-card.own:hover .delete-btn { display: block; }

        .delete-btn:hover { color: #f87171; background: rgba(239, 68, 68, 0.1); }

        /* Input Area */
        .input-area {
            padding: 25px 40px;
            background: var(--card-bg);
            border-top: 1px solid var(--border);
        }

        .input-group {
            display: flex;
            gap: 15px;
            max-width: 900px;
            margin: 0 auto;
        }

        input.message-input {
            flex: 1;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 14px 20px;
            color: var(--text);
            font-size: 15px;
        }

        input.message-input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .send-btn {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0 25px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .send-btn:hover { background: #4f46e5; transform: scale(1.02); }

    </style>
</head>
<body>
    <div class="sidebar">
        <h2>ChatApp v1.0</h2>
        <div class="user-info">
            <p>Logged in as</p>
            <strong><?php echo htmlspecialchars($current_user_name); ?></strong>
        </div>
        <a href="auth/logout.php" class="logout-btn">Log Out</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h3>Global Conversation</h3>
            <span style="font-size: 13px; color: var(--text-muted);" id="user-count">All Users</span>
        </div>

        <div class="messages-container" id="messages-container">
            <!-- Messages load here -->
        </div>

        <div class="input-area">
            <form id="message-form" class="input-group">
                <input type="text" id="message-input" class="message-input" placeholder="Type your message here..." required autocomplete="off">
                <button type="submit" class="send-btn" id="send-btn">Send Message</button>
            </form>
        </div>
    </div>

    <script>
        const currentUserId = <?php echo $current_user_id; ?>;
        const container = document.getElementById('messages-container');
        const form = document.getElementById('message-form');
        const input = document.getElementById('message-input');

        async function fetchMessages() {
            try {
                const res = await fetch('api/messages.php');
                const data = await res.json();
                
                if (Array.isArray(data)) {
                    // Update only if needed to avoid flickering (simple version: just redraw)
                    renderMessages(data);
                }
            } catch (err) {
                console.error('Failed to fetch messages', err);
            }
        }

        function renderMessages(messages) {
            container.innerHTML = '';
            messages.forEach(msg => {
                const isOwn = msg.user_id == currentUserId;
                const card = document.createElement('div');
                card.className = `message-card ${isOwn ? 'own' : ''}`;
                
                const date = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                card.innerHTML = `
                    <div class="message-header">
                        <span class="username">${isOwn ? 'You' : msg.user_name}</span>
                        <span class="timestamp">${date}</span>
                    </div>
                    <div class="content">${msg.content}</div>
                    ${isOwn ? `<button class="delete-btn" onclick="deleteMessage(${msg.id})">Delete</button>` : ''}
                `;
                container.appendChild(card);
            });
            // Scroll to bottom
            container.scrollTop = container.scrollHeight;
        }

        form.onsubmit = async (e) => {
            e.preventDefault();
            const content = input.value.trim();
            if (!content) return;

            const btn = document.getElementById('send-btn');
            btn.disabled = true;

            try {
                const res = await fetch('api/messages.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ content })
                });
                const data = await res.json();
                if (data.success) {
                    input.value = '';
                    fetchMessages();
                }
            } catch (err) {
                console.error('Failed to send message', err);
            } finally {
                btn.disabled = false;
            }
        };

        async function deleteMessage(id) {
            if (!confirm('Are you sure you want to delete this message?')) return;
            
            try {
                const res = await fetch(`api/messages.php?id=${id}`, { method: 'DELETE' });
                const data = await res.json();
                if (data.success) {
                    fetchMessages();
                }
            } catch (err) {
                console.error('Failed to delete message', err);
            }
        }

        // Poll for new messages every 5 seconds
        setInterval(fetchMessages, 5000);
        
        // Initial fetch
        fetchMessages();
    </script>
</body>
</html>
