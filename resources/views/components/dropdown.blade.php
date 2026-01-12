@props([
    'align' => 'right',
    'width' => '48',
    'contentClasses' => 'py-2 bg-white',
])

@php
$alignmentClasses = match ($align) {
    'left' => 'origin-top-left left-0',
    'top' => 'origin-top',
    default => 'origin-top-right right-0',
};

$widthClass = match ($width) {
    '48' => 'w-48',
    '56' => 'w-56',
    '64' => 'w-64',
    default => 'w-48',
};
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
         x-transition
         class="absolute z-50 mt-2 {{ $widthClass }} rounded-2xl border border-phoenix-gray shadow-sm overflow-hidden {{ $alignmentClasses }}"
         style="display: none;">
        <div class="{{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
