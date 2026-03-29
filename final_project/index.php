<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>The Disciplined Canvas | Build Habits That Last</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;display=swap" rel="stylesheet"/>
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface flex flex-col min-h-screen">
    <?php $active_page = 'index'; include 'components/header.php'; ?>

    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="relative px-6 py-20 md:py-32 flex flex-col items-center text-center bg-surface overflow-hidden">
            <div class="z-10 max-w-4xl">
                <span class="inline-block px-4 py-1.5 mb-6 text-[0.75rem] font-bold uppercase tracking-[0.05em] text-primary bg-primary-fixed rounded-full">Evolution through discipline</span>
                <h1 class="text-4xl md:text-7xl font-bold text-on-surface tracking-tight leading-[1.1] mb-8">Build Habits <br/><span class="text-primary">That Last</span></h1>
                <p class="text-base md:text-xl text-on-surface-variant mb-12 max-w-2xl mx-auto leading-relaxed px-4">
                    A premium digital sanctuary designed for those who value clarity over noise. Master your routine with an editorial-inspired interface that puts your progress first.
                </p>
                <div class="flex flex-col md:flex-row gap-4 justify-center items-center w-full px-6 md:px-0">
                    <a href="<?php echo $is_logged_in ? 'dashboard.php' : 'login.php'; ?>" class="w-full md:w-auto px-8 py-4 bg-gradient-to-r from-primary to-primary-container text-on-primary font-semibold rounded-lg shadow-lg hover:opacity-90 active:scale-95 transition-all">
                        Start Tracking
                    </a>
                    <button class="w-full md:w-auto px-8 py-4 bg-secondary-container text-on-secondary-container font-semibold rounded-lg hover:bg-surface-container-high transition-colors">
                        View Demo
                    </button>
                </div>
            </div>
            <!-- Decorative Architectural Elements -->
            <div class="absolute -bottom-1/4 -right-1/4 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl"></div>
            <div class="absolute -top-1/4 -left-1/4 w-[400px] h-[400px] bg-tertiary/5 rounded-full blur-3xl"></div>
        </section>

        <!-- Stats Section (Asymmetric) -->
        <section class="px-10 py-20 bg-surface-container-low">
            <div class="max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-12 gap-6">
                <div class="md:col-span-7 bg-surface-container-lowest p-10 rounded-xl flex flex-col justify-between min-h-[400px]">
                    <div>
                        <h2 class="text-[0.75rem] uppercase tracking-[0.05em] text-on-surface-variant font-bold mb-4">Focus Intensity</h2>
                        <p class="text-[3.5rem] font-bold text-on-surface leading-none tracking-tighter">94%</p>
                    </div>
                    <div class="mt-8">
                        <p class="text-on-surface-variant text-sm max-w-md">Our users report a significant increase in cognitive clarity within the first 14 days of using the Canvas system.</p>
                        <div class="mt-6 flex gap-2">
                            <div class="w-3 h-3 rounded-sm bg-tertiary"></div>
                            <div class="w-3 h-3 rounded-sm bg-tertiary"></div>
                            <div class="w-3 h-3 rounded-sm bg-tertiary"></div>
                            <div class="w-3 h-3 rounded-sm bg-tertiary"></div>
                            <div class="w-3 h-3 rounded-sm bg-surface-variant"></div>
                            <div class="w-3 h-3 rounded-sm bg-surface-variant"></div>
                            <div class="w-3 h-3 rounded-sm bg-surface-variant"></div>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-5 relative group overflow-hidden rounded-xl bg-surface-container-highest">
                    <img src="https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?q=80&w=1472&auto=format&fit=crop" alt="Minimalist setup" class="w-full h-full object-cover grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-on-surface/60 to-transparent flex items-end p-8">
                        <p class="text-white font-medium italic">"Simplicity is the ultimate sophistication."</p>
                    </div>
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
