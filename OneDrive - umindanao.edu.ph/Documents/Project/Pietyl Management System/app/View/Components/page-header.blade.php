@props(['title' => '', 'subtitle' => null])

<div class="mb-6 rounded-2xl bg-white shadow-sm border border-phoenix-gray p-5">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-phoenix-dark">{{ $title }}</h1>
            @if($subtitle)
                <p class="mt-1 text-sm text-slate-600">{{ $subtitle }}</p>
            @endif
        </div>

        <div>
            {{ $actions ?? '' }}
        </div>
    </div>
</div>
