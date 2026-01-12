@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidthClass = match ($maxWidth) {
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    default => 'sm:max-w-2xl',
};
@endphp

<div
    x-data="{ show: @js($show) }"
    x-show="show"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:keydown.escape.window="show = false"
    style="display: none;"
    class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6"
>
    <div x-show="show" x-transition.opacity class="fixed inset-0 bg-slate-900/40"></div>

    <div x-show="show"
         x-transition
         class="relative w-full {{ $maxWidthClass }} rounded-3xl bg-white border border-phoenix-gray shadow-sm overflow-hidden">
        <div class="p-6">
            {{ $slot }}
        </div>
    </div>
</div>
