<x-layouts.app :title="$post->title">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $post->title }}</h1>
                <div class="flex items-center gap-4 mt-2">
                    <span class="inline-flex rounded-full px-2 py-1 text-xs font-semibold" style="background-color: {{ $post->category->color === 'emerald' ? '#10b981' : ($post->category->color === 'blue' ? '#3b82f6' : ($post->category->color === 'red' ? '#ef4444' : ($post->category->color === 'yellow' ? '#f59e0b' : ($post->category->color === 'purple' ? '#8b5cf6' : '#6b7280')))) }}20; color: {{ $post->category->color === 'emerald' ? '#10b981' : ($post->category->color === 'blue' ? '#3b82f6' : ($post->category->color === 'red' ? '#ef4444' : ($post->category->color === 'yellow' ? '#f59e0b' : ($post->category->color === 'purple' ? '#8b5cf6' : '#6b7280')))) }}">
                        {{ $post->category->name }}
                    </span>
                    @if($post->is_featured)
                        <span class="inline-flex items-center rounded-full bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400">
                            ⭐ {{ __('Featured') }}
                        </span>
                    @endif
                    @if($post->is_published)
                        <span class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800 dark:bg-green-900/20 dark:text-green-400">
                            {{ __('Published') }}
                        </span>
                    @else
                        <span class="inline-flex rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-800 dark:bg-gray-900/20 dark:text-gray-400">
                            {{ __('Draft') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 transition">
                    {{ __('Edit Post') }}
                </a>
                <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 transition">
                    {{ __('Back to Posts') }}
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-lg bg-green-50 border border-green-200 p-4 dark:bg-green-900/20 dark:border-green-800">
                <div class="text-sm text-green-700 dark:text-green-400">{{ session('success') }}</div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                    @if($post->hero_image)
                        <div class="aspect-video w-full">
                            <img src="{{ $post->hero_image }}" alt="{{ $post->title }}" loading="lazy" class="h-full w-full object-cover">
                        </div>
                    @endif

                    <div class="p-6">
                        <div class="prose prose-gray max-w-none dark:prose-invert">
                            <div class="text-lg text-gray-600 dark:text-gray-400 mb-6">
                                {{ $post->excerpt }}
                            </div>

                            <div class="whitespace-pre-wrap">
                                {{ $post->content }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Post Details -->
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Post Details') }}</h3>

                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Author') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $post->user->name }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Slug') }}</dt>
                                <dd class="text-sm">
                                    <code class="text-gray-900 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">{{ $post->slug }}</code>
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Read Time') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $post->read_time }} {{ __('minutes') }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Created') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $post->created_at->format('M d, Y \a\t g:i A') }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Last Updated') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $post->updated_at->format('M d, Y \a\t g:i A') }}</dd>
                            </div>

                            @if($post->published_at)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Published') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $post->published_at->format('M d, Y \a\t g:i A') }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Featured Image -->
                @if($post->featured_image)
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Featured Image') }}</h3>
                        <div class="aspect-video w-full">
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" loading="lazy" class="h-full w-full object-cover rounded-lg">
                        </div>
                    </div>
                </div>
                @endif

                <!-- Meta Data -->
                @if($post->meta_data)
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Meta Data') }}</h3>
                        <pre class="text-xs text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-900 p-3 rounded-lg overflow-x-auto">{{ json_encode($post->meta_data, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                </div>
                @endif

                <!-- Actions -->
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Actions') }}</h3>
                        <div class="space-y-3">
                            <a href="{{ route('posts.edit', $post) }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 transition">
                                {{ __('Edit Post') }}
                            </a>

                            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this post?') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 transition">
                                    {{ __('Delete Post') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>