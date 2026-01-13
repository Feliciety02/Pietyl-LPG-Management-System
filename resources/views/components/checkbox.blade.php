@props(['disabled' => false])

<input
    type="checkbox"
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' =>
            'h-4 w-4 rounded border-slate-300 bg-white ' .
            'text-phoenix-teal focus:ring-2 focus:ring-phoenix-teal ' .
            'checked:bg-phoenix-teal checked:border-phoenix-teal ' .
            'disabled:opacity-50 disabled:cursor-not-allowed'
    ]) !!}
>
