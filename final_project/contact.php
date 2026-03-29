<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Get in Touch - The Disciplined Canvas</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
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
<body class="bg-surface text-on-surface flex flex-col min-h-screen">
    <!-- TopAppBar -->
    <?php $active_page = 'contact'; include 'components/header.php'; ?>

    <main class="flex-grow">
        <section class="px-10 py-20 max-w-[1440px] mx-auto">
            <div class="flex flex-col md:flex-row gap-16 items-start">
                <div class="w-full md:w-1/3 space-y-8">
                    <h1 class="text-[3.5rem] leading-none font-extrabold tracking-tighter text-on-surface">Get in Touch</h1>
                    <p class="text-[0.875rem] text-on-surface-variant leading-relaxed max-w-sm">
                        Whether you're looking for support with your habit tracking or want to discuss a custom planning solution.
                    </p>
                    <div class="pt-8 space-y-6">
                        <div class="flex flex-col gap-1">
                            <span class="text-[0.75rem] font-bold uppercase tracking-[0.05em] text-primary">Email Us</span>
                            <a class="text-on-surface hover:text-primary transition-colors text-lg font-medium underline underline-offset-4 decoration-outline-variant/30" href="mailto:hello@disciplinedcanvas.com">hello@disciplinedcanvas.com</a>
                        </div>
                    </div>
                </div>
                <!-- Form Canvas -->
                <div class="w-full md:w-2/3 bg-surface-container-low p-1 rounded-xl">
                    <div class="bg-surface-container-lowest p-8 md:p-12 rounded-lg">
                        <form class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[0.75rem] font-bold uppercase tracking-[0.05em] text-on-surface-variant block">Name</label>
                                    <input class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-primary text-on-surface transition-all" placeholder="John Doe" type="text"/>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[0.75rem] font-bold uppercase tracking-[0.05em] text-on-surface-variant block">Email</label>
                                    <input class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-primary text-on-surface transition-all" placeholder="john@example.com" type="email"/>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[0.75rem] font-bold uppercase tracking-[0.05em] text-on-surface-variant block">Message</label>
                                <textarea class="w-full bg-surface-container-highest border-none rounded-lg p-4 focus:ring-2 focus:ring-primary text-on-surface transition-all resize-none" placeholder="Your message here..." rows="6"></textarea>
                            </div>
                            <div class="pt-4">
                                <button class="w-full md:w-auto px-10 py-4 bg-gradient-to-r from-primary to-primary-container text-on-primary font-semibold rounded-lg hover:opacity-90 active:scale-[0.98] transition-all duration-200" type="button" onclick="alert('Message sent! (Mockuo)')">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="mt-auto w-full bg-surface-container-low border-t border-outline-variant/15">
        <div class="flex flex-col md:flex-row justify-between items-center px-10 py-8 max-w-[1440px] mx-auto text-[0.75rem] text-on-surface-variant uppercase tracking-[0.05em]">
            <p>© The Disciplined Canvas. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
