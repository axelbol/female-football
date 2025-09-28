@props([
    'post',
    'type' => 'featured', // featured, hero, middle
    'alt' => '',
    'class' => '',
    'loading' => 'lazy',
    'sizes' => '(max-width: 480px) 480px, (max-width: 768px) 768px, (max-width: 1200px) 1200px, 1920px'
])

@php
    $imageData = [];
    $fallbackUrl = '';

    switch($type) {
        case 'hero':
            $imageData = $post->getHeroImageResponsive();
            $fallbackUrl = $post->hero_image_url;
            $srcset = $post->hero_image_srcset;
            break;
        case 'middle':
            $imageData = $post->getMiddleImageResponsive();
            $fallbackUrl = $post->middle_image_url;
            $srcset = $post->middle_image_srcset ?? '';
            break;
        case 'featured':
        default:
            $imageData = $post->getFeaturedImageResponsive();
            $fallbackUrl = $post->featured_image_url;
            $srcset = $post->featured_image_srcset;
            break;
    }
@endphp

@if($fallbackUrl || !empty($imageData))
    <picture class="block">
        @if(!empty($imageData))
            <!-- WebP sources for modern browsers -->
            @if(!empty($imageData['mobile']))
                <source srcset="{{ $imageData['mobile'] }}"
                        type="image/webp"
                        media="(max-width: 480px)">
            @endif

            @if(!empty($imageData['tablet']))
                <source srcset="{{ $imageData['tablet'] }}"
                        type="image/webp"
                        media="(max-width: 768px)">
            @endif

            @if(!empty($imageData['desktop']))
                <source srcset="{{ $imageData['desktop'] }}"
                        type="image/webp"
                        media="(max-width: 1200px)">
            @endif

            @if(!empty($imageData['original']))
                <source srcset="{{ $imageData['original'] }}"
                        type="image/webp"
                        media="(min-width: 1201px)">
            @endif
        @endif

        <!-- Fallback image -->
        <img src="{{ $fallbackUrl }}"
             alt="{{ $alt ?: $post->title }}"
             @if($srcset)
             srcset="{{ $srcset }}"
             sizes="{{ $sizes }}"
             @endif
             loading="{{ $loading }}"
             class="{{ $class }}"
             {{ $attributes }}>
    </picture>
@endif