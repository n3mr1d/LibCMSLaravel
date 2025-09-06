@props([
'status',
'icon' => 'check-circle',
])

@if ($status)
<div {{ $attributes->merge([
        'class' => 'flex items-center justify-center gap-2 rounded-lg px-4 py-3 font-medium text-sm transition-all ' .
            'bg-green-50 text-green-700 ' .
            'dark:bg-green-900/30 dark:text-green-200 ' .
            'dark:border dark:border-green-800 dark:shadow-sm'
    ]) }}>
    <flux:icon :name="$icon" class="w-5 h-5 text-green-500 dark:text-green-300" />
    <span>{{ $status }}</span>
</div>
@endif