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

        <!-- Blog Post Section -->
        <section class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900">
            <!-- Hero Image -->
            <div class="relative h-64 md:h-80 lg:h-96 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                     alt="Women's football team celebrating"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

                <!-- Back to Posts Button - Floating -->
                <div class="absolute top-6 left-6">
                    <a href="#" class="inline-flex items-center space-x-2 bg-white/90 backdrop-blur-sm text-gray-900 px-4 py-2 rounded-lg text-sm font-medium hover:bg-white transition-colors shadow-lg">
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
                        <span class="inline-block bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 text-sm font-medium px-3 py-1 rounded-full">
                            Professional Journey
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        Breaking Barriers in Professional Football: A Journey of Determination
                    </h1>

                    <!-- Description -->
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                        From being the only girl in youth leagues to signing my first professional contract, this journey taught me that persistence beats talent when talent doesn't persist. Here's how I navigated the challenges and triumphs of women's football.
                    </p>

                    <!-- Author and Date Info -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between py-6 border-t border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                            <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                                 alt="Alexandra Lopez"
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white">Alexandra Lopez</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Professional Footballer & Advocate</p>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 space-x-4">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>March 15, 2024</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>8 min read</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article Content -->
                <article class="prose prose-lg prose-emerald max-w-none dark:prose-invert mb-16">
                    <!-- First Section -->
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mt-12 mb-6">
                        The Early Days: Fighting for Recognition
                    </h2>

                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                        Growing up in a small town where football was considered "a boys' game," I faced my first challenge before I even stepped onto a pitch. At age 7, I remember standing at the edge of the local football field, watching the boys practice, knowing I could play just as well – if not better – than half of them.
                    </p>

                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                        My parents were supportive, but the local coaches were skeptical. "Girls don't have the physical strength," they'd say, or "Football is too rough for girls." But I was determined. I practiced every day in our backyard, perfecting my touches, working on my speed, and building the mental resilience that would serve me throughout my career.
                    </p>

                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-8">
                        When I finally convinced a coach to let me try out for the youth team, I was the only girl among 30 boys. The pressure was immense – I knew I had to be twice as good to get half the recognition. But that pressure became my fuel.
                    </p>

                    <!-- Middle Image -->
                    <div class="my-12">
                        <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                             alt="Young women training on football field"
                             class="w-full h-64 md:h-80 object-cover rounded-xl shadow-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-400 text-center mt-4 italic">
                            Training with dedication: Every practice session was an opportunity to prove myself
                        </p>
                    </div>

                    <!-- Second Section -->
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mt-12 mb-6">
                        The Professional Breakthrough: Making Dreams Reality
                    </h2>

                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                        Years of dedication finally paid off when I received my first professional contract at age 19. The moment I held that contract in my hands, I thought about that 7-year-old girl watching from the sidelines, dreaming of this exact moment.
                    </p>

                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                        Professional football brought new challenges: higher stakes, more intense training, and the pressure to perform at the highest level consistently. But it also brought incredible opportunities – to inspire young girls, to be part of a growing movement in women's football, and to push the boundaries of what's possible.
                    </p>

                    <blockquote class="border-l-4 border-emerald-500 pl-6 my-8 text-lg italic text-gray-800 dark:text-gray-200">
                        "Success isn't just about reaching your goals – it's about the doors you open for others along the way. Every time a young girl sees a woman succeeding in football, it expands her vision of what's possible."
                    </blockquote>

                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                        Today, I'm not just playing the sport I love – I'm part of a revolution. Women's football is growing rapidly, with increasing support, better facilities, and more opportunities than ever before. But there's still work to be done, and I'm committed to being part of that progress.
                    </p>

                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-8">
                        To every young girl reading this: your dreams are valid, your ambitions are achievable, and your voice matters. The pitch is waiting for you – all you have to do is step onto it.
                    </p>
                </article>

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

                                <!-- Twitter Share -->
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text=Breaking Barriers in Professional Football"
                                   target="_blank"
                                   class="inline-flex items-center justify-center w-10 h-10 bg-sky-500 hover:bg-sky-600 text-white rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Back to Posts Button -->
                        <a href="#" class="inline-flex items-center space-x-2 bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>All Stories</span>
                        </a>
                    </div>
                </div>

                <!-- Related Posts Section -->
                <div class="border-t border-gray-200 dark:border-gray-700 pt-16 pb-20">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">You might also like</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Related Post 1 -->
                        <div class="group cursor-pointer">
                            <div class="h-48 bg-gradient-to-br from-purple-400 to-pink-500 rounded-xl mb-4 group-hover:scale-105 transition-transform duration-200"></div>
                            <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                Overcoming Adversity in Women's Football
                            </h4>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                When they said girls couldn't play, I proved them wrong on every pitch...
                            </p>
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <span>Emma Thompson</span>
                                <span class="mx-2">•</span>
                                <span>5 min read</span>
                            </div>
                        </div>

                        <!-- Related Post 2 -->
                        <div class="group cursor-pointer">
                            <div class="h-48 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-xl mb-4 group-hover:scale-105 transition-transform duration-200"></div>
                            <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                Coaching the Future Generation
                            </h4>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                After retiring from professional play, I found my true calling in developing young talent...
                            </p>
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <span>Maria Rodriguez</span>
                                <span class="mx-2">•</span>
                                <span>7 min read</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
