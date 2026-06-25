<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: { type: Boolean },
    canRegister: { type: Boolean },
});
</script>

<template>
    <Head title="Welcome" />

    <div class="flex min-h-screen flex-col bg-gradient-to-br from-kpink via-klavender to-kblue relative overflow-hidden">
        <!-- Floating decorations -->
        <div class="absolute top-10 left-10 text-6xl animate-float opacity-30">🐷</div>
        <div class="absolute top-20 right-20 text-4xl animate-bounce-soft opacity-20">💰</div>
        <div class="absolute bottom-20 left-20 text-5xl animate-float opacity-20" style="animation-delay: 1s">🌸</div>
        <div class="absolute bottom-40 right-10 text-4xl animate-bounce-soft opacity-20" style="animation-delay: 0.5s">✨</div>
        <div class="absolute top-1/3 left-1/4 text-3xl animate-twinkle opacity-20" style="animation-delay: 2s">⭐</div>
        <div class="absolute top-2/3 right-1/4 text-5xl animate-float opacity-15" style="animation-delay: 1.5s">☁️</div>
        <div class="absolute top-1/4 right-1/3 text-4xl animate-twinkle opacity-15" style="animation-delay: 3s">🌟</div>
        <div class="absolute bottom-1/3 left-1/3 text-3xl animate-float opacity-15" style="animation-delay: 2.5s">🍓</div>
        <div class="absolute -top-20 -left-20 h-96 w-96 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute -bottom-20 -right-20 h-96 w-96 rounded-full bg-white/10 blur-3xl"></div>

        <!-- Nav -->
        <nav class="relative z-10 flex items-center justify-between px-6 py-4 sm:px-10">
            <div class="flex items-center gap-3">
                <div class="rounded-2xl bg-white/20 p-2 backdrop-blur-sm">
                    <span class="text-2xl">🐷</span>
                </div>
                <span class="text-xl font-extrabold text-white drop-shadow-sm">SpendWise</span>
            </div>
            <div v-if="canLogin" class="flex items-center gap-3">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="rounded-2xl bg-white px-6 py-2.5 text-sm font-bold text-kpink shadow-lg transition-all hover:shadow-xl hover:scale-[1.03]">🏡 Dashboard</Link>
                <template v-else>
                    <Link :href="route('login')" class="rounded-2xl px-5 py-2.5 text-sm font-bold text-white/90 transition hover:text-white hover:bg-white/10">Sign In</Link>
                    <Link v-if="canRegister" :href="route('register')" class="rounded-2xl bg-white px-6 py-2.5 text-sm font-bold text-kpink shadow-lg transition-all hover:shadow-xl hover:scale-[1.03]">🌸 Get Started</Link>
                </template>
            </div>
        </nav>

        <!-- Hero -->
        <main class="relative z-10 flex flex-1 flex-col items-center justify-center px-6 text-center">
            <div class="max-w-3xl">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-white/20 px-5 py-2 text-sm font-bold text-white backdrop-blur-sm animate-bounce-soft">
                    <span>🐷</span> Take control of your finances
                </div>
                <h1 class="text-5xl font-extrabold tracking-tight text-white drop-shadow-sm sm:text-6xl lg:text-7xl">
                    Saving money<br>
                    <span class="text-kbutter">has never been this cute.</span>
                </h1>
                <p class="mx-auto mt-6 max-w-xl text-lg font-medium text-white/80">
                    SpendWise helps you track spending, grow savings, and celebrate every financial win — all with a smile. 🎀
                </p>
                <div v-if="canLogin && !$page.props.auth.user" class="mt-10 flex items-center justify-center gap-4">
                    <Link :href="route('register')" class="rounded-2xl bg-white px-8 py-3.5 text-base font-bold text-kpink shadow-xl shadow-kpink/30 transition-all hover:shadow-2xl hover:scale-[1.03] active:scale-[0.98]">🌱 Start Saving</Link>
                    <Link :href="route('login')" class="rounded-2xl bg-white/15 px-8 py-3.5 text-base font-bold text-white backdrop-blur-sm transition hover:bg-white/25">Sign In</Link>
                </div>
            </div>

            <!-- Features -->
            <div class="mt-20 grid w-full max-w-5xl gap-5 px-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="group rounded-3xl border border-white/20 bg-white/10 p-6 text-left backdrop-blur-sm transition-all duration-300 hover:bg-white/20 hover:shadow-xl hover:-translate-y-1">
                    <div class="mb-4 text-3xl">💸</div>
                    <h3 class="text-lg font-extrabold text-white">Track Transactions</h3>
                    <p class="mt-2 text-sm text-white/70">Log every income and expense. Categorize and search your financial history effortlessly.</p>
                </div>
                <div class="group rounded-3xl border border-white/20 bg-white/10 p-6 text-left backdrop-blur-sm transition-all duration-300 hover:bg-white/20 hover:shadow-xl hover:-translate-y-1">
                    <div class="mb-4 text-3xl">📊</div>
                    <h3 class="text-lg font-extrabold text-white">Cute Analytics</h3>
                    <p class="mt-2 text-sm text-white/70">Beautiful pastel charts and reports that show where your money goes each month.</p>
                </div>
                <div class="group rounded-3xl border border-white/20 bg-white/10 p-6 text-left backdrop-blur-sm transition-all duration-300 hover:bg-white/20 hover:shadow-xl hover:-translate-y-1 sm:col-span-2 lg:col-span-1">
                    <div class="mb-4 text-3xl">🎯</div>
                    <h3 class="text-lg font-extrabold text-white">Smart Goals</h3>
                    <p class="mt-2 text-sm text-white/70">Set savings goals, earn achievements, and watch your money grow like a garden. 🌱</p>
                </div>
            </div>

            <footer class="mt-20 w-full border-t border-white/10 px-6 py-8 text-center">
                <p class="text-sm text-white/40 font-medium">🐷 SpendWise &mdash; Making saving fun! 🎀</p>
            </footer>
        </main>
    </div>
</template>
