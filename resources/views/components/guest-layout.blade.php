<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Pietyl') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="min-h-screen flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-sm">

            <div class="mb-10 text-center">
                <div class="mx-auto h-20 w-20 rounded-3xl bg-phoenix-teal flex items-center justify-center text-white font-extrabold text-3xl shadow-sm">
                    P
                </div>

                <div class="mt-5 text-2xl font-extrabold tracking-tight text-phoenix-dark">
                    Phoenix LPG Ops
                </div>

                <div class="mt-1 text-base text-slate-600">
                    Pietyl Management System
                </div>

                <div class="mt-6  mx-auto bg-slate-200"></div>
            </div>

            <div class="rounded-3xl bg-white border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6">
                    {{ $slot }}
                </div>
            </div>

            <div class="mt-6 text-center text-xs text-slate-500">
                Internal system for operations and master data
            </div>

        </div>
    </div>
</body>
</html>
