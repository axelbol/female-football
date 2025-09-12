<x-layouts.app :title="__('User Details')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('users.index') }}" class="flex h-8 w-8 items-center justify-center rounded-lg border border-gray-300 text-gray-600 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('User Details') }}</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('View user information and roles') }}</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    {{ __('Edit User') }}
                </a>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <!-- User Information Card -->
            <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('User Information') }}</h2>
                
                <div class="flex items-start gap-4">
                    <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-xl bg-gray-200 text-xl font-medium text-gray-700 dark:bg-gray-600 dark:text-gray-200">
                        {{ $user->initials() }}
                    </div>
                    <div class="flex-1 space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Member Since') }}</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->created_at->format('F d, Y') }}</p>
                        </div>
                        @if ($user->email_verified_at)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email Verified') }}</label>
                                <p class="mt-1 text-sm text-green-600 dark:text-green-400">{{ $user->email_verified_at->format('F d, Y \a\t g:i A') }}</p>
                            </div>
                        @else
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email Status') }}</label>
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ __('Not verified') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Roles Card -->
            <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('User Roles') }}</h2>
                
                @if ($user->roles->count() > 0)
                    <div class="space-y-3">
                        @foreach ($user->roles as $role)
                            <div class="flex items-center justify-between rounded-lg border border-gray-200 p-3 dark:border-gray-600">
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex rounded-full px-3 py-1 text-sm font-semibold
                                        @if($role->slug === 'admin') bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400
                                        @elseif($role->slug === 'editor') bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400
                                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                        @endif
                                    ">
                                        {{ $role->name }}
                                    </span>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-900 dark:text-white font-medium">{{ $role->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $role->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="text-gray-400 dark:text-gray-500">
                            <svg class="mx-auto h-12 w-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white">{{ __('No roles assigned') }}</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('This user has no roles assigned yet.') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Activity Summary -->
        <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Activity Summary') }}</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->posts->count() }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Posts Created') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->roles->count() }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Active Roles') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->created_at->diffInDays() }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Days Active') }}</div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>