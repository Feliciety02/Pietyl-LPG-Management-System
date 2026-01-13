<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PIETYL Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 flex flex-col">

<header class="bg-white/70 backdrop-blur border-b border-slate-200">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-2xl bg-teal-600 flex items-center justify-center text-white font-extrabold shadow-sm">
                P
            </div>
            <div>
                <div class="font-extrabold text-slate-900 leading-tight">PIETYL</div>
                <div class="text-xs text-slate-500 leading-tight">LPG Management System</div>
            </div>
        </div>
    </div>
</header>

<main class="flex-1 relative overflow-hidden">

    <!-- Background glow -->
    <div aria-hidden="true" class="absolute inset-0">
        <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-teal-500/10 blur-3xl"></div>
        <div class="absolute top-40 -left-24 h-80 w-80 rounded-full bg-cyan-500/10 blur-3xl"></div>
        <div class="absolute bottom-0 right-24 h-72 w-72 rounded-full bg-teal-600/10 blur-3xl"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-6 py-10">
        <div class="grid lg:grid-cols-2 gap-10 items-start">

            <!-- LOGIN CARD (GLASS) -->
            <section class="lg:pt-6">
                <div class="rounded-2xl border border-white/40 bg-white/35 backdrop-blur-xl shadow-[0_12px_40px_-18px_rgba(15,23,42,0.35)] p-7 sm:p-8">

                    <div class="flex items-start justify-between gap-6">
                        <div>
                            <div class="text-2xl font-extrabold text-slate-900">Sign in</div>
                            <div class="mt-1 text-sm text-slate-700/80">
                                Use the account provided by admin
                            </div>
                        </div>
                    </div>

                    <x-auth-session-status class="mt-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
                        @csrf

                        <div class="space-y-1">
                            <x-input-label for="email" value="Email" />
                            <x-text-input
                                id="email"
                                name="email"
                                type="email"
                                :value="old('email')"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="you@example.com"
                                class="w-full bg-white/55 border-slate-200 focus:border-teal-500 focus:ring-teal-500/30"
                            />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>

                        <div class="space-y-1">
                            <x-input-label for="password" value="Password" />
                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                                class="w-full bg-white/55 border-slate-200 focus:border-teal-500 focus:ring-teal-500/30"
                            />
                            <x-input-error :messages="$errors->get('password')" />
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <label class="inline-flex items-center gap-2">
                                <x-checkbox name="remember" />
                                <span class="text-sm text-slate-800">Remember me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-sm font-semibold text-teal-700 hover:text-teal-800 transition">
                                    Forgot password
                                </a>
                            @endif
                        </div>

                        <x-primary-button class="w-full justify-center">
                            Log in
                        </x-primary-button>
                    </form>
                </div>
            </section>

            <!-- RIGHT CONTENT WITH BACKGROUND IMAGE -->
            <section class="relative lg:pt-6 overflow-hidden rounded-2xl">

                <div
                    class="absolute inset-0 bg-cover bg-center hidden lg:block"
                    style="background-image: url('views/images/store.png');">
                </div>

                <div class="absolute inset-0 bg-gradient-to-br from-white/95 via-white/85 to-teal-50/70"></div>

                <div class="relative p-8 sm:p-10">
                    <h1 class="text-5xl font-extrabold tracking-tight text-slate-900">
                        PIETYL
                    </h1>

                    <p class="mt-4 text-xl font-bold text-slate-900">
                        clean workflows for LPG stores, from inventory to accounting
                    </p>

                    <p class="mt-4 text-slate-600 leading-relaxed max-w-xl">
                        Manage employees, items, suppliers, and customers with role based access.
                        Built to grow into low stock alerts, sales flow, attendance tracking,
                        and accounting without slowing your team down.
                    </p>

                    <div class="mt-6 grid sm:grid-cols-3 gap-4">
                        <div class="rounded-2xl bg-white/70 backdrop-blur border border-white/60 shadow-sm p-5">
                            <div class="text-xs font-bold text-slate-500">MASTER DATA</div>
                            <div class="mt-2 font-semibold text-slate-900">Core lists first</div>
                            <div class="mt-1 text-sm text-slate-600">
                                employees, customers, suppliers
                            </div>
                        </div>

                        <div class="rounded-2xl bg-white/70 backdrop-blur border border-white/60 shadow-sm p-5">
                            <div class="text-xs font-bold text-slate-500">INVENTORY READY</div>
                            <div class="mt-2 font-semibold text-slate-900">Reorder levels</div>
                            <div class="mt-1 text-sm text-slate-600">
                                pricing, minimum stock, reorder
                            </div>
                        </div>

                        <div class="rounded-2xl bg-white/70 backdrop-blur border border-white/60 shadow-sm p-5">
                            <div class="text-xs font-bold text-slate-500">ROLE BASED</div>
                            <div class="mt-2 font-semibold text-slate-900">Controlled access</div>
                            <div class="mt-1 text-sm text-slate-600">
                                secure modules per role
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</main>

<footer class="border-t border-slate-200 bg-white">
    <div class="max-w-6xl mx-auto px-6 py-6">
        <div class="flex items-center justify-between text-xs text-slate-500">
            <div class="flex items-center gap-2">
                <div class="h-6 w-6 rounded-lg bg-teal-600 flex items-center justify-center text-white font-bold">
                    P
                </div>
                © 2026 PIETYL Management System
            </div>
            <div class="text-slate-400">
                Internal system for authorized staff
            </div>
        </div>
    </div>
</footer>

</body>
</html>
