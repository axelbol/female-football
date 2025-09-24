@props(['items' => []])

<nav aria-label="Breadcrumb" class="py-4">
    <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400" itemscope itemtype="https://schema.org/BreadcrumbList">
        @foreach($items as $index => $item)
            @if($index > 0)
                <li class="text-gray-400 dark:text-gray-500">/</li>
            @endif
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                @if(isset($item['url']) && !$loop->last)
                    <a href="{{ $item['url'] }}"
                       class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors"
                       itemprop="item">
                        <span itemprop="name">{{ $item['title'] }}</span>
                    </a>
                @else
                    <span class="text-gray-900 dark:text-white font-medium" itemprop="name">
                        {{ $item['title'] }}
                    </span>
                @endif
                <meta itemprop="position" content="{{ $index + 1 }}">
            </li>
        @endforeach
    </ol>
</nav>