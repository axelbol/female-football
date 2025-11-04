<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Capitanas - Inspiring Stories of Bolivian Women in Football | Bolivian Female Football Heroes</title>
        <meta name="description" content="Celebra el fútbol femenino boliviano. Descubre las historias inspiradoras de jugadoras de todo el país, comparte tu trayectoria futbolística y únete a una creciente comunidad de futbolistas apasionadas.">
        <meta name="keywords" content="fútbol femenino Bolivia, women's football Bolivia, futbolistas bolivianas, female soccer Bolivia, mujeres futbol">
        <meta name="author" content="Capitanas">
        <meta name="robots" content="index, follow, max-image-preview:large">

        <link rel="icon" href="/img/logo/football-logo.svg" type="image/png">
        <link rel="apple-touch-icon" href="/img/logo/football-logo.svg">

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

        <!-- Learn More Section -->
        <main class="mobile-section">
            <div class="mobile-container max-w-4xl">
                <!-- Hero Image -->
                <div class="mb-8 sm:mb-12 rounded-lg overflow-hidden shadow-xl">
                    <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                         alt="Women playing football"
                         loading="lazy"
                         class="w-full h-48 sm:h-64 md:h-96 object-cover">
                </div>

                <!-- Title -->
                <h1 class="mobile-heading-1 text-center mb-6 sm:mb-8 text-gray-800 dark:text-gray-100">
                    Conozca más sobre nosotros
                </h1>

                <!-- Content -->
                <div class="mobile-prose max-w-none text-gray-700 dark:text-gray-300">
                    <div class="text-center mb-8 sm:mb-12">
                        <p class="mobile-body-large">
                            Nos apasiona celebrar y empoderar a las mujeres en el deporte. Nuestra misión es destacar el increíble talento, la dedicación y los logros de las deportistas de todo el mundo.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 sm:gap-8 mb-8 sm:mb-12">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-semibold mb-4 text-emerald-600 dark:text-emerald-400">Nuestra Misión</h3>
                            <p>
                                Imaginamos un mundo donde el deporte femenino reciba el reconocimiento, el apoyo y los recursos que merece. A través de historias, datos y la creación de comunidad, buscamos enaltecer el deporte practicado por mujeres.
                            </p>
                        </div>

                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-semibold mb-4 text-emerald-600 dark:text-emerald-400">Lo que Hacemos</h3>
                            <p>
                                Ofrecemos una cobertura completa del deporte femenino, desde las categorías inferiores hasta el nivel profesional. Nuestra plataforma incluye perfiles de jugadoras, análisis, estadísticas de ligas e historias inspiradoras que demuestran la profundidad y la calidad del deporte femenino.
                            </p>
                        </div>
                    </div>

                    <div class="text-center bg-emerald-50 dark:bg-gray-800 p-8 rounded-lg">
                        <h3 class="text-2xl font-semibold mb-4 text-emerald-600 dark:text-emerald-400">Únete a Nuestra Comunidad</h3>
                        <p class="mb-6">
                            Ya seas deportista, entrenadora, aficionada o simplemente creas en la igualdad en el deporte, queremos conocerte. Juntas, podemos seguir impulsando el crecimiento del deporte femenino e inspirar a la próxima generación de atletas.
                        </p>
                        <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
                            Porque toda mujer merece su momento en el campo.
                        </p>
                    </div>
                </div>
            </div>
        </main>


        <!-- Footer -->
        @include('partials.footer')

        <!-- Bottom Navigation -->
        @include('partials.bottom-nav')
    </body>
</html>
