<div class="sticky top-0 w-full z-40">
    <flux:navbar class="flex items-center justify-between px-4 py-2 bg-white/80 dark:bg-neutral-950/80 backdrop-blur supports-[backdrop-filter]:bg-white/60 dark:supports-[backdrop-filter]:bg-neutral-950/60 border-b border-neutral-200 dark:border-neutral-800">
        <div class="flex gap-4">
            <x-navbar.navlink icon="home" :href="route('home')" :current="request()->routeIs('home')">Home</x-navbar.navlink>
            <x-navbar.navlink icon="information-circle" :href="route('about')" :current="request()->routeIs('about')">About</x-navbar.navlink>
            <x-navbar.navlink icon="envelope" :href="route('contact')" :current="request()->routeIs('contact')">Contact</x-navbar.navlink>
        </div>
  

        @if(Auth::check())
            @if($user && $user->role === 'guest')
                <div class="flex items-center gap-4">
                    <x-navbar.navlink class=" px-3 py-2" icon="home" :href="route('user.dashboard')" :current="request()->routeIs('user.dashboard')">Dashboard</x-navbar.navlink>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-neutral-100 dark:hover:bg-neutral-800 transition">
                            <flux:icon.user-plus class="w-5 h-5" />
                            Logout
                        </button>
                    </form>
                </div>
            @elseif($user && $user->role === 'admin')
                <div class="flex items-center  gap-4">
                    <x-navbar.navlink icon="home" class=" px-3 py-2" :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')">Dashboard</x-navbar.navlink>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-neutral-100 dark:hover:bg-neutral-800 transition">
                            <flux:icon.user-plus class="w-5 h-5" />
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="flex gap-4">
                    <x-navbar.navlink icon="home" :href="route('login')" :current="request()->routeIs('login')">Login</x-navbar.navlink>
                    <x-navbar.navlink icon="user-plus" :href="route('register')" :current="request()->routeIs('register')">Register</x-navbar.navlink>
                </div>
            @endif
        @else
            <div class="flex gap-4">
                <x-navbar.navlink icon="home" :href="route('login')" :current="request()->routeIs('login')">Login</x-navbar.navlink>
                <x-navbar.navlink icon="user-plus" :href="route('register')" :current="request()->routeIs('register')">Register</x-navbar.navlink>
            </div>
        @endif
    </flux:navbar>
</div>