<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Search Results for "{{ $query }}" - Capitanas</title>

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
        <!-- Header -->
        @include('partials.header')

        <!-- Pull to Refresh -->
        @include('partials.pull-to-refresh')

        <!-- Breadcrumbs -->
        @include('partials.breadcrumbs')

        <!-- Search Results Section -->
        <section class="bg-white dark:bg-gray-900 py-16">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Search Header -->
                <div class="text-center mb-12">
                    <div class="mb-6">
                        <a href="{{ route('home') }}" class="inline-flex items-center space-x-2 text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>Back to All Stories</span>
                        </a>
                    </div>

                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                        Search Results
                    </h1>

                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed mb-4">
                        Showing results for <span class="font-semibold text-emerald-600 dark:text-emerald-400">"{{ $query }}"</span>
                    </p>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $posts->total() }} {{ Str::plural('result', $posts->total()) }} found
                    </p>

                    <!-- Search Form -->
                    <div class="mt-8 max-w-md mx-auto">
                        <form action="{{ route('posts.search') }}" method="GET">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text"
                                       name="q"
                                       value="{{ $query }}"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 text-lg"
                                       placeholder="Search for players, stories...">
                            </div>
                        </form>
                    </div>
                </div>

                @if($posts->count() > 0)
                    <!-- Posts Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                        @foreach($posts as $post)
                            <a href="{{ route('post.public', $post->slug) }}" class="group cursor-pointer">
                                <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group-hover:scale-105">
                                    <!-- Post Image -->
                                    <div class="relative h-48 overflow-hidden">
                                        @if($post->featured_image)
                                            <img src="{{ $post->featured_image }}"
                                                 alt="{{ $post->title }}"
                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-emerald-400 to-teal-500"></div>
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>

                                        <!-- Category Badge -->
                                        <div class="absolute top-4 left-4">
                                            <span class="inline-block bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 text-xs font-medium px-2 py-1 rounded-full">
                                                {{ $post->category->name }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Post Content -->
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-2">
                                            {{ $post->title }}
                                        </h3>

                                        @if($post->player_name)
                                            <p class="text-emerald-600 dark:text-emerald-400 font-medium text-sm mb-2">
                                                {{ $post->player_name }}
                                            </p>
                                        @endif

                                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                                            {{ $post->excerpt }}
                                        </p>

                                        <!-- Author and Meta -->
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                @if($post->user->avatar)
                                                    <img src="{{ $post->user->avatar }}"
                                                         alt="{{ $post->user->name }}"
                                                         class="w-8 h-8 rounded-full object-cover">
                                                @else
                                                    <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center">
                                                        <span class="text-white font-medium text-xs">{{ $post->user->initials() }}</span>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $post->user->name }}</p>
                                                </div>
                                            </div>

                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                                            </div>
                                        </div>

                                        <!-- Read Time -->
                                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                                <span class="flex items-center space-x-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span>{{ $post->read_time }} min read</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($posts->hasPages())
                        <div class="flex justify-center">
                            {{ $posts->appends(['q' => $query])->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">No results found</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">
                                We couldn't find any stories matching "<strong>{{ $query }}</strong>". Try searching for different keywords or player names.
                            </p>
                            <div class="space-y-2 text-sm text-gray-500 dark:text-gray-400 mb-6">
                                <p><strong>Search tips:</strong></p>
                                <ul class="text-left space-y-1">
                                    <li>• Try searching for player names</li>
                                    <li>• Use broader terms</li>
                                    <li>• Check for typos</li>
                                </ul>
                            </div>
                            <a href="{{ route('home') }}" class="inline-flex items-center space-x-2 bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span>Browse All Stories</span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!-- Footer -->
        @include('partials.footer')

        <!-- Bottom Navigation -->
        @include('partials.bottom-nav')
    </body>
</html>