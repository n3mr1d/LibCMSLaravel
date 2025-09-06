<x-layouts.app-welcome title="About">
    <div class="mt-4 flex items-center justify-center gap-2">
        <flux:icon.book-open-text variant="outline" class="w-5 h-5 text-black-600 dark:text-blue-400" />
        <h1 class="font-semibold text-black dark:text-white text-2xl">About</h1>
    </div>
    <div class="max-w-lg mx-auto border-2 dark:border-none mt-12 p-8 bg-white dark:bg-neutral-900 rounded-lg shadow-md">
        <p class="text-gray-700 dark:text-gray-300 text-base leading-relaxed">
            Hallo {{ $user->username ?? 'User' }}, Welcome to {{ config('app.name') }}! This project is built with Laravel and modern web technologies to provide a seamless and enjoyable experience.
            <br><br>
            Our mission is to deliver high-quality, user-friendly solutions that help you achieve your goals efficiently.
            <br>
            Made With
        </p>
        <div class="flex items-center justify-center p-3">
            <a href="https://laravel.com" target="_blank" rel="noopener" class="inline-block">
                <flux:icon.laravel variant="outline" class="inline w-12 h-12 mx-2 align-text-bottom" />
                <span class="mx-2 font-semibold text-pink-600 dark:text-pink-400">Livewire</span>
            </a>
            <span class="mx-2 font-semibold text-gray-500 dark:text-gray-400">&amp;</span>
            <a href="https://livewire.laravel.com" target="_blank" rel="noopener" class="inline-block">
                <flux:icon.livewire variant="outline" class="inline w-12 h-12 mx-2 align-text-bottom" />
                <span class="mx-2 font-semibold text-red-600 dark:text-red-400 ">Laravel</span>
            </a>
        </div>
        <br>
        <p class="text-gray-700 dark:text-gray-300 text-base leading-relaxed">
            If you have any questions or feedback, feel free to reach out via the contact page.
        </p>
    </div>
</x-layouts.app-welcome>