<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Capitanas - Inspiring Stories of Women in Football | Female Football Heroes</title>
        <meta name="description" content="Discover inspiring stories from women who've made their mark in football. Share your journey, read about female football heroes, and join our community of passionate players.">
        <meta name="keywords" content="women football, female football players, women soccer, football stories, female athletes, women sports, football inspiration, soccer heroes">
        <meta name="author" content="Capitanas">
        <meta name="robots" content="index, follow, max-image-preview:large">

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url('/') }}">

        <!-- Enhanced Open Graph -->
        <meta property="og:title" content="Capitanas - Inspiring Stories of Women in Football">
        <meta property="og:description" content="Discover inspiring stories from women who've made their mark in football. Join our community of passionate female players.">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Capitanas">
        <meta property="og:locale" content="en_US">
        @if($latestPost && $latestPost->featured_image_url)
        <meta property="og:image" content="{{ $latestPost->featured_image_url }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="{{ $latestPost->title }}">
        @endif

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Capitanas - Inspiring Stories of Women in Football">
        <meta name="twitter:description" content="Discover inspiring stories from women who've made their mark in football.">
        @if($latestPost && $latestPost->featured_image_url)
        <meta name="twitter:image" content="{{ $latestPost->featured_image_url }}">
        <meta name="twitter:image:alt" content="{{ $latestPost->title }}">
        @endif

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-gradient-to-br from-emerald-50 to-teal-100 dark:from-gray-900 dark:to-gray-800 text-gray-900 dark:text-gray-100 min-h-screen">

        <!-- Header -->
        @include('partials.header')

        <!-- Pull to Refresh -->
        @include('partials.pull-to-refresh')

        <!-- Breadcrumbs -->
        @include('partials.breadcrumbs')

        <!-- Sections -->
        @include('partials.section')

        <!-- Footer -->
        @include('partials.footer')

        <!-- Bottom Navigation -->
        @include('partials.bottom-nav')

        @livewireScripts
    </body>
</html>
