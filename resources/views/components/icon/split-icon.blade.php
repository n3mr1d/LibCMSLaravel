<div class="flex items-center">
    <div class="flex aspect-square size-8 items-center justify-center rounded-md ">
        <x-icon.app-logo class="size-5 fill-current text-black" />
    </div>
    <div class="ms-3 flex flex-col justify-center">
        <span class="truncate text-base font-bold leading-tight">{{ config('app.name') }} {{ date('Y') }}</span>
    </div>
</div>