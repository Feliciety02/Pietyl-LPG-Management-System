@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-3 py-2 rounded-xl text-sm font-semibold bg-phoenix-teal text-white'
            : 'block px-3 py-2 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-100 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
