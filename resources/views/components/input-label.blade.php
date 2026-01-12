@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-phoenix-dark']) }}>
    {{ $value ?? $slot }}
</label>
