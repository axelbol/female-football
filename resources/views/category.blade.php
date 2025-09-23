<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $category->name }} - Capitanas</title>

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

        <!-- Category Posts Section -->
        <section class="bg-white dark:bg-gray-900 py-16">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Category Header -->
                <div class="text-center mb-12">
                    <div class="mb-6">
                        <a href="{{ route('home') }}" class="inline-flex items-center space-x-2 text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>Back to All Stories</span>
                        </a>
                    </div>

                    <span class="inline-block bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 text-sm font-medium px-4 py-2 rounded-full mb-4">
                        {{ $category->name }}
                    </span>

                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                        Stories from {{ $category->name }}
                    </h1>

                    @if($category->description)
                        <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                            {{ $category->description }}
                        </p>
                    @endif

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">
                        {{ $posts->total() }} {{ Str::plural('story', $posts->total()) }} found
                    </p>
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

                                        <!-- Category Badge (smaller version) -->
                                        <div class="absolute top-4 left-4">
                                            <span class="inline-block bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 text-xs font-medium px-2 py-1 rounded-full">
                                                {{ $post->category->name }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Post Content -->
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-2">
                                            {{ $post->title }}
                                        </h3>

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
                            {{ $posts->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">No stories yet</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">
                                This category doesn't have any published stories yet. Check back soon for new content!
                            </p>
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
    </body>
</html>