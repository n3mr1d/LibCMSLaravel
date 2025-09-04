<flux:navbar.item
    wire:navigate
    :icon="$icon"
    :current="$current"
    :href="$href"
    class="transition-colors duration-300 ease-in-out"
>
    <span
        class="transition-colors duration-300 ease-in-out"
        :class="[
            $current
                ? 'text-blue-600 dark:text-blue-400 font-semibold'
                : 'text-neutral-700 dark:text-neutral-200'
        ]"
    >
        {{ $slot }}
    </span>
</flux:navbar.item>
