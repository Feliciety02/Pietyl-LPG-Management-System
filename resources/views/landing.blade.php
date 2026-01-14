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
            class="h-full w-full object-cover object-center scale-[1.02] pietyl-bg-float"
        />

        <!-- Teal tint overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-teal-50/75 via-white/45 to-cyan-50/65"></div>

        <!-- Subtle vignette -->
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/10 via-transparent to-transparent"></div>

        <!-- Modern animated aurora glows (animation is in app.css) -->
        <div aria-hidden="true" class="absolute inset-0">
            <div class="pietyl-aurora pietyl-aurora-1 absolute -top-40 -left-40 h-[32rem] w-[32rem] rounded-full blur-3xl"></div>
            <div class="pietyl-aurora pietyl-aurora-2 absolute top-10 right-[-10rem] h-[34rem] w-[34rem] rounded-full blur-3xl"></div>
            <div class="pietyl-aurora pietyl-aurora-3 absolute bottom-[-14rem] left-[35%] h-[36rem] w-[36rem] rounded-full blur-3xl"></div>
            <div class="pietyl-aurora pietyl-aurora-4 absolute top-[35%] left-[60%] h-[28rem] w-[28rem] rounded-full blur-3xl"></div>
            <div class="pietyl-aurora pietyl-aurora-5 absolute bottom-[-10rem] right-[-12rem] h-[30rem] w-[30rem] rounded-full blur-3xl"></div>

            <div class="pietyl-glow-4 absolute top-16 left-1/2 -translate-x-1/2 h-64 w-[36rem] rounded-full bg-white/20 blur-3xl"></div>
        </div>
    </div>

    <!-- GLASS HEADER -->
    <header class="sticky top-0 z-20 border-b border-white/30 bg-white/35 backdrop-blur-2xl backdrop-saturate-150">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl bg-teal-600 flex items-center justify-center text-white font-extrabold shadow-sm shadow-teal-600/20">
                    P
                </div>
                <div>
                    <div class="font-extrabold text-slate-900 leading-tight">PIETYL</div>
                    <div class="text-xs text-slate-600/80 leading-tight">LPG Operations Platform</div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('attendance') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-white/40 bg-white/40 px-4 py-2 text-sm font-semibold text-teal-900 hover:bg-white/55 transition shadow-sm">
                    Attendance
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN -->
    <main class="flex-1 flex items-center">
        <div class="max-w-6xl mx-auto px-6 w-full py-10">
            <!-- IMPORTANT: items-stretch makes both columns same height -->
            <div class="grid lg:grid-cols-2 gap-10 items-stretch">

                <!-- LEFT: LOGIN CARD (centered within left column) -->
                <section class="flex items-center">
                    <div class="w-full max-w-xl">
                        <!-- IMPORTANT: h-full makes the card match the column height -->
                        <div class="relative h-full rounded-2xl border border-white/60 bg-white/25 backdrop-blur-2xl backdrop-saturate-150
                                    shadow-[0_18px_55px_-26px_rgba(15,23,42,0.55)] p-7 sm:p-8">

                            <!-- glass shine + border ring -->
                            <div aria-hidden="true" class="pointer-events-none absolute inset-0 rounded-2xl bg-gradient-to-br from-white/45 via-white/10 to-transparent"></div>
                            <div aria-hidden="true" class="pointer-events-none absolute inset-0 rounded-2xl ring-1 ring-teal-500/15"></div>

                            <!-- Center content inside card so it feels centered -->
                            <div class="relative h-full flex flex-col justify-center">
                                <div class="flex items-start justify-between gap-4">
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
                                            class="w-full bg-white/70 border-slate-200 focus:border-teal-500 focus:ring-teal-500/30"
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
                                            class="w-full bg-white/70 border-slate-200 focus:border-teal-500 focus:ring-teal-500/30"
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
                                               class="text-sm font-semibold text-teal-800 hover:text-teal-900 transition">
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
                    </div>
                </section>

                <!-- RIGHT: INFO PANEL (same height as login card) -->
                <section class="flex items-center">
                    <div class="w-full">
                        <div class="relative h-full rounded-2xl border border-white/60 bg-white/22 backdrop-blur-2xl backdrop-saturate-150
                                    shadow-[0_18px_55px_-28px_rgba(15,23,42,0.45)] overflow-hidden p-8 sm:p-10">

                            <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-br from-teal-500/18 via-white/0 to-cyan-500/14"></div>
                            <div aria-hidden="true" class="absolute inset-0 rounded-2xl bg-gradient-to-br from-white/40 via-white/10 to-transparent"></div>
                            <div aria-hidden="true" class="absolute inset-0 ring-1 ring-teal-500/10 rounded-2xl"></div>

                            <div class="relative h-full flex flex-col justify-center">
                                <div class="inline-flex items-center gap-2 rounded-full bg-white/60 border border-white/70 px-4 py-2 text-xs font-bold text-teal-950/80">
                                    <span class="h-2 w-2 rounded-full bg-teal-600"></span>
                                    PIETYL OPERATIONS PLATFORM
                                </div>

                                <h1 class="mt-5 text-5xl font-extrabold tracking-tight text-slate-900">
                                    PIETYL
                                </h1>

                                <p class="mt-3 text-xl font-bold text-slate-900">
                                    clean workflows for LPG stores, from inventory to accounting
                                </p>

                                <p class="mt-4 text-sm text-slate-700/90 leading-relaxed max-w-xl">
                                    Manage employees, items, suppliers, and customers with role based access.
                                    Built to grow into low stock alerts, sales flow, attendance tracking, and accounting without slowing your team down.
                                </p>

                                <div class="mt-7 flex flex-wrap gap-2">
                                    <div class="inline-flex items-center gap-2 rounded-xl bg-white/60 border border-white/70 px-3 py-2 text-xs text-slate-800">
                                        <span class="text-teal-800 font-bold">✓</span>
                                        Role based access
                                    </div>
                                    <div class="inline-flex items-center gap-2 rounded-xl bg-white/60 border border-white/70 px-3 py-2 text-xs text-slate-800">
                                        <span class="text-teal-800 font-bold">✓</span>
                                        Inventory ready
                                    </div>
                                    <div class="inline-flex items-center gap-2 rounded-xl bg-white/60 border border-white/70 px-3 py-2 text-xs text-slate-800">
                                        <span class="text-teal-800 font-bold">✓</span>
                                        Secure sign in
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>

    <!-- GLASS FOOTER (centered) -->
    <footer class="border-t border-white/30 bg-white/30 backdrop-blur-2xl backdrop-saturate-150">
        <div class="max-w-6xl mx-auto px-6 py-2.5">
            <div class="flex items-center justify-center text-[11px] text-slate-600/90 gap-2">
                <div class="h-5 w-5 rounded-md bg-teal-600 flex items-center justify-center text-white font-bold text-[10px] shadow-sm shadow-teal-600/20">
                    P
                </div>
                <span>© 2026 PIETYL. All rights reserved.</span>
            </div>
        </div>
    </footer>

</body>
</html>
