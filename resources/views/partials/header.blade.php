<!-- Navigation -->
<nav class="fixed top-0 w-full z-50 bg-white/90 backdrop-blur-md shadow-sm border-b border-gray-200 dark:bg-gray-900/90 dark:border-gray-700" id="main-nav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                <img src="{{ asset('img/logo/capitanas.png') }}" alt="Capitanas Logo" loading="lazy" class="w-28">
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-touch touch-feedback touch-highlight text-gray-700 hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400 px-6 py-3 text-base font-medium rounded-lg">
                        Dashboard
                    </a>
                @else
                    {{-- <a href="{{ route('home') }}" class="btn-touch touch-feedback touch-highlight text-gray-700 hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400 px-6 py-3 text-base font-medium rounded-lg">
                        Inicio
                    </a> --}}
                    <a href="{{ route('learn') }}" class="btn-touch touch-feedback touch-highlight text-gray-700 hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400 px-6 py-3 text-base font-medium rounded-lg">
                        Conócenos
                    </a>
                    <a href="{{ route('touch.create') }}" class="btn-touch touch-feedback ripple bg-emerald-600 text-white px-8 py-3 rounded-lg text-base font-medium hover:bg-emerald-700 shadow-sm">
                        Contáctanos
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden mobile-icon-btn touch-feedback ripple rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800"
                    onclick="toggleMobileMenu()"
                    id="mobile-menu-button"
                    aria-label="Toggle navigation menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" id="menu-icon"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" id="close-icon" class="hidden"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation Menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                @auth
                    <a href="{{ url('/dashboard') }}" class="mobile-touch touch-feedback touch-highlight block text-gray-700 hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400 px-6 py-4 text-lg font-medium rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>Dashboard</span>
                        </div>
                    </a>
                @else
                    <a href="{{ route('home') }}" class="mobile-touch touch-feedback touch-highlight block text-gray-700 hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400 px-6 py-4 text-lg font-medium rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Inicio</span>
                        </div>
                    </a>
                    <a href="{{ route('learn') }}" class="mobile-touch touch-feedback touch-highlight block text-gray-700 hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400 px-6 py-4 text-lg font-medium rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Conócenos</span>
                        </div>
                    </a>
                    <a href="{{ route('touch.create') }}" class="mobile-touch touch-feedback ripple block bg-emerald-600 text-white px-6 py-4 rounded-lg text-lg font-medium hover:bg-emerald-700 shadow-sm mt-4">
                        <div class="flex items-center justify-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>Contáctanos</span>
                        </div>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Add top padding to body content to account for fixed header -->
<div class="pt-16"></div>

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    mobileMenu.classList.toggle('hidden');
    menuIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');

    // Prevent body scroll when menu is open
    if (mobileMenu.classList.contains('hidden')) {
        document.body.style.overflow = '';
    } else {
        document.body.style.overflow = 'hidden';
    }
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const nav = document.getElementById('main-nav');

    if (!nav.contains(event.target) && !mobileMenu.classList.contains('hidden')) {
        toggleMobileMenu();
    }
});

// Close mobile menu on window resize to desktop
window.addEventListener('resize', function() {
    const mobileMenu = document.getElementById('mobile-menu');
    if (window.innerWidth >= 768 && !mobileMenu.classList.contains('hidden')) {
        toggleMobileMenu();
    }
});
</script>
