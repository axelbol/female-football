<!-- Bottom Navigation Bar (Mobile Only) -->
<nav class="fixed bottom-0 left-0 right-0 z-40 md:hidden bg-white/95 backdrop-blur-md border-t border-gray-200 dark:bg-gray-900/95 dark:border-gray-700">
    <div class="px-4 py-2">
        <div class="flex justify-around items-center">
            <!-- Home -->
            <a href="{{ route('home') }}"
               class="mobile-icon-btn touch-feedback ripple flex flex-col items-center justify-center text-xs font-medium rounded-lg
                      {{ request()->routeIs('home') ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-600 hover:text-emerald-600 dark:text-gray-400 dark:hover:text-emerald-400' }}">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Inicio</span>
            </a>

            <!-- Search -->
            <button onclick="openMobileSearch()"
                    class="mobile-icon-btn touch-feedback ripple flex flex-col items-center justify-center text-xs font-medium text-gray-600 hover:text-emerald-600 dark:text-gray-400 dark:hover:text-emerald-400 rounded-lg">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <span>Buscar</span>
            </button>

            <!-- Learn/About -->
            <a href="{{ route('learn') }}"
               class="mobile-icon-btn touch-feedback ripple flex flex-col items-center justify-center text-xs font-medium rounded-lg
                      {{ request()->routeIs('learn') ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-600 hover:text-emerald-600 dark:text-gray-400 dark:hover:text-emerald-400' }}">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Acerca</span>
            </a>

            @auth
                <!-- Dashboard -->
                <a href="{{ url('/dashboard') }}"
                   class="mobile-icon-btn touch-feedback ripple flex flex-col items-center justify-center text-xs font-medium rounded-lg
                          {{ request()->is('dashboard*') ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-600 hover:text-emerald-600 dark:text-gray-400 dark:hover:text-emerald-400' }}">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span>Panel</span>
                </a>
            @else
                <!-- Contact -->
                <a href="{{ route('touch.create') }}"
                   class="mobile-icon-btn touch-feedback ripple flex flex-col items-center justify-center text-xs font-medium rounded-lg
                          {{ request()->routeIs('touch.create') ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-600 hover:text-emerald-600 dark:text-gray-400 dark:hover:text-emerald-400' }}">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>Contacto</span>
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- Mobile Search Overlay -->
<div id="mobile-search-overlay" class="fixed inset-0 z-50 hidden md:hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeMobileSearch()"></div>
    <div class="relative bg-white dark:bg-gray-900 p-6 rounded-t-2xl mt-20">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Buscar Historias</h3>
            <button onclick="closeMobileSearch()" class="mobile-icon-btn touch-feedback ripple text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form action="{{ route('posts.search') }}" method="GET" class="space-y-4">
            <div class="relative">
                <input type="text"
                       name="search"
                       placeholder="Buscar por título, jugadora, contenido..."
                       class="w-full px-4 py-4 text-lg border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                       autofocus>
                <button type="submit" class="mobile-icon-btn touch-feedback ripple absolute right-3 top-1/2 transform -translate-y-1/2 text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
            <button type="submit" class="mobile-touch touch-feedback ripple w-full bg-emerald-600 text-white py-4 rounded-xl text-lg font-medium hover:bg-emerald-700">
                Buscar
            </button>
        </form>
    </div>
</div>

<!-- Add bottom padding to body content to account for bottom nav -->
<div class="pb-20 md:pb-0"></div>

<script>
function openMobileSearch() {
    document.getElementById('mobile-search-overlay').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeMobileSearch() {
    document.getElementById('mobile-search-overlay').classList.add('hidden');
    document.body.style.overflow = '';
}

// Close search overlay on escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeMobileSearch();
    }
});
</script>