<!-- Navigation -->
<nav class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-200 dark:bg-gray-900/80 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                <img src="{{ asset('img/logo/3-removebg-preview.png') }}" alt="Capitanas Logo" class="w-28">
                {{-- <h1 class="text-xl font-bold text-gray-900 dark:text-white">Capitanas</h1> --}}
            </a>

            @if (Route::has('login'))
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400 px-3 py-2 text-sm font-medium transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400 px-3 py-2 text-sm font-medium transition-colors">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-emerald-700 transition-colors">
                                Join Us
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</nav>
