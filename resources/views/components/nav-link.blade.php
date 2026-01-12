@props(['active'])

@php
$classes = $active
    ? 'inline-flex items-center px-3 py-2 rounded-xl text-sm font-semibold bg-emerald-50 text-phoenix-deep border border-emerald-100'
    : 'inline-flex items-center px-3 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:text-phoenix-dark hover:bg-slate-50 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
