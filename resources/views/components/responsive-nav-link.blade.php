@props(['active'])

@php
$classes = $active
    ? 'block w-full px-4 py-2 rounded-xl text-sm font-semibold bg-emerald-50 text-phoenix-deep border border-emerald-100'
    : 'block w-full px-4 py-2 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
