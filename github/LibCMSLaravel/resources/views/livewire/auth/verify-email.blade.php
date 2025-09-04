<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.main-head')] class extends Component {
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
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
                <flux:text class="text-center">
                    {{ __('Please verify your email address by clicking on the link we just emailed to you.') }}
                </flux:text>

                @if (session('status') == 'verification-link-sent')
                <x-flux::toast type="success" :timeout=6000 variant="success">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </x-flux::toast>
                @endif

                <div class="flex flex-col items-center justify-between space-y-3">
                    <flux:button wire:click="sendVerification" variant="primary" class="w-full">
                        {{ __('Resend verification email') }}
                    </flux:button>

                    <flux:link class="text-sm cursor-pointer" wire:click="logout">
                        {{ __('Log out') }}
                    </flux:link>
                </div>
            </div>
        </div>
    </div>
</div>