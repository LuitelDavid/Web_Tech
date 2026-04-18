<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatApp - Lab 10</title>
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg: #0f172a;
            --card-bg: #1e293b;
            --text: #f8fafc;
            --text-muted: #94a3b8;
            --input-bg: #0f172a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: radial-gradient(circle at top right, #312e81, transparent), 
                              radial-gradient(circle at bottom left, #1e1b4b, transparent);
        }

        .auth-container {
            width: 100%;
            max-width: 400px;
            background: var(--card-bg);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h1 {
            font-size: 28px;
            margin-bottom: 8px;
            background: linear-gradient(to right, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .auth-header p {
            color: var(--text-muted);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text-muted);
        }

        input {
            width: 100%;
            padding: 12px 16px;
            background: var(--input-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: var(--text);
            font-size: 15px;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
        }

        button.submit-btn {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }

        button.submit-btn:hover {
            background: var(--primary-hover);
        }

        button.submit-btn:active {
            transform: scale(0.98);
        }

        .auth-toggle {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: var(--text-muted);
        }

        .auth-toggle span {
            color: var(--primary);
            cursor: pointer;
            font-weight: 500;
        }

        .auth-toggle span:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
        }

        .hidden { display: none; }
    </style>
</head>
<body>
    <a href="../index.html" class="back-link">← Back to Index</a>

    <div class="auth-container">
        <!-- Login Section -->
        <div id="login-section">
            <div class="auth-header">
                <h1>Welcome Back</h1>
                <p>Login to start messaging</p>
            </div>
            
            <div id="login-alert" class="alert alert-error"></div>

            <form id="login-form">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="name@example.com" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="submit-btn" id="login-btn">Log In</button>
            </form>

            <div class="auth-toggle">
                Don't have an account? <span onclick="toggleAuth()">Sign Up</span>
            </div>
        </div>

        <!-- Signup Section -->
        <div id="signup-section" class="hidden">
            <div class="auth-header">
                <h1>Create Account</h1>
                <p>Join the conversation today</p>
            </div>

            <div id="signup-alert" class="alert"></div>

            <form id="signup-form">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="name@example.com" required>
                </div>
                <div class="form-group">
                    <label>Password (Min 4 chars)</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="submit-btn" id="signup-btn">Sign Up</button>
            </form>

            <div class="auth-toggle">
                Already have an account? <span onclick="toggleAuth()">Log In</span>
            </div>
        </div>
    </div>

    <script>
        function toggleAuth() {
            document.getElementById('login-section').classList.toggle('hidden');
            document.getElementById('signup-section').classList.toggle('hidden');
        }

        // Login Logic
        document.getElementById('login-form').onsubmit = async (e) => {
            e.preventDefault();
            const btn = document.getElementById('login-btn');
            const alert = document.getElementById('login-alert');
            
            btn.innerText = 'Logging in...';
            btn.disabled = true;
            alert.style.display = 'none';

            const formData = new FormData(e.target);
            try {
                const res = await fetch('auth/login.php', { method: 'POST', body: formData });
                const data = await res.json();
                
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert.innerText = data.error;
                    alert.style.display = 'block';
                    btn.innerText = 'Log In';
                    btn.disabled = false;
                }
            } catch (err) {
                alert.innerText = 'An error occurred. Please try again.';
                alert.style.display = 'block';
                btn.innerText = 'Log In';
                btn.disabled = false;
            }
        };

        // Signup Logic
        document.getElementById('signup-form').onsubmit = async (e) => {
            e.preventDefault();
            const btn = document.getElementById('signup-btn');
            const alert = document.getElementById('signup-alert');
            
            btn.innerText = 'Creating account...';
            btn.disabled = true;
            alert.style.display = 'none';

            const formData = new FormData(e.target);
            try {
                const res = await fetch('auth/signup.php', { method: 'POST', body: formData });
                const data = await res.json();
                
                if (data.success) {
                    alert.className = 'alert alert-success';
                    alert.innerText = data.success;
                    alert.style.display = 'block';
                    e.target.reset();
                    btn.innerText = 'Sign Up';
                    btn.disabled = false;
                    setTimeout(toggleAuth, 2000);
                } else {
                    alert.className = 'alert alert-error';
                    alert.innerText = data.error;
                    alert.style.display = 'block';
                    btn.innerText = 'Sign Up';
                    btn.disabled = false;
                }
            } catch (err) {
                alert.className = 'alert alert-error';
                alert.innerText = 'An error occurred. Please try again.';
                alert.style.display = 'block';
                btn.innerText = 'Sign Up';
                btn.disabled = false;
            }
        };
    </script>
</body>
</html>
