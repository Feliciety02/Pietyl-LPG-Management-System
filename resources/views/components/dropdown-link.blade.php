<a {{ $attributes->merge([
    'class' =>
        'block px-4 py-2 text-sm font-semibold text-slate-700 ' .
        'hover:bg-slate-50 hover:text-phoenix-dark transition'
]) }}>
    {{ $slot }}
</a>
