<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Capitanas</title>
    <meta name="description" content="{{ Str::limit($post->excerpt, 155) }}">
    <meta name="author" content="{{ $post->player_name ?? $post->user->name }}">
    <meta name="robots" content="index, follow, max-image-preview:large">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ Str::limit($post->excerpt, 200) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="Capitanas">
    <meta property="og:locale" content="en_US">
    @if($post->featured_image_url)
    <meta property="og:image" content="{{ $post->featured_image_url }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $post->title }}">
    @endif
    @if($post->published_at)
    <meta property="article:published_time" content="{{ $post->published_at->toIso8601String() }}">
    @endif
    @if($post->updated_at)
    <meta property="article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">
    @endif
    @if($post->category)
    <meta property="article:section" content="{{ $post->category->name }}">
    @endif
    <meta property="article:author" content="{{ $post->player_name ?? $post->user->name }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ Str::limit($post->excerpt, 200) }}">
    @if($post->featured_image_url)
    <meta name="twitter:image" content="{{ $post->featured_image_url }}">
    <meta name="twitter:image:alt" content="{{ $post->title }}">
    @endif

    <link rel="icon" href="/img/logo/football-logo.svg" type="image/png">
    <link rel="apple-touch-icon" href="/img/logo/football-logo.svg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-emerald-50 to-teal-100 dark:from-gray-900 dark:to-gray-800 text-gray-900 dark:text-gray-100 min-h-screen">

    <!-- Header -->
    @include('partials.header')

    <!-- Pull to Refresh -->
    @include('partials.pull-to-refresh')

    <!-- Breadcrumbs -->
    @include('partials.breadcrumbs')

    <!-- Post Content -->
    <main class="mobile-section bg-white dark:bg-gray-900">
        <div class="mobile-container max-w-4xl">
            <!-- Post Header -->
            <header class="mb-6 sm:mb-8">
                <h1 class="mobile-heading-1 text-gray-900 dark:text-white mb-3 sm:mb-4">{{ $post->title }}</h1>

                <!-- Post Meta -->
                <div class="flex flex-wrap items-center gap-3 sm:gap-4 mobile-caption text-gray-600 dark:text-gray-400 mb-4 sm:mb-6">
                    @if($post->category)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200">
                            {{ $post->category->name }}
                        </span>
                    @endif
                    <span>Por {{ $post->user->name }}</span>
                    <span>{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
                    @if($post->read_time)
                        <span>{{ $post->read_time }} min de lectura</span>
                    @endif
                </div>
            </header>

            @if($post->featured_image_url)
            <div class="mb-6 sm:mb-8">
                <x-responsive-image
                    :post="$post"
                    type="featured"
                    :alt="$post->title"
                    class="w-full h-auto object-contain rounded-xl shadow-lg"
                    loading="lazy"
                />
            </div>
            @endif

            <!-- Post Content -->
            <article class="mobile-prose max-w-none">
                @if($post->excerpt)
                    <p class="mobile-body-large text-gray-600 dark:text-gray-300 font-medium mb-4 sm:mb-6">{{ $post->excerpt }}</p>
                @endif

                <div class="mobile-body">
                    @php
                        $content = $post->content;
                        $heroImage = $post->hero_image_url;
                        $firstHalf = '';
                        $secondHalf = '';
                        $canSplit = false;

                        // Debug: check values
                        // dd(['heroImage' => $heroImage, 'content' => substr($content, 0, 100)]);

                        if ($heroImage && $content) {
                            $dom = new DOMDocument();
                            libxml_use_internal_errors(true);
                            $dom->loadHTML('<?xml encoding="UTF-8"><body>' . $content . '</body>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                            libxml_clear_errors();

                            $body = $dom->getElementsByTagName('body')->item(0);

                            if ($body && $body->childNodes && $body->childNodes->length > 0) {
                                $children = $body->childNodes;
                                $totalNodes = $children->length;
                                $middlePoint = max(1, (int)floor($totalNodes / 2));

                                // Build the two halves
                                for ($i = 0; $i < $totalNodes; $i++) {
                                    $node = $children->item($i);
                                    $nodeHtml = $dom->saveHTML($node);

                                    if ($i < $middlePoint) {
                                        $firstHalf .= $nodeHtml;
                                    } else {
                                        $secondHalf .= $nodeHtml;
                                    }
                                }

                                // Only split if we have content in both halves
                                if (trim(strip_tags($firstHalf)) && trim(strip_tags($secondHalf))) {
                                    $canSplit = true;
                                }
                            }
                        }
                    @endphp

                    @if($heroImage && $canSplit)
                        {!! $firstHalf !!}

                        <div class="my-6 sm:my-8">
                            <x-responsive-image
                                :post="$post"
                                type="hero"
                                :alt="$post->title"
                                class="w-full h-64 sm:h-80 lg:h-96 object-cover rounded-xl shadow-lg"
                                loading="lazy"
                            />
                        </div>

                        {!! $secondHalf !!}
                    @else
                        {!! $post->content !!}
                    @endif
                </div>
            </article>

            <!-- Post Footer -->
            <footer class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        <p>Publicado por <span class="font-medium text-gray-900 dark:text-white">{{ $post->user->name }}</span></p>
                        <p>{{ $post->published_at ? $post->published_at->format('d \d\e F \d\e Y') : $post->created_at->format('d \d\e F \d\e Y') }}</p>
                    </div>

                    <!-- Share Buttons -->
                    <div class="flex items-center space-x-3">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Compartir:</span>
                        <button onclick="shareOnTwitter()" class="mobile-icon-btn touch-feedback ripple text-gray-600 hover:text-blue-400 dark:text-gray-400 dark:hover:text-blue-400 rounded-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </button>
                        <button onclick="shareOnFacebook()" class="mobile-icon-btn touch-feedback ripple text-gray-600 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-600 rounded-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </button>
                        <button onclick="copyToClipboard()" class="mobile-icon-btn touch-feedback ripple text-gray-600 hover:text-emerald-600 dark:text-gray-400 dark:hover:text-emerald-400 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Bottom Navigation -->
    @include('partials.bottom-nav')

    <script>
        function shareOnTwitter() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent({!! json_encode($post->title . ' - Capitanas') !!});
            const shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${text}`;

            const popup = window.open(shareUrl, '_blank', 'width=600,height=400,scrollbars=yes,resizable=yes');

            if (!popup || popup.closed || typeof popup.closed === 'undefined') {
                window.location.href = shareUrl;
            }
        }

        function shareOnFacebook() {
            const url = encodeURIComponent(window.location.href);
            const shareUrl = `https://www.facebook.com/dialog/share?app_id={{ config('services.facebook.app_id', '') }}&href=${url}&display=popup`;

            const popup = window.open(shareUrl, '_blank', 'width=600,height=400,scrollbars=yes,resizable=yes');

            if (!popup || popup.closed || typeof popup.closed === 'undefined') {
                const fallbackUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                window.location.href = fallbackUrl;
            }
        }

        function copyToClipboard() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('¡Enlace copiado al portapapeles!');
            }).catch((err) => {
                const tempInput = document.createElement('input');
                tempInput.value = window.location.href;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                alert('¡Enlace copiado al portapapeles!');
            });
        }
    </script>
</body>
</html>
