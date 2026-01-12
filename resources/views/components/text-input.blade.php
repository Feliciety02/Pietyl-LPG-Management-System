@props(['disabled' => false])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' =>
            'mt-1 block w-full rounded-xl border border-slate-300 ' .
            'bg-white text-slate-900 shadow-sm ' .
            'placeholder:text-slate-400 ' .
            'focus:border-phoenix-teal focus:ring-phoenix-teal focus:ring-2 ' .
            'disabled:bg-slate-100 disabled:text-slate-500 disabled:cursor-not-allowed'
    ]) !!}
>
