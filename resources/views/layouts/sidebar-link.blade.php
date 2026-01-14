@props(['route', 'url', 'label', 'icon'])

<a href="{{ $url }}"
   class="group relative flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition
   {{ request()->routeIs($route) ? 'bg-teal-50 text-teal-800' : 'text-slate-700 hover:bg-slate-100' }}">

    <span class="absolute left-0 h-5 w-1 rounded-r bg-teal-600 {{ request()->routeIs($route) ? 'opacity-100' : 'opacity-0 group-hover:opacity-40' }}"></span>

    {{-- ICON --}}
    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        @switch($icon)
            @case('users')
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                <path d="M16 3.13a4 4 0 010 7.75"/>
                @break

            @case('user')
                <circle cx="12" cy="7" r="4"/>
                <path d="M5.5 21a6.5 6.5 0 0113 0"/>
                @break

            @case('user-circle')
                <circle cx="12" cy="12" r="10"/>
                <circle cx="12" cy="10" r="3"/>
                <path d="M7 20a5 5 0 0110 0"/>
                @break

            @case('archive')
                <rect x="3" y="4" width="18" height="4"/>
                <path d="M5 8v12h14V8"/>
                <path d="M10 12h4"/>
                @break

            @case('truck')
                <rect x="1" y="3" width="15" height="13"/>
                <path d="M16 8h4l3 3v5h-7z"/>
                <circle cx="5.5" cy="18.5" r="2.5"/>
                <circle cx="18.5" cy="18.5" r="2.5"/>
                @break

            @case('cog')
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51"/>
                @break
        @endswitch
    </svg>

    {{ $label }}
</a>
