@php
    $breadcrumbs = [];
    $routeName = request()->route()->getName();

    // Build breadcrumbs based on current route
    switch($routeName) {
        case 'learn':
            $breadcrumbs = [
                ['name' => 'Inicio', 'url' => route('home')],
                ['name' => 'Conócenos', 'url' => null]
            ];
            break;
        case 'touch.create':
            $breadcrumbs = [
                ['name' => 'Inicio', 'url' => route('home')],
                ['name' => 'Contáctanos', 'url' => null]
            ];
            break;
        case 'post.public':
            $post = request()->route('post');
            $breadcrumbs = [
                ['name' => 'Inicio', 'url' => route('home')],
                ['name' => 'Historias', 'url' => route('home') . '#stories'],
            ];
            if(isset($post) && $post->category) {
                $breadcrumbs[] = ['name' => $post->category->name, 'url' => route('category.show', $post->category->slug)];
            }
            $breadcrumbs[] = ['name' => isset($post) ? Str::limit($post->title, 30) : 'Historia', 'url' => null];
            break;
        case 'category.show':
            $category = request()->route('category');
            $breadcrumbs = [
                ['name' => 'Inicio', 'url' => route('home')],
                ['name' => 'Historias', 'url' => route('home') . '#stories'],
                ['name' => isset($category) ? $category->name : 'Categoría', 'url' => null]
            ];
            break;
        case 'posts.search':
            $breadcrumbs = [
                ['name' => 'Inicio', 'url' => route('home')],
                ['name' => 'Buscar', 'url' => null]
            ];
            break;
        default:
            // For other routes, keep simple breadcrumb
            if(!request()->routeIs('home')) {
                $breadcrumbs = [
                    ['name' => 'Inicio', 'url' => route('home')],
                    ['name' => ucfirst(request()->segment(1) ?? 'Página'), 'url' => null]
                ];
            }
            break;
    }
@endphp

@if(count($breadcrumbs) > 1)
<!-- Mobile Breadcrumbs -->
<nav class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700 md:hidden" aria-label="Breadcrumb">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <div class="flex items-center space-x-2 text-sm">
            @foreach($breadcrumbs as $index => $breadcrumb)
                @if($breadcrumb['url'] && $index < count($breadcrumbs) - 1)
                    <!-- Clickable breadcrumb -->
                    <a href="{{ $breadcrumb['url'] }}"
                       class="flex items-center text-gray-600 hover:text-emerald-600 dark:text-gray-400 dark:hover:text-emerald-400 transition-colors font-medium">
                        @if($index === 0)
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        @endif
                        {{ $breadcrumb['name'] }}
                    </a>
                @else
                    <!-- Current page (non-clickable) -->
                    <span class="flex items-center text-gray-900 dark:text-white font-semibold">
                        @if($index === 0)
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        @endif
                        {{ $breadcrumb['name'] }}
                    </span>
                @endif

                @if($index < count($breadcrumbs) - 1)
                    <!-- Separator -->
                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                @endif
            @endforeach
        </div>

        <!-- Back button for mobile -->
        @if(count($breadcrumbs) > 1 && $breadcrumbs[count($breadcrumbs) - 2]['url'])
            <div class="mt-3">
                <a href="{{ $breadcrumbs[count($breadcrumbs) - 2]['url'] }}"
                   class="inline-flex items-center text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 transition-colors font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Volver a {{ $breadcrumbs[count($breadcrumbs) - 2]['name'] }}
                </a>
            </div>
        @endif
    </div>
</nav>
@endif