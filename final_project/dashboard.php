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
    <title>Dashboard | The Disciplined Canvas</title>
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
<body class="bg-surface text-on-surface min-h-screen flex flex-col">
    <!-- TopAppBar -->
    <?php $active_page = 'dashboard'; include 'components/header.php'; ?>

    <main class="flex-grow max-w-[1440px] mx-auto w-full px-6 md:px-10 py-12">
        <!-- Hero Header -->
        <section class="mb-12 text-center md:text-left">
            <h1 class="text-4xl md:text-[3.5rem] font-bold tracking-tight text-on-surface leading-tight mb-2">Welcome back, <?php echo htmlspecialchars($user_name); ?>!</h1>
            <p class="text-on-surface-variant text-base md:text-lg">Consistency is the bridge between goals and accomplishment.</p>
        </section>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-surface-container-lowest p-8 rounded-xl flex flex-col justify-between h-48">
                <span class="text-xs font-bold uppercase tracking-[0.05em] text-on-surface-variant">Overall Progress</span>
                <div class="flex items-baseline gap-2">
                    <span id="avgProgress" class="text-5xl font-bold text-primary">0%</span>
                    <span class="text-on-surface-variant text-sm">Completed</span>
                </div>
                <div class="w-full bg-surface-container-highest h-1 rounded-full overflow-hidden">
                    <div id="progressBar" class="bg-primary h-full w-0 transition-all duration-500"></div>
                </div>
            </div>
            <div class="bg-surface-container-lowest p-8 rounded-xl flex flex-col justify-between h-48 border-l-4 border-tertiary">
                <span class="text-xs font-bold uppercase tracking-[0.05em] text-on-surface-variant">Top Streak</span>
                <div class="flex items-baseline gap-2">
                    <span id="topStreak" class="text-5xl font-bold text-tertiary">0</span>
                    <span class="text-on-surface-variant text-sm">Days</span>
                </div>
                <div id="streakDots" class="flex gap-1">
                    <!-- Dots will be injected here -->
                </div>
            </div>
            <!-- Quick Tip -->
            <div class="bg-primary text-on-primary p-8 rounded-xl flex flex-col justify-between h-48 bg-gradient-to-br from-primary to-primary-container">
                <span class="text-xs font-bold uppercase tracking-[0.05em] opacity-80">Quick Tip</span>
                <span class="text-2xl font-semibold leading-snug">Small actions today create massive results tomorrow. Stay disciplined.</span>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Habit List Section (Left) -->
            <div class="lg:col-span-2">
                <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
                    <h2 class="text-xl font-bold tracking-tight text-on-surface">Today's Discipline</h2>
                    <a href="add_habit.php" class="w-full md:w-auto flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-primary-container text-on-primary px-6 py-3 md:py-2 rounded-lg font-medium active:scale-95 transition-all shadow-md">
                        <span class="material-symbols-outlined text-[1.2rem]">add</span>
                        New Habit
                    </a>
                </div>

                <div id="habitList" class="flex flex-col gap-6">
                    <!-- Habits will be injected here by JS -->
                    <div class="text-center py-20 text-on-surface-variant">
                        <p>Loading your routine...</p>
                    </div>
                </div>
            </div>

            <!-- Dashboard Widgets (Right) -->
            <div class="flex flex-col gap-8">
                <!-- Daily To-Do -->
                <div class="bg-surface-container-lowest p-6 rounded-xl flex flex-col min-h-[400px] border border-outline-variant shadow-sm sticky top-24">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold uppercase tracking-[0.05em] text-on-surface-variant">Daily To-Do</span>
                            <span class="text-[0.65rem] text-primary font-bold">TODAY'S FOCUS</span>
                        </div>
                        <span class="material-symbols-outlined text-outline-variant">assignment</span>
                    </div>
                    
                    <div id="todoList" class="flex flex-col gap-4 mb-6 overflow-y-auto max-h-[300px] custom-scrollbar pr-2">
                        <!-- Todos will be injected here -->
                    </div>

                    <div class="mt-auto pt-4 border-t border-outline-variant">
                        <div class="flex items-center gap-2 bg-surface-container-low rounded-lg px-3 py-1 border border-outline-variant/30 focus-within:border-primary transition-colors">
                            <input type="text" id="todoInput" placeholder="Add a quick task..." 
                                   class="flex-1 bg-transparent border-none focus:ring-0 text-sm py-2 placeholder:text-on-surface-variant/40"
                                   onkeypress="handleTodoKey(event)">
                            <button onclick="addTodo()" class="text-primary hover:scale-110 active:scale-90 transition-all p-1">
                                <span class="material-symbols-outlined text-[1.5rem]">add_circle</span>
                            </button>
                        </div>
                        <p class="text-[0.65rem] text-center text-on-surface-variant/50 mt-3 italic">Tasks reset every midnight</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        async function fetchDashboardData() {
            try {
                // 1. Fetch habits
                const habitRes = await fetch('habits/read.php');
                const habitData = await habitRes.json();
                
                // 2. Fetch progress stats
                const progressRes = await fetch('progress/get_progress.php?period=7');
                const progressData = await progressRes.json();

                if (habitData.success && progressData.success) {
                    renderHabits(habitData.habits, progressData.data);
                    renderStats(progressData.data);
                }

                // 3. Fetch todos
                fetchTodos();
            } catch (err) {
                console.error('Error fetching dashboard data:', err);
            }
        }

        async function fetchTodos() {
            try {
                const res = await fetch('todos/read.php');
                const data = await res.json();
                if (data.success) {
                    renderTodos(data.todos);
                }
            } catch (err) {
                console.error('Error fetching todos:', err);
            }
        }

        function renderTodos(todos) {
            const list = document.getElementById('todoList');
            if (todos.length === 0) {
                list.innerHTML = `
                    <div class="text-center py-4 text-on-surface-variant/40 italic text-sm">
                        No tasks for today
                    </div>
                `;
                return;
            }

            list.innerHTML = todos.map(todo => {
                const completed = Boolean(Number(todo.is_completed));
                return `
                <div class="group flex items-center justify-between gap-2 py-1">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <button onclick="toggleTodo(${todo.id})" 
                                class="w-5 h-5 rounded-md border ${completed ? 'bg-primary border-primary text-on-primary' : 'border-outline-variant hover:border-primary'} flex items-center justify-center transition-all shrink-0">
                            ${completed ? '<span class="material-symbols-outlined text-[0.8rem] font-bold">check</span>' : ''}
                        </button>
                        <span class="text-sm truncate ${completed ? 'line-through text-on-surface-variant/50' : 'text-on-surface'}">
                            ${todo.task}
                        </span>
                    </div>
                    <button onclick="deleteTodo(${todo.id})" class="opacity-0 group-hover:opacity-100 text-on-surface-variant hover:text-error transition-all p-1">
                        <span class="material-symbols-outlined text-[1rem]">close</span>
                    </button>
                </div>
            `;}).join('');
        }

        function handleTodoKey(e) {
            if (e.key === 'Enter') addTodo();
        }

        async function addTodo() {
            const input = document.getElementById('todoInput');
            const task = input.value.trim();
            if (!task) return;

            const formData = new FormData();
            formData.append('task', task);

            try {
                const res = await fetch('todos/create.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) {
                    input.value = '';
                    fetchTodos();
                } else {
                    alert(data.error);
                }
            } catch (err) {
                console.error(err);
            }
        }

        async function toggleTodo(id) {
            const formData = new FormData();
            formData.append('id', id);
            try {
                const res = await fetch('todos/toggle.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) {
                    fetchTodos();
                }
            } catch (err) {
                console.error(err);
            }
        }

        async function deleteTodo(id) {
            const formData = new FormData();
            formData.append('id', id);
            try {
                const res = await fetch('todos/delete.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) {
                    fetchTodos();
                }
            } catch (err) {
                console.error(err);
            }
        }

        function renderHabits(habits, stats) {
            const list = document.getElementById('habitList');
            if (habits.length === 0) {
                list.innerHTML = `
                    <div class="bg-surface-container-lowest p-12 rounded-lg text-center border-2 border-dashed border-outline-variant">
                        <p class="text-on-surface-variant mb-4">No habits defined yet. Start your journey by adding one.</p>
                        <a href="add_habit.php" class="text-primary font-bold hover:underline">Add First Habit</a>
                    </div>
                `;
                return;
            }

            list.innerHTML = '';
            habits.forEach(habit => {
                console.log(`Habit: ${habit.title}, completed_today: ${habit.completed_today} (Type: ${typeof habit.completed_today})`);
                const habitStat = stats.find(s => s.id == habit.id) || { streak: 0 };
                const isCompleted = Number(habit.completed_today) === 1;
                
                const card = document.createElement('div');
                card.className = isCompleted 
                    ? 'bg-tertiary-container group flex items-center justify-between p-6 rounded-lg transition-all duration-300'
                    : 'bg-surface-container-lowest group flex items-center justify-between p-6 rounded-lg transition-all duration-300 hover:bg-surface-container-high';
                
                card.innerHTML = `
                    <div class="flex items-center gap-6">
                        <button onclick="toggleCompletion(${habit.id}, ${isCompleted})" 
                            class="w-8 h-8 rounded-lg ${isCompleted ? 'bg-tertiary text-on-tertiary' : 'border-2 border-outline-variant hover:border-primary'} flex items-center justify-center transition-all">
                            ${isCompleted ? '<span class="material-symbols-outlined text-[1.2rem]">check</span>' : ''}
                        </button>
                        <div>
                            <h3 class="text-lg font-semibold ${isCompleted ? 'text-on-tertiary-container' : 'text-on-surface'}">${habit.title}</h3>
                            <div class="flex items-center gap-3 mt-1">
                                <span class="text-xs font-bold uppercase tracking-[0.05em] ${isCompleted ? 'text-on-tertiary-fixed-variant bg-tertiary-fixed' : 'text-on-primary-fixed bg-primary-fixed'} px-2 py-0.5 rounded-full">
                                    ${habitStat.streak} day streak
                                </span>
                                <span class="text-xs font-medium ${isCompleted ? 'text-on-tertiary-container/70' : 'text-on-surface-variant'}">
                                    ${habit.description || 'No description'}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button onclick="deleteHabit(${habit.id})" class="${isCompleted ? 'text-on-tertiary-container' : 'text-on-surface-variant'} hover:text-error transition-colors p-2">
                            <span class="material-symbols-outlined text-[1.2rem]">delete</span>
                        </button>
                    </div>
                `;
                list.appendChild(card);
            });
        }

        async function toggleCompletion(id, alreadyDone) {
            
            const formData = new FormData();
            formData.append('id', id);
            
            try {
                const res = await fetch('habits/complete.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) {
                    fetchDashboardData();
                } else {
                    alert(data.error);
                }
            } catch (err) {
                console.error(err);
            }
        }

        async function deleteHabit(id) {
            if (!confirm('Are you sure you want to delete this habit?')) return;
            
            const formData = new FormData();
            formData.append('id', id);
            
            try {
                const res = await fetch('habits/delete.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) {
                    fetchDashboardData();
                }
            } catch (err) {
                console.error(err);
            }
        }

        function renderStats(stats) {
            if (stats.length === 0) return;
            
            let totalProg = 0;
            let maxStr = 0;
            stats.forEach(s => {
                totalProg += s.progress;
                if (s.streak > maxStr) maxStr = s.streak;
            });
            
            const avg = Math.round(totalProg / stats.length);
            document.getElementById('avgProgress').textContent = avg + '%';
            document.getElementById('progressBar').style.width = avg + '%';
            document.getElementById('topStreak').textContent = maxStr;
            
            const dots = document.getElementById('streakDots');
            dots.innerHTML = '';
            for (let i = 0; i < 7; i++) {
                const dot = document.createElement('div');
                dot.className = `w-3 h-3 rounded-sm ${i < (maxStr % 7 || (maxStr > 0 ? 7 : 0)) ? 'bg-tertiary' : 'bg-surface-variant'}`;
                dots.appendChild(dot);
            }
        }

        fetchDashboardData();
    </script>
</body>
</html>
