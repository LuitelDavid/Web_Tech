<?php
if (!isset($active_page)) $active_page = '';
$is_logged_in = isset($_SESSION['user_id']);
$user_name = $_SESSION['user_name'] ?? '';
?>
<!-- TopAppBar -->
<header class="w-full sticky top-0 z-50 bg-[#f7f9fb] dark:bg-slate-950 border-b border-outline-variant/5">
    <div class="flex items-center justify-between px-6 md:px-10 py-4 max-w-[1440px] mx-auto">
        <div class="flex items-center gap-4">
            <button id="mobileMenuBtn" class="md:hidden text-primary p-2 hover:bg-surface-container-high rounded-full active:scale-95 transition-all">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <a href="index.php" class="text-xl font-bold tracking-tighter text-on-surface dark:text-slate-100 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[1.5rem] hidden md:block">architecture</span>
                The Disciplined Canvas
            </a>
        </div>
        
        <nav class="hidden md:flex items-center gap-8 font-inter text-sm tracking-tight font-medium">
            <a class="<?php echo $active_page === 'index' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-on-surface transition-all'; ?> py-1" href="index.php">Home</a>
            <a class="<?php echo $active_page === 'about' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-on-surface transition-all'; ?> py-1" href="about.php">About</a>
            <?php if ($is_logged_in): ?>
                <a class="<?php echo $active_page === 'dashboard' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-on-surface transition-all'; ?> py-1" href="dashboard.php">Dashboard</a>
                <a class="<?php echo $active_page === 'progress' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-on-surface transition-all'; ?> py-1" href="progress.php">Progress</a>
            <?php else: ?>
                <a class="<?php echo $active_page === 'login' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-on-surface transition-all'; ?> py-1" href="login.php">Login</a>
            <?php endif; ?>
            <a class="<?php echo $active_page === 'contact' ? 'text-primary font-bold border-b-2 border-primary' : 'text-on-surface-variant hover:text-on-surface transition-all'; ?> py-1" href="contact.php">Contact</a>
        </nav>

        <?php if ($is_logged_in): ?>
        <div class="flex items-center gap-4">
            <a href="auth/logout.php" class="hidden md:block text-[0.75rem] font-bold uppercase tracking-widest text-on-surface-variant hover:text-error transition-colors">Logout</a>
            <div class="h-10 w-10 rounded-full bg-surface-container-highest flex items-center justify-center font-bold text-primary">
                <?php echo substr($user_name, 0, 1); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</header>

<!-- Mobile Side Drawer -->
<div id="mobileDrawer" class="fixed inset-0 z-[60] bg-on-background/20 backdrop-blur-sm hidden transition-opacity duration-300">
    <div class="absolute inset-y-0 left-0 w-80 bg-surface shadow-2xl p-8 flex flex-col">
        <div class="flex items-center justify-between mb-10">
            <span class="text-xl font-bold tracking-tighter text-on-surface">Menu</span>
            <button id="closeDrawerBtn" class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors p-2">close</button>
        </div>
        
        <nav class="flex flex-col gap-6 font-inter text-lg">
            <a class="<?php echo $active_page === 'index' ? 'text-primary font-bold' : 'text-on-surface-variant'; ?>" href="index.php">Home</a>
            <a class="<?php echo $active_page === 'about' ? 'text-primary font-bold' : 'text-on-surface-variant'; ?>" href="about.php">About</a>
            <?php if ($is_logged_in): ?>
                <a class="<?php echo $active_page === 'dashboard' ? 'text-primary font-bold' : 'text-on-surface-variant'; ?>" href="dashboard.php">Dashboard</a>
                <a class="<?php echo $active_page === 'progress' ? 'text-primary font-bold' : 'text-on-surface-variant'; ?>" href="progress.php">Progress</a>
                <hr class="border-outline-variant/20 -mx-8 my-2">
                <a class="text-on-surface-variant hover:text-error transition-colors" href="auth/logout.php">Logout</a>
            <?php else: ?>
                <a class="<?php echo $active_page === 'login' ? 'text-primary font-bold' : 'text-on-surface-variant'; ?>" href="login.php">Login</a>
            <?php endif; ?>
            <a class="<?php echo $active_page === 'contact' ? 'text-primary font-bold' : 'text-on-surface-variant'; ?>" href="contact.php">Contact</a>
        </nav>

        <div class="mt-auto pt-8 border-t border-outline-variant/20">
            <p class="text-[0.75rem] font-bold uppercase tracking-[0.05em] text-on-surface-variant">© The Disciplined Canvas</p>
        </div>
    </div>
</div>

<script>
    (function() {
        const drawer = document.getElementById('mobileDrawer');
        const openBtn = document.getElementById('mobileMenuBtn');
        const closeBtn = document.getElementById('closeDrawerBtn');

        if (openBtn) {
            openBtn.addEventListener('click', () => {
                drawer.classList.remove('hidden');
                setTimeout(() => drawer.classList.add('opacity-100'), 10);
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                drawer.classList.remove('opacity-100');
                setTimeout(() => drawer.classList.add('hidden'), 300);
            });
        }
        
        // Close on escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                drawer.classList.remove('opacity-100');
                setTimeout(() => drawer.classList.add('hidden'), 300);
            }
        });
    })();
</script>
