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
                <x-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

                <!-- Session Status -->
                <x-session-status class="text-center" :status="session('status')" />

                <form method="POST" wire:submit="register" class="flex flex-col gap-6">
                    <!-- Name -->
                    <flux:input
                        wire:model="name"
                        :label="__('Name')"
                        type="text"
                        required
                        autofocus
                        autocomplete="name"
                        :placeholder="__('Full name')" />
                    <!-- USERNAME -->
                    <flux:input
                        wire:model="username"
                        :label="__('Username')"
                        type="text"
                        required
                        autofocus
                        autocomplete="username"
                        :placeholder="__('username')" />
                    <!-- Email Addres  -->
                    <flux:input
                        wire:model="email"
                        :label="__('Email address')"
                        type="email"
                        required
                        autocomplete="email"
                        placeholder="email@example.com" />

                    <!-- Password -->
                    <flux:input
                        wire:model="password"
                        :label="__('Password')"
                        type="password"
                        required
                        autocomplete="new-password"
                        :placeholder="__('Password')"
                        viewable />


                    <div class="flex items-center justify-end">
                        <flux:button type="submit" variant="primary" class="w-full">
                            {{ __('Create account') }}
                        </flux:button>
                    </div>
                </form>

                <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
                    <span>{{ __('Already have an account?') }}</span>
                    <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
                </div>
            </div>
        </div>
    </div>
</div>