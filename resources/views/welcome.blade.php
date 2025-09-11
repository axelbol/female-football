<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Her Game - Stories of Women in Football</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-br from-emerald-50 to-teal-100 dark:from-gray-900 dark:to-gray-800 text-gray-900 dark:text-gray-100 min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-200 dark:bg-gray-900/80 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-sm">⚽</span>
                        </div>
                        <h1 class="text-xl font-bold text-gray-900 dark:text-white">Her Game</h1>
                    </div>

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

        <!-- Sections -->
        @include('partials.section')

        <!-- Call to Action Section -->
        <section class="py-20 bg-gradient-to-r from-emerald-600 to-teal-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl lg:text-4xl font-bold mb-6">
                    Ready to Share Your Journey?
                </h2>
                <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
                    Your story could inspire thousands of young girls to chase their football dreams. Join our community of incredible women making a difference.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white text-emerald-600 px-8 py-3 rounded-lg text-lg font-medium hover:bg-gray-50 transition-colors">
                            Get Started
                        </a>
                    @endif
                    <a href="#" class="border-2 border-white text-white px-8 py-3 rounded-lg text-lg font-medium hover:bg-white/10 transition-colors">
                        Learn More
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="flex items-center justify-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-sm">⚽</span>
                        </div>
                        <h3 class="text-xl font-bold">Her Game</h3>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Empowering women's voices in football, one story at a time.
                    </p>
                    <p class="text-sm text-gray-500">
                        © 2024 Her Game. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>
