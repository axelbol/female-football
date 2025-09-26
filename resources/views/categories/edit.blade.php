<x-layouts.app :title="__('Edit Category')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('Edit Category') }}</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Update category information') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('category.show', $category) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 transition">
                    {{ __('View') }}
                </a>
                <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 transition">
                    {{ __('Back to Categories') }}
                </a>
            </div>
        </div>

        <div class="max-w-2xl">
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                <form action="{{ route('categories.update', $category) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Name') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $category->name) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('name') border-red-500 @enderror"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Color') }}
                        </label>
                        <select name="color"
                                id="color"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('color') border-red-500 @enderror">
                            <option value="emerald" {{ old('color', $category->color) === 'emerald' ? 'selected' : '' }}>{{ __('Emerald') }}</option>
                            <option value="blue" {{ old('color', $category->color) === 'blue' ? 'selected' : '' }}>{{ __('Blue') }}</option>
                            <option value="red" {{ old('color', $category->color) === 'red' ? 'selected' : '' }}>{{ __('Red') }}</option>
                            <option value="yellow" {{ old('color', $category->color) === 'yellow' ? 'selected' : '' }}>{{ __('Yellow') }}</option>
                            <option value="purple" {{ old('color', $category->color) === 'purple' ? 'selected' : '' }}>{{ __('Purple') }}</option>
                            <option value="gray" {{ old('color', $category->color) === 'gray' ? 'selected' : '' }}>{{ __('Gray') }}</option>
                        </select>
                        @error('color')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Description') }}
                        </label>
                        <textarea name="description"
                                  id="description"
                                  rows="3"
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('description') border-red-500 @enderror"
                                  placeholder="{{ __('Optional description for this category') }}">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-start">
                        @if($category->posts_count > 0 && $category->is_active)
                            <div class="flex items-center">
                                <input type="checkbox"
                                       name="is_active"
                                       id="is_active"
                                       value="1"
                                       checked
                                       disabled
                                       class="rounded border-gray-300 text-blue-600 shadow-sm bg-gray-100 cursor-not-allowed dark:bg-gray-600">
                                <input type="hidden" name="is_active" value="1">
                                <label for="is_active" class="ml-2 block text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('Active') }}
                                    <span class="text-xs text-gray-400 dark:text-gray-500 block">
                                        {{ __('Cannot deactivate: has :count posts', ['count' => $category->posts_count]) }}
                                    </span>
                                </label>
                            </div>
                        @else
                            <div class="flex items-center">
                                <input type="checkbox"
                                       name="is_active"
                                       id="is_active"
                                       value="1"
                                       {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Active') }}
                                </label>
                            </div>
                        @endif
                        @error('is_active')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-600">
                        <a href="{{ route('category.show', $category) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300 dark:hover:bg-gray-700 transition">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 transition">
                            {{ __('Update Category') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>