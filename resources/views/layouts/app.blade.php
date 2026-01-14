<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PIETYL') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">
    <div class="min-h-screen">

        {{-- Sidebar (fixed on lg) --}}
        @include('layouts.sidebar')

        {{-- Main content wrapper (pushes content to the right of fixed sidebar) --}}
        <div class="lg:pl-64">

            {{-- Page Content --}}
            <main class="px-6 py-8">
                {{ $slot }}
            </main>

        </div>
    </div>
</body>
</html>
