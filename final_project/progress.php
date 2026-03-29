<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$user_name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Progress | The Disciplined Canvas</title>
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
<body class="bg-surface text-on-surface">
    <!-- TopAppBar -->
    <?php $active_page = 'progress'; include 'components/header.php'; ?>

    <main class="max-w-[1440px] mx-auto px-6 md:px-10 py-12">
        <!-- Hero Section -->
        <section class="mb-16 text-center md:text-left">
            <p class="font-inter text-[0.75rem] uppercase tracking-[0.05em] text-secondary mb-2">Performance Analytics</p>
            <h2 class="text-4xl md:text-7xl font-bold tracking-tighter text-on-surface mb-6 leading-tight">Your Progress</h2>
            <div class="flex flex-col md:flex-row md:items-end gap-8 justify-center md:justify-start">
                <div>
                    <span id="overallPercent" class="text-5xl md:text-[3.5rem] font-bold leading-none text-primary">0%</span>
                    <p class="font-inter text-[0.875rem] text-on-surface-variant mt-2 max-w-xs mx-auto md:mx-0">Weekly completion rate based on your active habits.</p>
                </div>
                <div class="flex justify-center gap-4 mb-2">
                    <div class="px-4 py-2 bg-primary-fixed rounded-full">
                        <span id="streakBadge" class="text-[0.75rem] font-bold uppercase tracking-wider text-on-primary-fixed">0 Day Streak</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <!-- Main Chart: Last 7 Days -->
            <div class="md:col-span-8 bg-surface-container-low p-8 rounded-xl flex flex-col justify-between">
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-on-surface mb-1">Weekly Consistency</h3>
                    <p class="text-[0.875rem] text-on-surface-variant">Completion frequency over the last 7 cycles</p>
                </div>
                <div id="chartContainer" class="flex items-end justify-between h-64 gap-2 pt-4">
                    <!-- Bars will be injected here -->
                    <div class="w-full text-center text-on-surface-variant">Loading consistency data...</div>
                </div>
            </div>

            <!-- Achievement Card -->
            <div class="md:col-span-4 flex flex-col gap-6">
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm flex items-start gap-4">
                    <div class="w-12 h-12 rounded-lg bg-tertiary-container flex items-center justify-center text-on-tertiary-container">
                        <span class="material-symbols-outlined">military_tech</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-on-surface">Consistency is Key</h4>
                        <p class="text-sm text-on-surface-variant">Your momentum is building. Keep going to unlock new milestones.</p>
                    </div>
                </div>
                <div class="relative h-full min-h-[200px] rounded-xl overflow-hidden group">
                    <img src="https://images.unsplash.com/photo-1506784983877-45594efa4cbe?q=80&w=1468&auto=format&fit=crop" alt="Analytic texture" class="absolute inset-0 w-full h-full object-cover grayscale opacity-50">
                    <div class="absolute inset-0 bg-primary/20 mix-blend-multiply"></div>
                    <div class="absolute bottom-6 left-6 right-6 font-bold text-white text-lg italic">
                        "The goal is not to be perfect, it's to be better than yesterday."
                    </div>
                </div>
            </div>

            <!-- Habit Breakdown List -->
            <div class="md:col-span-12 mt-4">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold tracking-tight text-on-surface">Habit Breakdown</h3>
                </div>
                <div id="breakdownList" class="space-y-6">
                    <!-- Habit progress bars will be injected here -->
                </div>
            </div>
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
        async function fetchProgressData() {
            try {
                // 1. Fetch breakdown
                const progressRes = await fetch('progress/get_progress.php?period=7');
                const progressData = await progressRes.json();
                
                // 2. Fetch chart data
                const chartRes = await fetch('progress/chart_data.php?period=7');
                const chartData = await chartRes.json();

                if (progressData.success) {
                    renderBreakdown(progressData.data);
                    calculateSummary(progressData.data);
                } else if (progressData.error) {
                    console.error('Progress Data Error:', progressData.error);
                }
                
                if (Array.isArray(chartData)) {
                    renderChart(chartData);
                } else if (chartData.error) {
                    console.error('Chart Data Error:', chartData.error);
                    document.getElementById('chartContainer').innerHTML = `<div class="w-full text-center text-error">Error: ${chartData.error}</div>`;
                } else {
                    document.getElementById('chartContainer').innerHTML = `<div class="w-full text-center text-on-surface-variant">No consistency data found.</div>`;
                }
            } catch (err) {
                console.error('Error fetching progress data:', err);
                document.getElementById('chartContainer').innerHTML = `<div class="w-full text-center text-error">Failed to load chart data.</div>`;
            }
        }

        function calculateSummary(data) {
            if (data.length === 0) return;
            let totalProg = 0;
            let maxStr = 0;
            data.forEach(s => {
                totalProg += s.progress;
                if (s.streak > maxStr) maxStr = s.streak;
            });
            const avg = Math.round(totalProg / data.length);
            document.getElementById('overallPercent').textContent = avg + '%';
            document.getElementById('streakBadge').textContent = maxStr + ' Day Streak';
        }

        function renderChart(data) {
            const container = document.getElementById('chartContainer');
            container.innerHTML = '';

            if (!data || data.length === 0) {
                container.innerHTML = '<div class="w-full text-center text-on-surface-variant">No data to display.</div>';
                return;
            }
            
            // Get max completions for scaling
            const maxCompletions = Math.max(...data.map(d => d.completed), 0);
            const scaleMax = maxCompletions > 0 ? maxCompletions : 1;

            data.forEach(day => {
                const dateObj = new DateTime(day.date);
                const dayName = new Intl.DateTimeFormat('en-US', { weekday: 'short' }).format(dateObj);
                const height = (day.completed / scaleMax) * 100;
                
                const bar = document.createElement('div');
                bar.className = 'flex-1 flex flex-col items-center gap-4 group h-full justify-end';
                bar.innerHTML = `
                    <div class="w-full ${day.completed > 0 ? 'bg-primary' : 'bg-surface-container-highest'} rounded-t-sm transition-all duration-300 group-hover:opacity-80" 
                         style="height: ${height}%; min-height: ${day.completed > 0 ? '4px' : '0'}"
                         title="${day.completed} completions on ${day.date}"></div>
                    <span class="font-inter text-[0.75rem] uppercase tracking-wider text-secondary">${dayName}</span>
                `;
                container.appendChild(bar);
            });
        }
        
        // Helper for date formatting in chart
        function DateTime(dateStr) {
            return new Date(dateStr + 'T00:00:00');
        }

        function renderBreakdown(data) {
            const list = document.getElementById('breakdownList');
            if (data.length === 0) {
                list.innerHTML = '<p class="text-on-surface-variant">No data available yet.</p>';
                return;
            }
            
            list.innerHTML = '';
            data.forEach(item => {
                const row = document.createElement('div');
                row.className = 'bg-surface-container-low p-6 rounded-xl flex flex-col md:flex-row md:items-center justify-between gap-6';
                row.innerHTML = `
                    <div class="flex items-center gap-4 min-w-[240px]">
                        <div class="w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">circle</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-on-surface">${item.title}</h4>
                            <p class="text-[0.75rem] text-on-surface-variant uppercase tracking-wider">7 Day Intensity</p>
                        </div>
                    </div>
                    <div class="flex-grow max-w-2xl">
                        <div class="flex justify-between mb-2">
                            <span class="text-[0.875rem] font-medium text-on-surface">Weekly Progress</span>
                            <span class="text-[0.875rem] font-bold text-primary">${item.progress}%</span>
                        </div>
                        <div class="w-full h-2 bg-surface-container-highest rounded-full overflow-hidden">
                            <div class="bg-primary h-full rounded-full" style="width: ${item.progress}%"></div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-1 bg-surface-container-high rounded-full">
                        <span class="text-[0.75rem] font-bold uppercase text-on-surface-variant">${item.streak} Day Streak</span>
                    </div>
                `;
                list.appendChild(row);
            });
        }

        fetchProgressData();
    </script>
</body>
</html>
