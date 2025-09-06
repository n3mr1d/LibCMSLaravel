@props([
'message' => null,
'type' => 'success', // success, error, info, warning
])

@php
$typeColors = [
'success' => 'bg-green-500 text-white',
'error' => 'bg-red-500 text-white',
'info' => 'bg-blue-500 text-white',
'warning' => 'bg-yellow-500 text-black',
];
$icon = [
'success' => 'check-circle',
'error' => 'x-circle',
'info' => 'information-circle',
'warning' => 'exclamation-triangle',
][$type] ?? 'information-circle';

$colorClass = $typeColors[$type] ?? $typeColors['info'];
@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    @if($message) x-init="setTimeout(() => show = false, 3500)" @endif
    class="fixed z-50 bottom-6 right-6 max-w-xs w-full shadow-lg rounded-lg flex items-center gap-3 px-5 py-4 {{ $colorClass }}"
    wire:ignore>
    <span>
        @if($type === 'success')
        <flux:icon.check-circle class="w-6 h-6" />
        @elseif($type === 'error')
        <flux:icon.x-circle class="w-6 h-6" />
        @elseif($type === 'info')
        <flux:icon.information-circle class="w-6 h-6" />
        @elseif($type === 'warning')
        <flux:icon.exclamation-triangle class="w-6 h-6" />
        @else
        <flux:icon.information-circle class="w-6 h-6" />
        @endif
    </span>
    <div class="flex-1 text-sm font-medium">
        {{ $message }}
    </div>
    <button @click="show = false" class="ml-2 focus:outline-none">
        <flux:icon.x-mark class="w-5 h-5" />
    </button>
</div>