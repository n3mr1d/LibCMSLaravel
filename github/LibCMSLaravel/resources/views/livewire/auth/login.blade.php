<?php

use Illuminate\Support\Str;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

new #[Layout('components.main-head')] class extends Component {
    #[Validate('required|string')]
    #[Title('Login')]
    public string $username = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $user = Auth::user();

        // Redirect user based on their role
        if ($user->isGuest()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        } elseif ($user->isAdmin()) {
            dd($user->role);
            // $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: true);
        } else {
            abort(404,"role not found");
        }
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->username) . '|' . request()->ip());
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
                <x-auth-header :title="__('Log in to your account')" :description="__('Enter your Username and password below to log in')" />

                <!-- Session Status -->
                <x-auth-session-status class="text-center" :status="session('status')" />

                <form method="POST" wire:submit="login" class="flex flex-col gap-6">
                    <!-- Email Address -->
                    <flux:input
                        wire:model="username"
                        :label="__('Username')"
                        type="text"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="danwin" />

                    <!-- Password -->
                    <div class="relative">
                        <flux:input
                            wire:model="password"
                            :label="__('Password')"
                            type="password"
                            required
                            autocomplete="current-password"
                            :placeholder="__('Password')"
                            viewable />

                        @if (Route::has('password.request'))
                        <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </flux:link>
                        @endif
                    </div>

                    <!-- Remember Me -->
                    <flux:checkbox wire:model="remember" :label="__('Remember me')" />

                    <div class="flex items-center justify-end">
                        <flux:button variant="primary" type="submit" class="w-full">{{ __('Log in') }}</flux:button>
                    </div>
                </form>

                @if (Route::has('register'))
                <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
                    <span>{{ __('Don\'t have an account?') }}</span>
                    <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>