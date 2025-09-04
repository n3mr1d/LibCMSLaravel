<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.main-head')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
}; ?>
<div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
    <div class="bg-muted relative hidden justify-center items-center sm:bg-grey-400 h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
        <div class="absolute inset-0 "></div>
        <span class="flex h-100 w-100 items-center justify-center rounded-2xl relative z-10">
            <x-app-logo class="h-12 w-12 fill-current text-white drop-shadow-[0_0_16px_rgba(59,130,246,0.7)] transition-transform duration-300 hover:scale-110" />
        </span>
    </div>
    <div class="w-full lg:p-8">
        <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
            <div class="flex flex-col gap-6">
                <x-auth-header :title="__('Forgot password')" :description="__('Enter your email to receive a password reset link')" />

                <!-- Session Status -->
                <x-auth-session-status class="text-center" :status="session('status')" />

                <form method="POST" wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
                    <!-- Email Address -->
                    <flux:input
                        wire:model="email"
                        :label="__('Email Address')"
                        type="email"
                        required
                        autofocus
                        placeholder="email@example.com" />

                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Email password reset link') }}</flux:button>
                </form>

                <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
                    <span>{{ __('Or, return to') }}</span>
                    <flux:link :href="route('login')" wire:navigate>{{ __('log in') }}</flux:link>
                </div>
            </div>
        </div>
    </div>
</div>