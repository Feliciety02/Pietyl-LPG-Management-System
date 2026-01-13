<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PIETYL Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl bg-phoenix flex items-center justify-center text-white font-extrabold">
                    P
                </div>
                <div>
                    <div class="font-extrabold text-slate-900 leading-tight">PIETYL</div>
                    <div class="text-xs text-slate-500 leading-tight">LPG operations and inventory system</div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('attendance') }}"
                   class="text-sm font-semibold text-phoenix hover:text-phoenix-dark transition">
                    Attendance
                </a>

                <a href="{{ route('login') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Sign in
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6 py-10">
        <div class="grid lg:grid-cols-2 gap-8 items-start">
            <section class="lg:pt-6">
                <div class="inline-flex items-center rounded-full bg-phoenix-light px-4 py-2 text-xs font-bold text-phoenix-ink">
                    PHOENIX THEME • PIETYL MANAGEMENT SYSTEM
                </div>

                <h1 class="mt-5 text-5xl font-extrabold tracking-tight text-phoenix-ink">
                    PIETYL
                </h1>

                <p class="mt-3 text-xl font-bold text-slate-900">
                    built for LPG stores that want clean workflows
                </p>

                <p class="mt-4 text-slate-600 leading-relaxed max-w-xl">
                    Manage employees, items, suppliers, and customers with role based access.
                    Designed to scale into low stock alerts, sales, attendance, and accounting without breaking the flow.
                </p>

                <div class="mt-8 grid sm:grid-cols-3 gap-4">
                    <div class="phoenix-card p-4">
                        <div class="text-xs font-bold text-slate-500">MASTER DATA</div>
                        <div class="mt-2 font-semibold text-slate-900">Core lists first</div>
                        <div class="mt-1 text-sm text-slate-600">employees, customers, suppliers</div>
                    </div>

                    <div class="phoenix-card p-4">
                        <div class="text-xs font-bold text-slate-500">INVENTORY READY</div>
                        <div class="mt-2 font-semibold text-slate-900">Reorder levels</div>
                        <div class="mt-1 text-sm text-slate-600">pricing, minimum stock, reorder</div>
                    </div>

                    <div class="phoenix-card p-4">
                        <div class="text-xs font-bold text-slate-500">ROLE BASED</div>
                        <div class="mt-2 font-semibold text-slate-900">Controlled access</div>
                        <div class="mt-1 text-sm text-slate-600">secure modules per role</div>
                    </div>
                </div>

                <div class="mt-6 text-sm text-slate-500">
                    Accounts are created by admin. Staff only sign in.
                </div>
            </section>

            <section>
                <div class="phoenix-card p-7">
                    <div class="text-xl font-extrabold text-slate-900">Sign in</div>
                    <div class="mt-1 text-sm text-slate-600">Use the account provided by admin</div>

                    <x-auth-session-status class="mt-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
                        @csrf

                        <div class="space-y-1">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input
                                id="email"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="you@example.com"
                            />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>

                        <div class="space-y-1">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                            />
                            <x-input-error :messages="$errors->get('password')" />
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <label for="remember_me" class="inline-flex items-center gap-2">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="text-sm text-slate-700">
                                    {{ __('Remember me') }}
                                </span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-semibold text-phoenix hover:text-phoenix-dark transition">
                                    {{ __('Forgot password') }}
                                </a>
                            @endif
                        </div>

                        <div class="pt-3">
                            <x-primary-button class="w-full justify-center">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                <div class="mt-5 text-center text-xs text-slate-500">
                    © {{ date('Y') }} PIETYL Management System
                </div>
            </section>
        </div>
    </main>
</body>
</html>
