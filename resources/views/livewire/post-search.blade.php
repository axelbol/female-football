<div class="relative max-w-md mx-auto lg:mx-0">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input type="text"
               wire:model.live.debounce.300ms="search"
               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white dark:bg-gray-800 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 text-lg"
               placeholder="Busca deportista ..."
               autocomplete="off">

        @if($search)
            <button wire:click="resetSearch" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        @endif
    </div>

    @if($showResults)
        <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg max-h-96 overflow-y-auto">
            @forelse($posts as $post)
                <div wire:click="selectPost('{{ $post->slug }}')"
                     class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer border-b border-gray-100 dark:border-gray-700 last:border-b-0">
                    <div class="flex items-start space-x-3">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                {{ $post->title }}
                            </h4>
                            <p class="text-sm text-emerald-600 dark:text-emerald-400 mt-1">
                                {{ $post->player_name }}
                            </p>
                            @if($post->category)
                                <span class="inline-block mt-1 px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                        </div>
                        <div class="text-gray-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400 text-center">
                    No posts found for "{{ $search }}"
                </div>
            @endforelse
        </div>
    @endif
</div>
