<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PIETYL') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded-xl bg-teal-600 flex items-center justify-center text-white font-bold">
                        P
                    </div>
                    <span class="font-extrabold text-slate-900">PIETYL</span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm font-semibold text-slate-600 hover:text-teal-700 transition">
                        Log out
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 max-w-7xl mx-auto w-full px-6 py-6">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
