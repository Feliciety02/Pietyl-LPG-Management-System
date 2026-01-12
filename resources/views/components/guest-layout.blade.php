<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Pietyl') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-slate-50 text-slate-900">
        <div class="min-h-screen flex items-center justify-center px-4 py-10">
            <div class="w-full max-w-md">
                <div class="mb-6 flex items-center justify-center gap-3">
                    <div class="h-12 w-12 rounded-2xl bg-phoenix-teal flex items-center justify-center text-white font-black">
                        P
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold leading-tight">Phoenix LPG Ops</div>
                        <div class="text-xs text-slate-500">Pietyl Management System</div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white shadow-sm border border-slate-200 p-6">
                    {{ $slot }}
                </div>

                <div class="mt-6 text-center text-xs text-slate-500">
                    Internal system for operations and master data
                </div>
            </div>
        </div>
    </body>
</html>
