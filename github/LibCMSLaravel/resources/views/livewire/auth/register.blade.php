<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new class extends Component {
    #[Layout('components.main-head')]
    public string $name = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:4', 'unique:' . User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', Rules\Password::defaults()],
        ]);

        // Pastikan username lowercase
        $validated['username'] = strtolower($validated['username']);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        $user->ip_address = request()->ip();
        $user->user_agent = request()->userAgent();
        $user->save();

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
};
?>


<div class="grid relative flex-col justify-center items-center px-8 sm:px-0 lg:grid-cols-2 lg:px-0 lg:max-w-none h-dvh">
    <!-- Left panel (logo / background) -->
    <div
        class="hidden relative flex-col justify-center items-center p-10 h-full text-white lg:flex bg-muted sm:bg-grey-400 dark:border-e dark:border-neutral-800">
        <div class="absolute inset-0"></div>
        <span class="flex relative z-10 justify-center items-center rounded-2xl h-100 w-100">
            <x-app-logo
                class="w-12 h-12 text-white transition-transform duration-300 fill-current hover:scale-110 drop-shadow-[0_0_16px_rgba(59,130,246,0.7)]" />
        </span>
    </div>

    <!-- Right panel (form) -->
    <div class="w-full lg:p-8">
        <div class="flex flex-col justify-center mx-auto space-y-6 w-full sm:w-[350px]">

        

            <div class="flex flex-col gap-6">
                <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

                <!-- Session Status -->
                <x-auth-session-status class="text-center" :status="session('status')" />

                <!-- Registration Form -->
                <form method="POST" wire:submit="register" class="flex flex-col gap-6">
                    <flux:input wire:model="name" :label="__('Name')" type="text" required autocomplete="name"
                        :placeholder="__('Full name')" autofocus />

                    <flux:input wire:model="username" :label="__('Username')" type="text" required
                        autocomplete="username" :placeholder="__('danwin')" />

                    <flux:input wire:model="email" :label="__('Email address')" type="email" required
                        autocomplete="email" placeholder="email@example.com" />

                    <flux:input wire:model="password" :label="__('Password')" type="password" required
                        autocomplete="new-password" :placeholder="__('Password')" viewable />
                    <div class="flex justify-end items-center">
                        <flux:button type="submit" variant="primary" class="w-full">
                            {{ __('Create account') }}
                        </flux:button>
                    </div>
                </form>

                <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                    <span>{{ __('Already have an account?') }}</span>
                    <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
                </div>
            </div>
        </div>
    </div>
</div>
