@props([
    'message' => null,
    'type' => 'info',
    'timeout' => 3000,
])

@php
    $styles = [
        'success' => [
            'bg' => 'bg-green-50',
            'border' => 'border-green-400',
            'icon' => 'text-green-500',
            'text' => 'text-green-900',
            'button' => 'hover:bg-green-100 focus:ring-green-400',
        ],
        'error' => [
            'bg' => 'bg-red-50',
            'border' => 'border-red-400',
            'icon' => 'text-red-500',
            'text' => 'text-red-900',
            'button' => 'hover:bg-red-100 focus:ring-red-400',
        ],
        'warning' => [
            'bg' => 'bg-yellow-50',
            'border' => 'border-yellow-400',
            'icon' => 'text-yellow-500',
            'text' => 'text-yellow-900',
            'button' => 'hover:bg-yellow-100 focus:ring-yellow-400',
        ],
        'info' => [
            'bg' => 'bg-blue-50',
            'border' => 'border-blue-400',
            'icon' => 'text-blue-500',
            'text' => 'text-blue-900',
            'button' => 'hover:bg-blue-100 focus:ring-blue-400',
        ],
    ];
    $current = $styles[$type] ?? $styles['info'];
    $timeoutValue = is_numeric($timeout) && $timeout > 0 ? $timeout : 3000;
@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    @if($timeoutValue)
        x-init="setTimeout(() => show = false, {{ $timeoutValue }})"
    @endif
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed top-6 right-6 z-50 min-w-[320px] max-w-xs flex items-start gap-3 px-5 py-4 border-l-4 shadow-xl rounded-lg {{ $current['bg'] }} {{ $current['border'] }}"
    role="alert"
>
    <div class="flex-shrink-0 pt-1">
        @switch($type)
            @case('success')
                <svg class="w-6 h-6 {{ $current['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4"/>
                </svg>
                @break
            @case('error')
                <svg class="w-6 h-6 {{ $current['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M15 9l-6 6M9 9l6 6"/>
                </svg>
                @break
            @case('warning')
                <svg class="w-6 h-6 {{ $current['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>
                </svg>
                @break
            @default
                <svg class="w-6 h-6 {{ $current['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M12 16h.01M12 8v4"/>
                </svg>
        @endswitch
    </div>
    <div class="flex-1 {{ $current['text'] }} text-sm font-medium">
        @if(!empty($message))
            {{ $message }}
        @else
            {{ $slot }}
        @endif
    </div>
    <button
        @click="show = false"
        class="ml-2 rounded-full p-1 transition {{ $current['button'] }}"
        aria-label="Close"
        type="button"
    >
        <svg class="w-5 h-5 {{ $current['icon'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div>
