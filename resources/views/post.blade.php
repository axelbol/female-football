<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-gray-900">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $post->title }}</h1>

        @if($post->featured_image_url)
        <div class="mb-8">
            <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" loading="lazy" class="w-full h-64 object-cover rounded-lg">
        </div>
        @endif

        <div class="prose prose-lg max-w-none dark:prose-invert">
            {!! $post->content !!}
        </div>

        <div class="mt-8 text-sm text-gray-600 dark:text-gray-400">
            <p>Published by {{ $post->user->name }} on {{ $post->created_at->format('F j, Y') }}</p>
        </div>
    </div>
</body>
</html>