<button {{ $attributes->merge([
    'type' => 'button',
    'class' =>
        'inline-flex items-center justify-center rounded-xl bg-white px-4 py-2.5 ' .
        'text-sm font-semibold text-phoenix-dark border border-phoenix-gray ' .
        'hover:bg-slate-50 transition focus:outline-none focus:ring-2 focus:ring-phoenix-teal focus:ring-offset-2'
]) }}>
    {{ $slot }}
</button>
