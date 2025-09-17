<x-layouts.app :title="__('Edit Post')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('Edit Post') }}</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Update your blog post') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 transition">
                    {{ __('View Post') }}
                </a>
                <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 transition">
                    {{ __('Back to Posts') }}
                </a>
            </div>
        </div>

        <div class="max-w-4xl">
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                <form action="{{ route('posts.update', $post) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Title') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $post->title) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('title') border-red-500 @enderror"
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Excerpt') }} <span class="text-red-500">*</span>
                        </label>
                        <textarea name="excerpt"
                                  id="excerpt"
                                  rows="3"
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('excerpt') border-red-500 @enderror"
                                  placeholder="{{ __('Brief description of the post') }}"
                                  required>{{ old('excerpt', $post->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Content') }} <span class="text-red-500">*</span>
                        </label>
                        <div id="editor" class="mt-1 bg-white dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 @error('content') border-red-500 @enderror" style="height: 300px;"></div>
                        <textarea name="content" id="content" style="display: none;">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Category') }} <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id"
                                    id="category_id"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('category_id') border-red-500 @enderror"
                                    required>
                                <option value="">{{ __('Select a category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="read_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Read Time (minutes)') }}
                            </label>
                            <input type="number"
                                   name="read_time"
                                   id="read_time"
                                   value="{{ old('read_time', $post->read_time) }}"
                                   min="1"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('read_time') border-red-500 @enderror">
                            @error('read_time')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="featured_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Featured Image URL') }}
                            </label>
                            <input type="url"
                                   name="featured_image"
                                   id="featured_image"
                                   value="{{ old('featured_image', $post->featured_image) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('featured_image') border-red-500 @enderror"
                                   placeholder="https://example.com/image.jpg">
                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="hero_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Hero Image URL') }}
                            </label>
                            <input type="url"
                                   name="hero_image"
                                   id="hero_image"
                                   value="{{ old('hero_image', $post->hero_image) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('hero_image') border-red-500 @enderror"
                                   placeholder="https://example.com/hero.jpg">
                            @error('hero_image')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="published_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Publish Date') }}
                        </label>
                        <input type="datetime-local"
                               name="published_at"
                               id="published_at"
                               value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('published_at') border-red-500 @enderror">
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ __('Leave empty to auto-set when publishing') }}</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="flex items-center">
                            <input type="checkbox"
                                   name="is_featured"
                                   id="is_featured"
                                   value="1"
                                   {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                {{ __('Featured Post') }}
                            </label>
                            @error('is_featured')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox"
                                   name="is_published"
                                   id="is_published"
                                   value="1"
                                   {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                            <label for="is_published" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                {{ __('Published') }}
                            </label>
                            @error('is_published')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-600">
                        <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300 dark:hover:bg-gray-700 transition">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 transition">
                            {{ __('Update Post') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'indent': '-1'}, { 'indent': '+1' }],
                        [{ 'align': [] }],
                        ['blockquote', 'code-block'],
                        ['link', 'image'],
                        ['clean']
                    ]
                }
            });

            var contentField = document.getElementById('content');

            // Update hidden textarea on every content change
            quill.on('text-change', function() {
                contentField.value = quill.root.innerHTML;
            });

            // Load existing content if available
            var existingContent = contentField.value;
            if (existingContent) {
                quill.root.innerHTML = existingContent;
            }

            // Also update on form submit as a fallback
            var form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                var content = quill.root.innerHTML.trim();
                contentField.value = content;

                // Check if content is empty (only contains empty tags)
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = content;
                var textContent = tempDiv.textContent || tempDiv.innerText || '';

                if (textContent.trim() === '') {
                    e.preventDefault();
                    alert('Please enter some content for your post.');
                    return false;
                }
            });
        });
    </script>
</x-layouts.app>