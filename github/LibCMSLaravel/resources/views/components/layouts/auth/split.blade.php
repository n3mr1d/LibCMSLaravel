<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen antialiased bg-white dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div
        class="grid relative flex-col justify-center items-center px-8 sm:px-0 lg:grid-cols-2 lg:px-0 lg:max-w-none h-dvh">
        <div
            class="hidden relative flex-col p-10 h-full text-white lg:flex bg-muted dark:border-e dark:border-neutral-800">
            <div class="absolute inset-0 bg-neutral-900"></div>

            <div class="relative z-20 mt-auto">

            </div>
        </div>
        <div class="w-full lg:p-8">
            <div class="flex flex-col justify-center mx-auto space-y-6 w-full sm:w-[350px]">
                <a href="{{ route('home') }}" class="flex z-20 flex-col gap-2 items-center font-medium lg:hidden"
                    wire:navigate>
                    <span class="flex justify-center items-center w-9 h-9 rounded-md">
                        <x-app-logo-icon class="text-black fill-current dark:text-white size-9" />
                    </span>

                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>
