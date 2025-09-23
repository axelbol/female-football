<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Her Game</title>

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

        <!-- Learn More Section -->
        <main class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto">
                <!-- Hero Image -->
                <div class="mb-12 rounded-lg overflow-hidden shadow-xl">
                    <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                         alt="Women playing football"
                         class="w-full h-64 md:h-96 object-cover">
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-bold text-center mb-8 text-gray-800 dark:text-gray-100">
                    Learn More About Us
                </h1>

                <!-- Content -->
                <div class="prose prose-lg max-w-none text-gray-700 dark:text-gray-300">
                    <div class="text-center mb-12">
                        <p class="text-xl leading-relaxed">
                            We are passionate about celebrating and empowering women in football. Our mission is to shine a spotlight on the incredible talent, dedication, and achievements of female footballers around the world.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8 mb-12">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-semibold mb-4 text-emerald-600 dark:text-emerald-400">Our Vision</h3>
                            <p>
                                We envision a world where women's football receives the recognition, support, and resources it deserves. Through storytelling, data, and community building, we aim to elevate the beautiful game as played by women.
                            </p>
                        </div>

                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-semibold mb-4 text-emerald-600 dark:text-emerald-400">What We Do</h3>
                            <p>
                                We provide comprehensive coverage of women's football, from grassroots to professional levels. Our platform features player profiles, match analyses, league statistics, and inspiring stories that showcase the depth and quality of the women's game.
                            </p>
                        </div>
                    </div>

                    <div class="text-center bg-emerald-50 dark:bg-gray-800 p-8 rounded-lg">
                        <h3 class="text-2xl font-semibold mb-4 text-emerald-600 dark:text-emerald-400">Join Our Community</h3>
                        <p class="mb-6">
                            Whether you're a player, coach, fan, or simply someone who believes in equality in sports, we want to get to know you. Together, we can continue to grow the women's football community and inspire the next generation of female athletes.
                        </p>
                        <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
                            Because every woman deserves her moment on the pitch.
                        </p>
                    </div>
                </div>
            </div>
        </main>


        <!-- Footer -->
        @include('partials.footer')
    </body>
</html>
