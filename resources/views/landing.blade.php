<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PIETYL Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 flex flex-col">
<header class="bg-white/80 backdrop-blur border-b border-slate-200">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
        <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
            <div class="h-10 w-10 rounded-2xl bg-teal-600 flex items-center justify-center text-white font-extrabold shadow-sm group-hover:shadow transition">
                P
            </div>
            <div>
                <div class="font-extrabold text-slate-900 leading-tight">
                    {{ $brand ?? 'PIETYL' }}
                </div>
                <div class="text-xs text-slate-500 leading-tight">
                    {{ $tagline ?? 'LPG operations and inventory system' }}
                </div>
            </div>
        </a>

        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}"
               class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 shadow-sm hover:shadow transition">
                Sign in
            </a>
        </div>
    </div>
</header>

    <main class="flex-1 relative overflow-hidden">
        <div aria-hidden="true" class="absolute inset-0">
            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-teal-500/10 blur-3xl"></div>
            <div class="absolute top-40 -left-24 h-80 w-80 rounded-full bg-cyan-500/10 blur-3xl"></div>
            <div class="absolute bottom-0 right-24 h-72 w-72 rounded-full bg-teal-600/10 blur-3xl"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-6 py-8">
            <div class="grid lg:grid-cols-2 gap-10 items-start">
                <section class="lg:pt-4">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white border border-slate-200 px-4 py-2 text-xs font-bold text-slate-700 shadow-sm">
                        <span class="h-2 w-2 rounded-full bg-teal-600"></span>
                        TEAL THEME • PIETYL MANAGEMENT SYSTEM
                    </div>

                    <h1 class="mt-5 text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-900">
                        PIETYL
                    </h1>

                    <p class="mt-3 text-lg sm:text-xl font-bold text-slate-900">
                        clean workflows for LPG stores, from inventory to accounting
                    </p>

                    <p class="mt-4 text-slate-600 leading-relaxed max-w-xl">
                        Manage employees, items, suppliers, and customers with role based access.
                        Built to grow into low stock alerts, sales flow, attendance tracking, and accounting without slowing your team down.
                    </p>

                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <div class="inline-flex items-center gap-2 rounded-xl bg-white border border-slate-200 px-3 py-2 text-sm text-slate-700 shadow-sm">
                            <svg class="h-4 w-4 text-teal-700" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M20 7L10.5 17.5L4 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            Assign roles
                        </div>

                        <div class="inline-flex items-center gap-2 rounded-xl bg-white border border-slate-200 px-3 py-2 text-sm text-slate-700 shadow-sm">
                            <svg class="h-4 w-4 text-teal-700" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 3v18M3 12h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                            </svg>
                            Track stock
                        </div>

                        <div class="inline-flex items-center gap-2 rounded-xl bg-white border border-slate-200 px-3 py-2 text-sm text-slate-700 shadow-sm">
                            <svg class="h-4 w-4 text-teal-700" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 22s8-4 8-10V7l-8-4-8 4v5c0 6 8 10 8 10z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            Protect access
                        </div>
                    </div>

                    <div class="mt-8 grid sm:grid-cols-3 gap-4">
                        <div class="phoenix-card p-5">
                            <div class="text-xs font-bold text-slate-500">MASTER DATA</div>
                            <div class="mt-2 font-semibold text-slate-900">Core lists first</div>
                            <div class="mt-1 text-sm text-slate-600">employees, customers, suppliers</div>
                        </div>

                        <div class="phoenix-card p-5">
                            <div class="text-xs font-bold text-slate-500">INVENTORY READY</div>
                            <div class="mt-2 font-semibold text-slate-900">Reorder levels</div>
                            <div class="mt-1 text-sm text-slate-600">pricing, minimum stock, reorder</div>
                        </div>

                        <div class="phoenix-card p-5">
                            <div class="text-xs font-bold text-slate-500">ROLE BASED</div>
                            <div class="mt-2 font-semibold text-slate-900">Controlled access</div>
                            <div class="mt-1 text-sm text-slate-600">secure modules per role</div>
                        </div>
                    </div>

                </section>

                <section class="lg:pt-2">
                    <div class="phoenix-card p-6 sm:p-7 shadow-sm">
                        <div class="flex items-start justify-between gap-6">
                            <div>
                                <div class="text-xl font-extrabold text-slate-900">Sign in</div>
                                <div class="mt-1 text-sm text-slate-600">Use the account provided by admin</div>
                            </div>

                            <div class="hidden sm:flex items-center gap-2 rounded-xl bg-slate-50 border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600">
                                <svg class="h-4 w-4 text-slate-500" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 17v-1a4 4 0 10-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                                    <path d="M12 17h4a3 3 0 003-3V10a4 4 0 00-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                                </svg>
                                Encrypted session
                            </div>
                        </div>

                        <x-auth-session-status class="mt-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}" class="mt-5 space-y-4">
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
                                    <a href="{{ route('password.request') }}"
                                       class="text-sm font-semibold text-teal-700 hover:text-teal-800 transition">
                                        {{ __('Forgot password') }}
                                    </a>
                                @endif
                            </div>

                            <div class="pt-2">
                                <x-primary-button class="w-full justify-center">
                                    {{ __('Log in') }}
                                </x-primary-button>
                            </div>

                            <div class="pt-1">
                                <a href="{{ route('attendance') }}"
                                   class="w-full inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                                    Go to Attendance
                                </a>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>

<footer class="border-t border-slate-200 bg-white">
    <div class="max-w-6xl mx-auto px-6 py-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-slate-500">
            <div class="flex items-center gap-2">
                <div class="h-6 w-6 rounded-lg bg-teal-600 flex items-center justify-center text-white text-xs font-bold">
                    P
                </div>
                <span>© 2026 {{ $brand ?? 'PIETYL' }} Management System</span>
            </div>

            <div class="text-xs text-slate-400">
                {{ $note ?? 'Internal system for authorized staff' }}
            </div>
        </div>
    </div>
</footer>

</body>
</html>
