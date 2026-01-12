@props(['href' => null, 'type' => 'button'])

@if($href)
    <a href="{{ $href }}"
       class="inline-flex items-center rounded-xl bg-phoenix-teal px-4 py-2 text-sm font-semibold text-white hover:bg-phoenix-deep transition">
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}"
       class="inline-flex items-center rounded-xl bg-phoenix-teal px-4 py-2 text-sm font-semibold text-white hover:bg-phoenix-deep transition">
        {{ $slot }}
    </button>
@endif
