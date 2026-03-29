<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Our Philosophy | The Disciplined Canvas</title>
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
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased flex flex-col min-h-screen">
    <!-- TopAppBar -->
    <?php $active_page = 'about'; include 'components/header.php'; ?>

    <main class="flex-grow">
        <section class="max-w-[1440px] mx-auto px-6 md:px-10 pt-16 md:pt-24 pb-12 md:pb-16 text-center md:text-left">
            <div class="max-w-3xl mx-auto md:mx-0">
                <p class="font-label text-[0.75rem] font-bold uppercase tracking-[0.05em] text-primary mb-4">The Philosophy</p>
                <h1 class="text-4xl md:text-[3.5rem] font-bold leading-[1.1] tracking-tighter text-on-surface mb-8">Our Philosophy</h1>
                <p class="text-on-surface-variant text-base md:text-[1.125rem] leading-relaxed max-w-2xl px-4 md:px-0">
                    We believe that a life well-lived is built on the quiet foundation of daily discipline. Not through radical overnight shifts, but through the deliberate application of small, consistent actions.
                </p>
            </div>
        </section>

        <section class="max-w-[1440px] mx-auto px-10 pb-24">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-auto">
                <div class="md:col-span-8 bg-surface-container-lowest rounded-xl p-10 flex flex-col justify-between overflow-hidden relative group">
                    <div class="relative z-10">
                        <span class="material-symbols-outlined text-primary text-4xl mb-6">architecture</span>
                        <h2 class="text-2xl font-bold tracking-tight mb-4">Designed for Clarity</h2>
                        <p class="text-on-surface-variant leading-relaxed max-w-md">
                            The Canvas is more than a tracker; it is an editorial space for your life. We removed the "gamification" noise to give you a high-end digital planner that respects your focus.
                        </p>
                    </div>
                </div>
                <div class="md:col-span-4 bg-surface-container-low rounded-xl p-8 flex flex-col justify-center items-center text-center">
                    <span class="text-[4rem] font-bold text-primary tracking-tighter">1%</span>
                    <p class="font-label text-[0.75rem] uppercase tracking-[0.05em] text-on-surface-variant mb-4">Daily Improvement</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="w-full mt-auto bg-surface-container-low border-t border-outline-variant/15">
        <div class="flex flex-col md:flex-row justify-between items-center px-10 py-8 max-w-[1440px] mx-auto text-[0.75rem] text-on-surface-variant uppercase tracking-[0.05em]">
            <p>© The Disciplined Canvas. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
