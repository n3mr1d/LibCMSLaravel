<div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
    <div class="bg-muted relative hidden h-full flex-col p-10 text-white border-e border-gray-200  lg:flex dark:bg-neutral-900 dark:border-neutral-800">
        <div class="absolute inset-0"></div>
        <div>
            <h1 class="text-black  font-semibold text-center text-2xl dark:text-white">{{config('app.name') }} {{ date('Y') }}</h1>
            <x-icon.big-icon></x-icon.split-icon>
        </div>
    </div>
    <div class="w-full lg:p-8">
        <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
            <a href="/das" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
                <span class="flex h-9 w-9 items-center justify-center rounded-md">
                    <x-icon.app-logo class="size-9 fill-current text-black dark:text-white" />
                </span>

                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <div class="flex flex-col gap-6">
                <x-auth-header :title="__('Reset password')" :description="__('Please enter your new password below')" />

                <!-- Session Status -->
                <x-auth-session-status class="text-center" :status="session('status')" />

                <form method="POST" wire:submit="resetPassword" class="flex flex-col gap-6">
                    <!-- Email Address -->
                    <flux:input
                        wire:model="email"
                        :label="__('Email')"
                        type="email"
                        required
                        autocomplete="email" />

                    <!-- Password -->
                    <flux:input
                        wire:model="password"
                        :label="__('Password')"
                        type="password"
                        required
                        autocomplete="new-password"
                        :placeholder="__('Password')"
                        viewable />

                    <!-- Confirm Password -->
                    <flux:input
                        wire:model="password_confirmation"
                        :label="__('Confirm password')"
                        type="password"
                        required
                        autocomplete="new-password"
                        :placeholder="__('Confirm password')"
                        viewable />

                    <div class="flex items-center justify-end">
                        <flux:button type="submit" variant="primary" class="w-full">
                            {{ __('Reset password') }}
                        </flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>