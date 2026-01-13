<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PIETYL Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen text-slate-800 flex flex-col">

<!-- FULL PAGE BACKGROUND -->
<div class="fixed inset-0 -z-10 overflow-hidden">
    <img
        src="{{ asset('images/store.png') }}"
        alt="Store background"
        class="h-full w-full object-cover object-center"
    />

    <!-- Teal brand tint -->

    <!-- Animated glows (animation comes from app.css) -->
    <div aria-hidden="true" class="absolute inset-0">
        <div class="pietyl-glow-1 absolute -top-28 -right-28 h-96 w-96 rounded-full bg-teal-500/20 blur-3xl"></div>
        <div class="pietyl-glow-2 absolute top-44 -left-28 h-[28rem] w-[28rem] rounded-full bg-cyan-500/16 blur-3xl"></div>
        <div class="pietyl-glow-3 absolute -bottom-20 right-20 h-96 w-96 rounded-full bg-teal-600/18 blur-3xl"></div>
    </div>
</div>

<header class="bg-white/70 backdrop-blur border-b border-slate-200">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-2xl bg-teal-600 flex items-center justify-center text-white font-extrabold shadow-sm shadow-teal-600/20">
                P
            </div>
            <div>
                <div class="font-extrabold text-slate-900 leading-tight">PIETYL</div>
                <div class="text-xs text-slate-500 leading-tight">LPG Management System</div>
            </div>
        </div>

        <a href="{{ route('login') }}"
           class="hidden sm:inline-flex items-center justify-center rounded-xl border border-teal-200/70 bg-white/70 px-4 py-2 text-sm font-semibold text-teal-800 hover:bg-white transition">
            Sign in
        </a>
    </div>
</header>

<main class="flex-1">
    <div class="max-w-6xl mx-auto px-6 py-10">
        <div class="grid lg:grid-cols-2 gap-10 items-start">

            <!-- LOGIN CARD -->
            <section class="lg:pt-6">
                <div class="relative rounded-2xl border border-white/60 bg-white/25 backdrop-blur-2xl backdrop-saturate-150
                            shadow-[0_18px_55px_-26px_rgba(15,23,42,0.55)] p-7 sm:p-8">

                    <!-- Glass shine -->
                    <div aria-hidden="true" class="pointer-events-none absolute inset-0 rounded-2xl bg-gradient-to-br from-white/45 via-white/10 to-transparent"></div>
                    <div aria-hidden="true" class="pointer-events-none absolute inset-0 rounded-2xl ring-1 ring-teal-500/15"></div>

                    <div class="relative">
                        <div class="flex items-start justify-between gap-6">
                            <div>
                                <div class="text-2xl font-extrabold text-slate-900">Sign in</div>
                                <div class="mt-1 text-sm text-slate-700/80">Use the account provided by admin</div>
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
                                    class="w-full bg-white/65 border-slate-200 focus:border-teal-500 focus:ring-teal-500/30"
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
                                    class="w-full bg-white/65 border-slate-200 focus:border-teal-500 focus:ring-teal-500/30"
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
                </div>
            </section>

            <!-- RIGHT CONTENT -->
            <section class="lg:pt-6">
                <div class="relative rounded-2xl border border-white/60 bg-white/22 backdrop-blur-2xl backdrop-saturate-150
                            shadow-[0_18px_55px_-28px_rgba(15,23,42,0.45)] overflow-hidden p-8 sm:p-10">

                    <!-- Teal glass gradient -->
                    <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-br from-teal-500/18 via-white/0 to-cyan-500/14"></div>
                    <div aria-hidden="true" class="absolute inset-0 rounded-2xl bg-gradient-to-br from-white/40 via-white/10 to-transparent"></div>
                    <div aria-hidden="true" class="absolute inset-0 ring-1 ring-teal-500/10 rounded-2xl"></div>

                    <div class="relative">
                        <div class="inline-flex items-center gap-2 rounded-full bg-white/55 border border-white/65 px-4 py-2 text-xs font-bold text-teal-900/80">
                            <span class="h-2 w-2 rounded-full bg-teal-600"></span>
                            PIETYL MANAGEMENT SYSTEM
                        </div>

                        <h1 class="mt-5 text-5xl font-extrabold tracking-tight text-slate-900">
                            PIETYL
                        </h1>

                        <p class="mt-3 text-xl font-bold text-slate-900">
                            clean workflows for LPG stores, from inventory to accounting
                        </p>

                        <p class="mt-4 text-sm text-slate-600 leading-relaxed">
                            Manage employees, items, suppliers, and customers with role based access.
                            Built to grow into low stock alerts, sales flow, attendance tracking, and accounting without slowing your team down.
                        </p>

                        <div class="mt-5 flex flex-wrap gap-2">
                            <div class="inline-flex items-center gap-2 rounded-xl bg-white/55 border border-white/70 px-3 py-2 text-xs text-slate-800">
                                <span class="text-teal-700 font-bold">✓</span>
                                Role based access
                            </div>
                            <div class="inline-flex items-center gap-2 rounded-xl bg-white/55 border border-white/70 px-3 py-2 text-xs text-slate-800">
                                <span class="text-teal-700 font-bold">✓</span>
                                Inventory ready
                            </div>
                            <div class="inline-flex items-center gap-2 rounded-xl bg-white/55 border border-white/70 px-3 py-2 text-xs text-slate-800">
                                <span class="text-teal-700 font-bold">✓</span>
                                Secure sign in
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </div>
</main>

<!-- SMALLER FOOTER -->
<footer class="border-t border-slate-200 bg-white/65 backdrop-blur">
    <div class="max-w-6xl mx-auto px-6 py-2.5">
        <div class="flex items-center justify-between text-[11px] text-slate-500">
            <div class="flex items-center gap-2">
                <div class="h-5 w-5 rounded-md bg-teal-600 flex items-center justify-center text-white font-bold text-[10px]">
                    P
                </div>
                <span>PIETYL manages LPG inventory, sales, and staff workflows.</span>
            </div>
            <span class="text-slate-400">© 2026</span>
        </div>
    </div>
</footer>

</body>
</html>
