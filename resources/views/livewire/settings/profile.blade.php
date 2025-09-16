<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your profile information')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <!-- Basic Information -->
            <div class="rounded-lg border border-gray-200 p-6 dark:border-gray-700">
                <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">{{ __('Basic Information') }}</h3>
                <div class="grid gap-6 lg:grid-cols-2">
                    <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />
                    <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />
                    <flux:input wire:model="title" :label="__('Title')" type="text" />
                    <flux:select wire:model="position" :label="__('Position')" :placeholder="__('Select Position')">
                        <option value="">{{ __('Select Position') }}</option>
                        <option value="Forward">{{ __('Forward') }}</option>
                        <option value="Midfielder">{{ __('Midfielder') }}</option>
                        <option value="Defender">{{ __('Defender') }}</option>
                        <option value="Goalkeeper">{{ __('Goalkeeper') }}</option>
                    </flux:select>
                    <flux:input wire:model="team" :label="__('Team')" type="text" />
                    <flux:input wire:model="country" :label="__('Country')" type="text" />
                </div>

                <div class="mt-6">
                    <flux:textarea wire:model="bio" :label="__('Bio')" rows="4" :placeholder="__('Tell us about yourself...')" />
                </div>

                <div class="mt-6">
                    <flux:input wire:model="avatar" :label="__('Avatar URL')" type="url" :placeholder="__('https://example.com/avatar.jpg')" />
                </div>

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div class="mt-6 rounded-lg bg-yellow-50 p-4 dark:bg-yellow-900/20">
                        <flux:text class="text-yellow-800 dark:text-yellow-200">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer underline" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Social Links -->
            <div class="rounded-lg border border-gray-200 p-6 dark:border-gray-700">
                <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">{{ __('Social Links') }}</h3>
                <div class="grid gap-6 lg:grid-cols-2">
                    <flux:input wire:model="social_links.twitter" :label="__('Twitter')" type="url" :placeholder="__('https://twitter.com/username')" />
                    <flux:input wire:model="social_links.instagram" :label="__('Instagram')" type="url" :placeholder="__('https://instagram.com/username')" />
                    <flux:input wire:model="social_links.facebook" :label="__('Facebook')" type="url" :placeholder="__('https://facebook.com/username')" />
                    <flux:input wire:model="social_links.linkedin" :label="__('LinkedIn')" type="url" :placeholder="__('https://linkedin.com/in/username')" />
                </div>
            </div>

            <!-- Author Status -->
            @if(auth()->user()->is_author)
                <div class="rounded-lg border border-green-200 bg-green-50 p-6 dark:border-green-800 dark:bg-green-900/20">
                    <div class="flex items-center">
                        <svg class="mr-3 h-5 w-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm font-medium text-green-800 dark:text-green-200">{{ __('You are verified as an author') }}</span>
                    </div>
                </div>
            @endif

            <div class="flex items-center gap-4">
                <flux:button variant="primary" type="submit">{{ __('Save Changes') }}</flux:button>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
