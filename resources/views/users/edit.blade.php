<x-layouts.app :title="__('Edit User')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('users.show', $user) }}" class="flex h-8 w-8 items-center justify-center rounded-lg border border-gray-300 text-gray-600 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('Edit User') }}</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Update user information and roles') }}</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-lg bg-green-50 border border-green-200 p-4 dark:bg-green-900/20 dark:border-green-800">
                <div class="text-sm text-green-700 dark:text-green-400">{{ session('success') }}</div>
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-lg bg-red-50 border border-red-200 p-4 dark:bg-red-900/20 dark:border-red-800">
                <div class="text-sm text-red-700 dark:text-red-400">{{ session('error') }}</div>
            </div>
        @endif

        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Basic Information -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Basic Information') }}</h2>

                    <div class="grid gap-4 lg:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Title') }}</label>
                            <input type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $user->title) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Position') }}</label>
                            <select id="position"
                                    name="position"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400">
                                <option value="">{{ __('Select Position') }}</option>
                                <option value="Forward" {{ old('position', $user->position) == 'Forward' ? 'selected' : '' }}>{{ __('Forward') }}</option>
                                <option value="Midfielder" {{ old('position', $user->position) == 'Midfielder' ? 'selected' : '' }}>{{ __('Midfielder') }}</option>
                                <option value="Defender" {{ old('position', $user->position) == 'Defender' ? 'selected' : '' }}>{{ __('Defender') }}</option>
                                <option value="Goalkeeper" {{ old('position', $user->position) == 'Goalkeeper' ? 'selected' : '' }}>{{ __('Goalkeeper') }}</option>
                            </select>
                            @error('position')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="team" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Team') }}</label>
                            <input type="text"
                                   id="team"
                                   name="team"
                                   value="{{ old('team', $user->team) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400">
                            @error('team')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Country') }}</label>
                            <input type="text"
                                   id="country"
                                   name="country"
                                   value="{{ old('country', $user->country) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400">
                            @error('country')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="lg:col-span-2">
                            <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Bio') }}</label>
                            <textarea id="bio"
                                      name="bio"
                                      rows="3"
                                      class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                                      placeholder="{{ __('Tell us about yourself...') }}">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Avatar URL') }}</label>
                            <input type="url"
                                   id="avatar"
                                   name="avatar"
                                   value="{{ old('avatar', $user->avatar) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                                   placeholder="https://example.com/avatar.jpg">
                            @error('avatar')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input type="hidden" name="is_author" value="0">
                            <input type="checkbox"
                                   id="is_author"
                                   name="is_author"
                                   value="1"
                                   {{ old('is_author', $user->is_author) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:ring-blue-400">
                            <label for="is_author" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                {{ __('Mark as Author') }}
                            </label>
                            @error('is_author')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Social Links') }}</h2>

                    <div class="grid gap-4 lg:grid-cols-2">
                        <div>
                            <label for="social_links_twitter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Twitter') }}</label>
                            <input type="url"
                                   id="social_links_twitter"
                                   name="social_links[twitter]"
                                   value="{{ old('social_links.twitter', $user->social_links['twitter'] ?? '') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                                   placeholder="https://twitter.com/username">
                        </div>

                        <div>
                            <label for="social_links_instagram" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Instagram') }}</label>
                            <input type="url"
                                   id="social_links_instagram"
                                   name="social_links[instagram]"
                                   value="{{ old('social_links.instagram', $user->social_links['instagram'] ?? '') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                                   placeholder="https://instagram.com/username">
                        </div>

                        <div>
                            <label for="social_links_facebook" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Facebook') }}</label>
                            <input type="url"
                                   id="social_links_facebook"
                                   name="social_links[facebook]"
                                   value="{{ old('social_links.facebook', $user->social_links['facebook'] ?? '') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                                   placeholder="https://facebook.com/username">
                        </div>

                        <div>
                            <label for="social_links_linkedin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('LinkedIn') }}</label>
                            <input type="url"
                                   id="social_links_linkedin"
                                   name="social_links[linkedin]"
                                   value="{{ old('social_links.linkedin', $user->social_links['linkedin'] ?? '') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                                   placeholder="https://linkedin.com/in/username">
                        </div>
                    </div>

                    @error('social_links')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Roles Management -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('User Roles') }}</h2>
                    
                    <div class="space-y-3">
                        @foreach ($roles as $role)
                            <label class="flex items-center gap-3 rounded-lg border border-gray-200 p-3 cursor-pointer hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700">
                                <input type="checkbox" 
                                       name="roles[]" 
                                       value="{{ $role->id }}"
                                       {{ $user->roles->contains($role->id) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:ring-blue-400">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex rounded-full px-2 py-1 text-xs font-semibold
                                            @if($role->slug === 'admin') bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400
                                            @elseif($role->slug === 'editor') bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400
                                            @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                            @endif
                                        ">
                                            {{ $role->name }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $role->description }}</p>
                                </div>
                            </label>
                        @endforeach
                        @error('roles')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg dark:bg-blue-900/20 dark:border-blue-800">
                        <p class="text-xs text-blue-700 dark:text-blue-400">
                            <strong>{{ __('Note:') }}</strong> {{ __('Role changes will take effect immediately. Make sure you understand the permissions for each role before assigning them.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-4">
                    <button type="submit" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        {{ __('Update User') }}
                    </button>
                    <a href="{{ route('users.show', $user) }}" class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </div>
        </form>

        <!-- Delete User Form (separate from update form) -->
        @if ($user->id !== auth()->id())
            <div class="rounded-xl border border-red-200 bg-red-50 p-6 dark:border-red-800 dark:bg-red-900/20">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-red-900 dark:text-red-400">{{ __('Delete User') }}</h3>
                        <p class="text-sm text-red-700 dark:text-red-400">{{ __('This action cannot be undone. This will permanently delete the user account.') }}</p>
                    </div>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this user? This action cannot be undone.') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                            {{ __('Delete User') }}
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>