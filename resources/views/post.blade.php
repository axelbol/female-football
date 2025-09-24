<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $post->title }} - Capitanas</title>

        <!-- Open Graph Meta Tags for Social Sharing -->
        <meta property="og:title" content="{{ $post->title }}">
        <meta property="og:description" content="{{ Str::limit($post->excerpt, 160) }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="article">
        <meta property="og:site_name" content="Capitanas">
        @if($post->featured_image)
        <meta property="og:image" content="{{ $post->featured_image }}">
        @elseif($post->hero_image)
        <meta property="og:image" content="{{ $post->hero_image }}">
        @endif

        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $post->title }}">
        <meta name="twitter:description" content="{{ Str::limit($post->excerpt, 160) }}">
        @if($post->featured_image)
        <meta name="twitter:image" content="{{ $post->featured_image }}">
        @elseif($post->hero_image)
        <meta name="twitter:image" content="{{ $post->hero_image }}">
        @endif

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

        <!-- Blog Post Section -->
        <section class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900">
            <!-- Hero Image -->
            <div class="relative h-64 md:h-80 lg:h-96 overflow-hidden">
                @if($post->hero_image)
                    <img src="{{ $post->hero_image }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover">
                @else
                    <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

                <!-- Back to Posts Button - Floating -->
                <div class="absolute top-6 left-6">
                    <a href="{{ route('home') }}" class="inline-flex items-center space-x-2 bg-white/90 backdrop-blur-sm text-gray-900 px-4 py-2 rounded-lg text-sm font-medium hover:bg-white transition-colors shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Back to Posts</span>
                    </a>
                </div>
            </div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Post Header -->
                <div class="py-12">
                    <!-- Category Badge -->
                    <div class="mb-6">
                        <a href="{{ route('category.show', $post->category->slug) }}" class="inline-block bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 text-sm font-medium px-3 py-1 rounded-full hover:bg-emerald-200 dark:hover:bg-emerald-800 transition-colors cursor-pointer">
                            {{ $post->category->name }}
                        </a>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ $post->title }}
                    </h1>

                    <!-- Description -->
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                        {{ $post->excerpt }}
                    </p>

                    <!-- Author and Date Info -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between py-6 border-t border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                            @if($post->user->avatar)
                                <img src="{{ $post->user->avatar }}"
                                     alt="{{ $post->user->name }}"
                                     class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div class="w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium text-sm">{{ $post->user->initials() }}</span>
                                </div>
                            @endif
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $post->user->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $post->user->title ?: 'Author' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 space-x-4">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $post->read_time }} min read</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article Content -->
                <article class="prose prose-lg prose-emerald max-w-none dark:prose-invert mb-16 prose-headings:text-gray-900 dark:prose-headings:text-white prose-p:text-gray-700 dark:prose-p:text-gray-300 prose-strong:text-gray-900 dark:prose-strong:text-white prose-blockquote:border-emerald-500 prose-blockquote:text-gray-700 dark:prose-blockquote:text-gray-300 prose-code:text-emerald-600 dark:prose-code:text-emerald-400 prose-pre:bg-gray-800 prose-pre:text-gray-100 prose-th:text-gray-900 dark:prose-th:text-white prose-td:text-gray-700 dark:prose-td:text-gray-300">
                    @if($post->featured_image)
                        <div class="my-12">
                            <img src="{{ $post->featured_image }}"
                                 alt="{{ $post->title }}"
                                 class="w-full h-64 md:h-80 object-cover rounded-xl shadow-lg">
                        </div>
                    @endif

                    <div class="leading-relaxed quill-content">
                        {!! $post->content !!}
                    </div>
                </article>

                <style>
                    .quill-content ol {
                        list-style-type: decimal;
                        margin-left: 1.5rem;
                        margin-bottom: 1rem;
                        padding-left: 0.5rem;
                    }

                    .quill-content ul {
                        list-style-type: disc;
                        margin-left: 1.5rem;
                        margin-bottom: 1rem;
                        padding-left: 0.5rem;
                    }

                    .quill-content li {
                        margin-bottom: 0.5rem;
                        color: rgb(55 65 81);
                    }

                    .dark .quill-content li {
                        color: rgb(209 213 219);
                    }

                    .quill-content blockquote {
                        border-left: 4px solid rgb(16 185 129);
                        padding-left: 1rem;
                        margin: 1.5rem 0;
                        font-style: italic;
                        background-color: rgb(243 244 246);
                        padding: 1rem;
                        border-radius: 0.5rem;
                        color: rgb(55 65 81);
                    }

                    .dark .quill-content blockquote {
                        background-color: rgb(31 41 55);
                        color: rgb(209 213 219);
                    }

                    .quill-content .ql-indent-1 { margin-left: 3rem; }
                    .quill-content .ql-indent-2 { margin-left: 4.5rem; }
                    .quill-content .ql-indent-3 { margin-left: 6rem; }
                    .quill-content .ql-indent-4 { margin-left: 7.5rem; }
                    .quill-content .ql-indent-5 { margin-left: 9rem; }
                    .quill-content .ql-indent-6 { margin-left: 10.5rem; }
                    .quill-content .ql-indent-7 { margin-left: 12rem; }
                    .quill-content .ql-indent-8 { margin-left: 13.5rem; }

                    .quill-content .ql-align-center { text-align: center; }
                    .quill-content .ql-align-right { text-align: right; }
                    .quill-content .ql-align-justify { text-align: justify; }
                </style>

                <!-- Social Sharing and Navigation -->
                <div class="border-t border-gray-200 dark:border-gray-700 pt-8 mb-16">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                        <!-- Social Sharing -->
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Share this story:</span>
                            <div class="flex space-x-3">
                                <!-- Facebook Share -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                   target="_blank"
                                   class="inline-flex items-center justify-center w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>

                                <!-- LinkedIn Share -->
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                   target="_blank"
                                   class="inline-flex items-center justify-center w-10 h-10 bg-blue-700 hover:bg-blue-800 text-white rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>

                                <!-- Twitter Share -->
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title . ' - ' . Str::limit($post->excerpt, 100)) }}"
                                   target="_blank"
                                   class="inline-flex items-center justify-center w-10 h-10 bg-sky-500 hover:bg-sky-600 text-white rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Back to Posts Button -->
                        <a href="{{ route('home') }}" class="inline-flex items-center space-x-2 bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>All Stories</span>
                        </a>
                    </div>
                </div>

                <!-- Related Posts Section -->
                @if($relatedPosts->count() > 0)
                <div class="border-t border-gray-200 dark:border-gray-700 pt-16 pb-20">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">You might also like</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($relatedPosts as $relatedPost)
                        <a href="{{ route('post.public', $relatedPost->slug) }}" class="group cursor-pointer">
                            <div class="relative h-48 rounded-xl mb-4 group-hover:scale-105 transition-transform duration-200 overflow-hidden">
                                @if($relatedPost->featured_image)
                                    <img src="{{ $relatedPost->featured_image }}"
                                         alt="{{ $relatedPost->title }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-emerald-400 to-teal-500"></div>
                                @endif
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition-colors"></div>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                {{ $relatedPost->title }}
                            </h4>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                {{ Str::limit($relatedPost->excerpt, 100) }}
                            </p>
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <span>{{ $relatedPost->user->name }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $relatedPost->read_time }} min read</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- Footer -->
        @include('partials.footer')
    </body>
</html>
