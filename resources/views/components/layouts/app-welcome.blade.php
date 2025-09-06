<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <x-navbar.welcome.navbar />
    {{ $slot }}
    <div class="fixed bottom-4 right-4 z-50">
        <flux:button x-data x-on:click="$flux.dark = !$flux.dark" class="bg-gray-700 relative overflow-hidden bg-gray-800 ">
            <span
                x-show="$flux.appearance === 'light'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-75"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-75"
                class="absolute inset-0 flex e items-center justify-center bg-gray-800">
                <flux:icon.sun variant="mini" class="text-white font-semibold dark:text-white" />
            </span>
            <span
                x-show="$flux.appearance === 'dark'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-75"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-75"
                class="absolute inset-0 flex dark:bg-white items-center justify-center">
                <flux:icon.moon variant="mini" class="text-zinc-500 font-semibold " />
            </span>
            <span class="invisible">
                <flux:icon.sun variant="mini" class="text-zinc-500 font-semibold dark:text-white" />
            </span>
        </flux:button>
    </div>
    @fluxScripts
</body>

</html>