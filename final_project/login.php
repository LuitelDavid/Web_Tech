<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Auth | The Disciplined Canvas</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
          tailwind.config = {
            darkMode: "class",
            theme: {
              extend: {
                colors: {
                  "surface-container-high": "#e6e8ea",
                  "primary": "#004ac6",
                  "surface-container": "#eceef0",
                  "on-background": "#191c1e",
                  "on-primary-fixed-variant": "#003ea8",
                  "surface-container-highest": "#e0e3e5",
                  "on-primary-container": "#eeefff",
                  "error": "#ba1a1a",
                  "secondary-fixed-dim": "#c4c7c9",
                  "on-secondary-fixed-variant": "#444749",
                  "on-secondary-container": "#626567",
                  "on-primary": "#ffffff",
                  "on-secondary-fixed": "#191c1e",
                  "inverse-on-surface": "#eff1f3",
                  "on-tertiary-fixed-variant": "#005236",
                  "on-tertiary-container": "#bdffdb",
                  "on-error-container": "#93000a",
                  "on-secondary": "#ffffff",
                  "background": "#f7f9fb",
                  "surface-container-lowest": "#ffffff",
                  "surface": "#f7f9fb",
                  "outline": "#737686",
                  "primary-fixed": "#dbe1ff",
                  "surface-dim": "#d8dadc",
                  "surface-container-low": "#f2f4f6",
                  "secondary-fixed": "#e0e3e5",
                  "outline-variant": "#c3c6d7",
                  "on-surface": "#191c1e",
                  "inverse-surface": "#2d3133",
                  "on-primary-fixed": "#00174b",
                  "surface-bright": "#f7f9fb",
                  "inverse-primary": "#b4c5ff",
                  "tertiary-container": "#007d55",
                  "on-error": "#ffffff",
                  "error-container": "#ffdad6",
                  "surface-tint": "#0053db",
                  "surface-variant": "#e0e3e5",
                  "primary-container": "#2563eb",
                  "on-tertiary-fixed": "#002113",
                  "on-tertiary": "#ffffff",
                  "primary-fixed-dim": "#b4c5ff",
                  "secondary": "#5c5f61",
                  "on-surface-variant": "#434655",
                  "secondary-container": "#e0e3e5",
                  "tertiary-fixed-dim": "#4edea3",
                  "tertiary": "#006242",
                  "tertiary-fixed": "#6ffbbe"
                },
                fontFamily: {
                  "headline": ["Inter"],
                  "body": ["Inter"],
                  "label": ["Inter"]
                },
                borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
              },
            },
          }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-surface font-body text-on-surface flex flex-col min-h-screen">
    <?php $active_page = 'login'; include 'components/header.php'; ?>

    <main class="flex-grow flex items-center justify-center px-6 py-12 md:py-24 bg-surface-container-low">
        <div class="max-w-[1000px] w-full grid md:grid-cols-2 gap-0 overflow-hidden bg-surface-container-lowest rounded-xl shadow-sm">
            <!-- Branding Side -->
            <div class="hidden md:flex flex-col justify-between p-12 bg-primary text-on-primary relative overflow-hidden">
                <div class="z-10">
                    <h2 class="text-4xl font-extrabold tracking-tighter leading-tight mb-4">Master Your Routine.</h2>
                    <p class="text-on-primary-container text-opacity-90 max-w-[280px]">Experience the editorial approach to habit formation. Clean, disciplined, and effective.</p>
                </div>
                <div class="z-10 mt-auto">
                    <div class="flex gap-2 mb-4">
                        <div class="w-8 h-8 rounded-sm bg-tertiary"></div>
                        <div class="w-8 h-8 rounded-sm bg-tertiary"></div>
                        <div class="w-8 h-8 rounded-sm bg-tertiary"></div>
                        <div class="w-8 h-8 rounded-sm bg-surface-container-highest opacity-30"></div>
                        <div class="w-8 h-8 rounded-sm bg-surface-container-highest opacity-30"></div>
                    </div>
                    <span class="text-[0.75rem] uppercase tracking-[0.05em] font-label font-bold">The Editorial Standard</span>
                </div>
                <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-primary-container rounded-full opacity-20 blur-3xl"></div>
            </div>

            <!-- Form Side -->
            <div class="p-8 md:p-12">
                <!-- Toggle Tab -->
                <div class="flex mb-10 bg-surface-container rounded-lg p-1">
                    <button id="loginTab" class="flex-1 py-2 text-sm font-semibold text-primary bg-surface-container-lowest rounded-md shadow-sm transition-all">Login</button>
                    <button id="signupTab" class="flex-1 py-2 text-sm font-medium text-on-surface-variant hover:text-on-surface transition-colors">Sign Up</button>
                </div>

                <header class="mb-8">
                    <h3 id="formTitle" class="text-[1.5rem] font-headline font-bold text-on-surface">Welcome Back</h3>
                    <p id="formSubtitle" class="text-on-surface-variant text-[0.875rem]">Please enter your credentials to access your canvas.</p>
                </header>

                <form id="authForm" class="space-y-6">
                    <!-- Name Field -->
                    <div id="nameField" class="hidden">
                        <label class="block text-[0.75rem] uppercase tracking-[0.05em] font-label font-bold text-on-surface-variant mb-2">Full Name</label>
                        <input name="name" class="w-full bg-surface-container-highest border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-primary transition-all placeholder:text-outline" placeholder="Alex Rivera" type="text"/>
                    </div>
                    <div>
                        <label class="block text-[0.75rem] uppercase tracking-[0.05em] font-label font-bold text-on-surface-variant mb-2">Email Address</label>
                        <input name="email" required class="w-full bg-surface-container-highest border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-primary transition-all placeholder:text-outline" placeholder="alex@disciplined.com" type="email"/>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-[0.75rem] uppercase tracking-[0.05em] font-label font-bold text-on-surface-variant">Password</label>
                            <a class="text-[0.75rem] font-medium text-primary hover:underline" href="#">Forgot?</a>
                        </div>
                        <input name="password" required class="w-full bg-surface-container-highest border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-primary transition-all placeholder:text-outline" placeholder="••••••••" type="password"/>
                    </div>
                    <div id="errorMessage" class="text-error text-[0.75rem] hidden"></div>
                    <div id="successMessage" class="text-tertiary text-[0.75rem] hidden"></div>
                    <div class="pt-2">
                        <button id="submitBtn" class="w-full py-4 bg-gradient-to-r from-primary to-primary-container text-on-primary font-bold rounded-lg active:scale-95 transition-transform" type="submit">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const authForm = document.getElementById('authForm');
        const loginTab = document.getElementById('loginTab');
        const signupTab = document.getElementById('signupTab');
        const formTitle = document.getElementById('formTitle');
        const formSubtitle = document.getElementById('formSubtitle');
        const nameField = document.getElementById('nameField');
        const submitBtn = document.getElementById('submitBtn');
        const errorMsg = document.getElementById('errorMessage');
        const successMsg = document.getElementById('successMessage');

        let mode = 'login';

        function setMode(newMode) {
            mode = newMode;
            errorMsg.classList.add('hidden');
            successMsg.classList.add('hidden');
            if (mode === 'login') {
                loginTab.className = 'flex-1 py-2 text-sm font-semibold text-primary bg-surface-container-lowest rounded-md shadow-sm transition-all';
                signupTab.className = 'flex-1 py-2 text-sm font-medium text-on-surface-variant hover:text-on-surface transition-colors';
                formTitle.textContent = 'Welcome Back';
                formSubtitle.textContent = 'Please enter your credentials to access your canvas.';
                nameField.classList.add('hidden');
                submitBtn.textContent = 'Login';
            } else {
                signupTab.className = 'flex-1 py-2 text-sm font-semibold text-primary bg-surface-container-lowest rounded-md shadow-sm transition-all';
                loginTab.className = 'flex-1 py-2 text-sm font-medium text-on-surface-variant hover:text-on-surface transition-colors';
                formTitle.textContent = 'Create Account';
                formSubtitle.textContent = 'Join the editorial approach to habit formation.';
                nameField.classList.remove('hidden');
                submitBtn.textContent = 'Sign Up';
            }
        }

        loginTab.addEventListener('click', () => setMode('login'));
        signupTab.addEventListener('click', () => setMode('signup'));

        authForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            errorMsg.classList.add('hidden');
            successMsg.classList.add('hidden');
            
            const formData = new FormData(authForm);
            const endpoint = mode === 'login' ? 'auth/login.php' : 'auth/signup.php';

            try {
                const response = await fetch(endpoint, {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result.error) {
                    errorMsg.textContent = result.error;
                    errorMsg.classList.remove('hidden');
                } else {
                    if (mode === 'signup') {
                        successMsg.textContent = 'Registration successful! Please login.';
                        successMsg.classList.remove('hidden');
                        setTimeout(() => setMode('login'), 1500);
                    } else {
                        window.location.href = result.redirect;
                    }
                }
            } catch (err) {
                errorMsg.textContent = 'An error occurred. Please try again.';
                errorMsg.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
