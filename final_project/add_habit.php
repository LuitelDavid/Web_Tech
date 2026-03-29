<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Create a New Habit | The Disciplined Canvas</title>
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
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface flex flex-col min-h-screen">
    <!-- TopAppBar -->
    <?php $active_page = 'dashboard'; include 'components/header.php'; ?>

    <main class="flex-grow flex items-center justify-center p-6 md:p-10 bg-surface-container-low">
        <div class="w-full max-w-2xl bg-surface-container-lowest rounded-xl p-8 md:p-12 shadow-sm">
            <header class="mb-10 text-center md:text-left">
                <p class="text-[0.75rem] font-bold uppercase tracking-[0.05em] text-primary mb-2">New Entry</p>
                <h1 class="text-3xl md:text-4xl font-bold tracking-tighter text-on-surface">Create a New Habit</h1>
                <p class="text-on-surface-variant text-sm mt-3 max-w-md">Define your next milestone. Small, consistent actions are the building blocks of professional discipline.</p>
            </header>

            <form id="addHabitForm" class="space-y-8">
                <div class="space-y-2">
                    <label class="block text-[0.75rem] font-bold uppercase tracking-[0.05em] text-on-surface-variant">Habit Name</label>
                    <input name="title" required class="w-full px-0 py-3 bg-transparent border-0 border-b-2 border-surface-container-highest focus:border-primary focus:ring-0 text-on-surface placeholder:text-outline-variant font-medium transition-colors" placeholder="e.g. Morning Focus Session" type="text"/>
                </div>
                <div class="space-y-2">
                    <label class="block text-[0.75rem] font-bold uppercase tracking-[0.05em] text-on-surface-variant">Description</label>
                    <textarea name="description" class="w-full px-4 py-3 bg-surface-container-highest border-0 rounded-lg focus:ring-2 focus:ring-primary text-on-surface placeholder:text-outline-variant text-sm transition-all" placeholder="Describe the context or why this habit matters to you..." rows="3"></textarea>
                </div>

                <div id="msg" class="text-sm font-medium hidden"></div>

                <div class="pt-6 flex flex-col md:flex-row gap-4 items-center border-t border-outline-variant/15">
                    <button class="w-full md:w-auto px-10 py-3 bg-gradient-to-r from-primary to-primary-container text-on-primary font-semibold rounded-lg hover:opacity-90 transition-all active:scale-95 shadow-sm" type="submit">
                        Add Habit
                    </button>
                    <a href="dashboard.php" class="w-full md:w-auto px-10 py-3 bg-transparent text-primary text-center font-semibold rounded-lg hover:bg-surface-container-high transition-all active:scale-95">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>

    <footer class="w-full mt-auto bg-[#f2f4f6] dark:bg-slate-950 border-t border-[#c3c6d7]/15">
        <div class="flex flex-col md:flex-row justify-between items-center px-10 py-8 max-w-[1440px] mx-auto">
            <p class="font-inter text-[0.75rem] uppercase tracking-[0.05em] text-[#434655] dark:text-slate-500 mb-4 md:mb-0">
                © 2024 The Disciplined Canvas. All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        const form = document.getElementById('addHabitForm');
        const msg = document.getElementById('msg');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            msg.classList.add('hidden');
            
            const formData = new FormData(form);
            try {
                const response = await fetch('habits/create.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                
                if (result.success) {
                    msg.textContent = 'Habit created successfully! Redirecting...';
                    msg.className = 'text-sm font-medium text-tertiary';
                    msg.classList.remove('hidden');
                    setTimeout(() => window.location.href = 'dashboard.php', 1000);
                } else {
                    msg.textContent = result.error;
                    msg.className = 'text-sm font-medium text-error';
                    msg.classList.remove('hidden');
                }
            } catch (err) {
                console.error(err);
                msg.textContent = 'An unexpected error occurred.';
                msg.className = 'text-sm font-medium text-error';
                msg.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
