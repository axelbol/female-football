<!-- Hero Section -->
<section class="relative py-20 lg:py-32">
    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/10 to-teal-600/10 dark:from-emerald-400/5 dark:to-teal-400/5"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-center lg:text-left">
                <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                    Every Woman Has a <span class="text-emerald-600 dark:text-emerald-400">Story</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                    Share your journey in football. Inspire the next generation of female athletes with your experiences, challenges, and triumphs on and off the pitch.
                </p>
                @livewire('post-search')
            </div>
            <div class="relative">
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-8 shadow-xl" id="stats-section">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mb-2" data-count="50" data-suffix="+">0+</div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">Stories Shared</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mb-2" data-count="10" data-suffix="+">0+</div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">Countries</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mb-2" data-count="80">0</div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">Athletes</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mb-2">∞</div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">Inspiration</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- New Story Section ---->
<section class="py-20 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Latest Story
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Fresh from the pitch - the newest addition to our community of inspiring women
            </p>
        </div>

        <div class="max-w-4xl mx-auto">
            @if($latestPost)
                <!-- Large Story Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                        @if($latestPost->hero_image)
                            <div class="h-64 lg:h-full bg-cover bg-center" style="background-image: url('{{ Storage::url($latestPost->hero_image) }}')"></div>
                        @else
                            <div class="h-64 lg:h-full bg-gradient-to-br from-rose-400 to-orange-500"></div>
                        @endif
                        <div class="p-8 lg:p-12 flex flex-col justify-center">
                            <div class="mb-4">
                                <span class="inline-block bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 text-sm font-medium px-3 py-1 rounded-full">
                                    New Story
                                </span>
                                @if($latestPost->category)
                                    <span class="inline-block ml-2 bg-{{ $latestPost->category->color ?? 'gray' }}-100 dark:bg-{{ $latestPost->category->color ?? 'gray' }}-900 text-{{ $latestPost->category->color ?? 'gray' }}-800 dark:text-{{ $latestPost->category->color ?? 'gray' }}-200 text-sm font-medium px-3 py-1 rounded-full">
                                        {{ $latestPost->category->name }}
                                    </span>
                                @endif
                            </div>
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-4">
                                {{ $latestPost->title }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-6 text-lg leading-relaxed">
                                {{ Str::limit($latestPost->excerpt, 150) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-emerald-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">{{ strtoupper(substr($latestPost->player_name ?? $latestPost->user->name, 0, 2)) }}</span>
                                    </div>
                                    <div>
                                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold block">
                                            {{ $latestPost->player_name ?? $latestPost->user->name }}
                                        </span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $latestPost->published_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('post.public', $latestPost->slug) }}" class="bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition-colors">
                                    Read Story
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Fallback when no posts exist -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-8 lg:p-12 text-center">
                        <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-4">
                            No Stories Yet
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-6 text-lg leading-relaxed">
                            Be the first to share your inspiring journey in women's football.
                        </p>
                        <a href="{{ route('posts.create') }}" class="bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition-colors">
                            Share Your Story
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Latest Stories Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Latest Stories
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Recent additions from our growing community of women making their mark
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto">
            @forelse($recentPosts as $index => $post)
                @php
                    $colors = ['violet', 'amber', 'blue', 'rose', 'emerald', 'purple'];
                    $color = $colors[$index % count($colors)];
                @endphp
                <!-- Latest Story Card {{ $index + 1 }} -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    @if($post->featured_image)
                        <div class="h-40 bg-cover bg-center" style="background-image: url('{{ Storage::url($post->featured_image) }}')"></div>
                    @else
                        <div class="h-40 bg-gradient-to-br from-{{ $color }}-400 to-{{ $color === 'violet' ? 'purple' : $color }}-500"></div>
                    @endif
                    <div class="p-6">
                        <div class="mb-3">
                            <span class="inline-block bg-{{ $color }}-100 dark:bg-{{ $color }}-900 text-{{ $color }}-800 dark:text-{{ $color }}-200 text-xs font-medium px-2 py-1 rounded-full">
                                Recent
                            </span>
                            @if($post->category)
                                <span class="inline-block ml-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs font-medium px-2 py-1 rounded-full">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            {{ $post->title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 text-sm leading-relaxed">
                            {{ Str::limit($post->excerpt, 100) }}
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-{{ $color }}-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-xs">{{ strtoupper(substr($post->player_name ?? $post->user->name, 0, 2)) }}</span>
                                </div>
                                <div>
                                    <span class="text-{{ $color }}-600 dark:text-{{ $color }}-400 font-medium text-sm block">
                                        {{ $post->player_name ?? $post->user->name }}
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $post->published_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('post.public', $post->slug) }}" class="text-{{ $color }}-600 dark:text-{{ $color }}-400 hover:text-{{ $color }}-700 dark:hover:text-{{ $color }}-300 text-sm font-medium">
                                Read More →
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Fallback when no recent posts exist -->
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-500 dark:text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No Recent Stories</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">Be among the first to share your football journey.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Featured Stories Section -->
<section id="stories" class="py-20 bg-white/50 dark:bg-gray-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Featured Stories
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Discover incredible journeys from women who've made their mark in football
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredPosts as $index => $post)
                @php
                    $featuredColors = ['emerald', 'purple', 'blue', 'rose', 'indigo', 'teal'];
                    $color = $featuredColors[$index % count($featuredColors)];
                    $toColor = match($color) {
                        'emerald' => 'teal',
                        'purple' => 'pink',
                        'blue' => 'indigo',
                        'rose' => 'pink',
                        'indigo' => 'purple',
                        'teal' => 'cyan',
                        default => 'slate'
                    };
                @endphp
                <!-- Featured Story Card {{ $index + 1 }} -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    @if($post->featured_image)
                        <div class="h-48 bg-cover bg-center" style="background-image: url('{{ Storage::url($post->featured_image) }}')"></div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-{{ $color }}-400 to-{{ $toColor }}-500"></div>
                    @endif
                    <div class="p-6">
                        @if($post->category)
                            <div class="mb-3">
                                <span class="inline-block bg-{{ $color }}-100 dark:bg-{{ $color }}-900 text-{{ $color }}-800 dark:text-{{ $color }}-200 text-xs font-medium px-2 py-1 rounded-full">
                                    {{ $post->category->name }}
                                </span>
                                <span class="inline-block ml-1 bg-amber-100 dark:bg-amber-900 text-amber-800 dark:text-amber-200 text-xs font-medium px-2 py-1 rounded-full">
                                    Featured
                                </span>
                            </div>
                        @endif
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            {{ $post->title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            {{ Str::limit($post->excerpt, 80) }}
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-emerald-600 dark:text-emerald-400 font-medium">
                                {{ $post->player_name ?? $post->user->name }}
                            </span>
                            <a href="{{ route('post.public', $post->slug) }}" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300">
                                Read More →
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Fallback when no featured posts exist -->
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-500 dark:text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No Featured Stories</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">Featured stories will appear here once marked by our editors.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statsSection = document.getElementById('stats-section');
    const counters = statsSection.querySelectorAll('[data-count]');
    let hasAnimated = false;

    function animateCounter(element) {
        const target = parseInt(element.dataset.count);
        const suffix = element.dataset.suffix || '';
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current) + suffix;
        }, 16);
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !hasAnimated) {
                hasAnimated = true;
                counters.forEach(counter => {
                    animateCounter(counter);
                });
            }
        });
    }, {
        threshold: 0.5
    });

    observer.observe(statsSection);
});
</script>
