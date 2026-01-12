<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Pietyl') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-slate-50 text-slate-900">
    <div class="min-h-screen flex flex-col">

        <header class="w-full border-b border-phoenix-gray/60 bg-white/70 backdrop-blur">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-11 w-11 rounded-2xl bg-phoenix-teal flex items-center justify-center text-white font-extrabold tracking-wide">
                        P
                    </div>
                    <div class="leading-tight">
                        <div class="text-base font-semibold text-phoenix-dark">
                            {{ config('app.name', 'Pietyl') }}
                        </div>
                        <div class="text-sm text-slate-600">
                            LPG operations and inventory system
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center rounded-xl bg-phoenix-teal px-4 py-2 text-sm font-semibold text-white hover:bg-phoenix-deep transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center rounded-xl bg-white px-4 py-2 text-sm font-semibold text-phoenix-dark border border-phoenix-gray hover:bg-slate-50 transition">
                            Sign in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="inline-flex items-center rounded-xl bg-phoenix-teal px-4 py-2 text-sm font-semibold text-white hover:bg-phoenix-deep transition">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-6 py-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

                    <div class="pt-2">
                        <div class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-4 py-2 text-xs font-semibold tracking-wide">
                            PHOENIX THEME • V1 MASTER DATA
                        </div>

                        <h1 class="mt-6 text-5xl sm:text-6xl font-extrabold tracking-tight text-phoenix-dark">
                            PIETYL
                        </h1>

                        <p class="mt-3 text-xl sm:text-2xl font-semibold text-slate-800">
                            built for LPG stores that want clean workflows
                        </p>

                        <p class="mt-5 text-slate-600 text-lg max-w-xl leading-relaxed">
                            Manage employees, items, suppliers, and customers with role based access.
                            Designed to scale into low stock alerts, sales, attendance, and accounting without breaking the flow.
                        </p>

                        <div class="mt-7 flex flex-wrap gap-3">
                            @auth
                                <a href="{{ route('dashboard') }}"
                                   class="inline-flex items-center rounded-xl bg-phoenix-teal px-5 py-3 text-sm font-semibold text-white hover:bg-phoenix-deep transition">
                                    Open dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="inline-flex items-center rounded-xl bg-phoenix-teal px-5 py-3 text-sm font-semibold text-white hover:bg-phoenix-deep transition">
                                    Sign in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                       class="inline-flex items-center rounded-xl bg-white px-5 py-3 text-sm font-semibold text-phoenix-dark border border-phoenix-gray hover:bg-slate-50 transition">
                                        Create account
                                    </a>
                                @endif
                            @endauth
                        </div>

                        <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-xl">
                            <div class="rounded-2xl bg-white border border-phoenix-gray shadow-sm p-5">
                                <div class="text-xs font-semibold tracking-wide text-slate-500">
                                    MASTER DATA
                                </div>
                                <div class="mt-2 text-sm font-semibold text-phoenix-dark">
                                    Core lists first
                                </div>
                                <div class="mt-1 text-sm text-slate-600">
                                    employees, customers, suppliers
                                </div>
                            </div>

                            <div class="rounded-2xl bg-white border border-phoenix-gray shadow-sm p-5">
                                <div class="text-xs font-semibold tracking-wide text-slate-500">
                                    INVENTORY READY
                                </div>
                                <div class="mt-2 text-sm font-semibold text-phoenix-dark">
                                    Reorder levels
                                </div>
                                <div class="mt-1 text-sm text-slate-600">
                                    pricing, minimum stock, reorder
                                </div>
                            </div>

                            <div class="rounded-2xl bg-white border border-phoenix-gray shadow-sm p-5">
                                <div class="text-xs font-semibold tracking-wide text-slate-500">
                                    ROLE BASED
                                </div>
                                <div class="mt-2 text-sm font-semibold text-phoenix-dark">
                                    Controlled access
                                </div>
                                <div class="mt-1 text-sm text-slate-600">
                                    secure modules per role
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:pl-10">
                        <div class="rounded-3xl bg-white border border-phoenix-gray shadow-sm overflow-hidden">
                            <div class="p-6 bg-gradient-to-b from-slate-50 to-white border-b border-phoenix-gray">
                                <div class="text-sm font-semibold text-phoenix-dark">
                                    Setup checklist
                                </div>
                                <div class="text-sm text-slate-600 mt-1">
                                    Encode the essentials so everything else runs smoothly.
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex items-start gap-3 rounded-2xl border border-phoenix-gray/70 bg-white p-4">
                                        <div class="h-9 w-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold">
                                            1
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-sm font-semibold text-phoenix-dark">
                                                Add Items
                                            </div>
                                            <div class="text-sm text-slate-600">
                                                LPG and accessories with pricing and reorder levels
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3 rounded-2xl border border-phoenix-gray/70 bg-white p-4">
                                        <div class="h-9 w-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold">
                                            2
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-sm font-semibold text-phoenix-dark">
                                                Add Suppliers
                                            </div>
                                            <div class="text-sm text-slate-600">
                                                Keep your source list clean and searchable
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3 rounded-2xl border border-phoenix-gray/70 bg-white p-4">
                                        <div class="h-9 w-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold">
                                            3
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-sm font-semibold text-phoenix-dark">
                                                Add Customers
                                            </div>
                                            <div class="text-sm text-slate-600">
                                                Ready for sales and delivery flows later
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 rounded-2xl bg-slate-50 border border-phoenix-gray p-5">
                                    <div class="text-sm font-semibold text-phoenix-dark">
                                        Next upgrades
                                    </div>
                                    <div class="mt-1 text-sm text-slate-600">
                                        low stock alerts, cashier sales flow, QR attendance, payroll support
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-xs text-slate-500">
                            © {{ date('Y') }} {{ config('app.name', 'Pietyl') }}
                        </div>
                    </div>

                </div>
            </div>
        </main>

    </div>
</body>
</html>
