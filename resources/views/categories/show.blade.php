<x-layouts.app :title="$category->name">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg text-lg font-medium text-white"
                     style="background-color: {{ $category->color === 'emerald' ? '#10b981' : ($category->color === 'blue' ? '#3b82f6' : ($category->color === 'red' ? '#ef4444' : ($category->color === 'yellow' ? '#f59e0b' : ($category->color === 'purple' ? '#8b5cf6' : '#6b7280')))) }}">
                    {{ substr($category->name, 0, 2) }}
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $category->name }}</h1>
                    <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                        <span>{{ __('Slug: :slug', ['slug' => $category->slug]) }}</span>
                        <span>•</span>
                        <span>{{ __('Created: :date', ['date' => $category->created_at->format('M d, Y')]) }}</span>
                        <span>•</span>
                        @if($category->is_active)
                            <span class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                {{ __('Active') }}
                            </span>
                        @else
                            <span class="inline-flex rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800 dark:bg-red-900/20 dark:text-red-400">
                                {{ __('Inactive') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('categories.edit', $category) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 transition">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 transition">
                    {{ __('Back to Categories') }}
                </a>
            </div>
        </div>

        @if($category->description)
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-3">{{ __('Description') }}</h2>
                    <p class="text-gray-700 dark:text-gray-300">{{ $category->description }}</p>
                </div>
            </div>
        @endif

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ __('Posts in this Category') }}
                    <span class="ml-2 text-sm font-normal text-gray-500 dark:text-gray-400">
                        ({{ $category->posts->count() }})
                    </span>
                </h2>
            </div>

            @if($category->posts->count() > 0)
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($category->posts as $post)
                        <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $post->title }}
                                    </h3>
                                    @if($post->excerpt)
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 truncate">
                                            {{ Str::limit($post->excerpt, 100) }}
                                        </p>
                                    @endif
                                    <div class="mt-2 flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                                        <span>{{ __('By :author', ['author' => $post->user->name ?? 'Unknown']) }}</span>
                                        <span>•</span>
                                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                                        @if(isset($post->is_published))
                                            <span>•</span>
                                            @if($post->is_published)
                                                <span class="text-green-600 dark:text-green-400">{{ __('Published') }}</span>
                                            @else
                                                <span class="text-yellow-600 dark:text-yellow-400">{{ __('Draft') }}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4 flex items-center gap-2">
                                    <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" title="{{ __('View Post') }}">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <div class="text-gray-500 dark:text-gray-400">
                        <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium">{{ __('No posts yet') }}</h3>
                        <p class="mt-1 text-sm">{{ __('This category doesn\'t have any posts assigned to it yet.') }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/20">
                            <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('Total Posts') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $category->posts->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-100 dark:bg-green-900/20">
                            <svg class="h-5 w-5 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('Published') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ $category->posts->where('is_published', true)->count() ?? 0 }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-yellow-100 dark:bg-yellow-900/20">
                            <svg class="h-5 w-5 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('Drafts') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ $category->posts->where('is_published', false)->count() ?? 0 }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>