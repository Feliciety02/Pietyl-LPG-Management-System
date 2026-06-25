<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex min-h-screen bg-kcream">
        <!-- Left Brand Panel -->
        <div class="hidden w-1/2 flex-col justify-between bg-gradient-to-br from-kpink via-klavender to-kblue p-12 lg:flex relative overflow-hidden">
            <!-- Decorative -->
            <div class="absolute top-10 left-10 text-5xl animate-float opacity-20">🐷</div>
            <div class="absolute top-20 right-20 text-4xl animate-bounce-soft opacity-15">💰</div>
            <div class="absolute bottom-20 left-20 text-5xl animate-float opacity-15" style="animation-delay: 1s">🌸</div>
            <div class="absolute bottom-40 right-10 text-4xl animate-bounce-soft opacity-15" style="animation-delay: 0.5s">✨</div>
            <div class="absolute top-1/3 right-1/4 text-3xl animate-twinkle opacity-20">⭐</div>
            <div class="absolute top-2/3 left-1/4 text-5xl animate-float opacity-10" style="animation-delay: 2s">☁️</div>
            <div class="absolute -top-20 -right-20 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 h-96 w-96 rounded-full bg-white/10 blur-3xl"></div>

            <div class="relative z-10">
                <Link href="/" class="inline-flex items-center gap-3">
                    <ApplicationLogo class="h-11 w-11" />
                    <span class="text-2xl font-extrabold text-white drop-shadow-sm">SpendWise</span>
                </Link>
            </div>

            <div class="relative z-10 space-y-6">
                <div class="space-y-3">
                    <div class="text-5xl mb-2 animate-bounce-soft">🐷</div>
                    <h2 class="text-3xl font-extrabold leading-tight text-white drop-shadow-sm">Saving money has never been this cute.</h2>
                    <p class="text-lg text-white/80 font-medium">Track your spending, grow your savings, and celebrate every financial win.</p>
                </div>

                <div class="grid gap-3">
                    <div class="flex items-center gap-3 rounded-2xl bg-white/15 p-4 backdrop-blur-sm hover:bg-white/25 transition-all">
                        <span class="text-xl">💸</span>
                        <span class="text-sm font-bold text-white">Track every expense and income</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl bg-white/15 p-4 backdrop-blur-sm hover:bg-white/25 transition-all">
                        <span class="text-xl">📊</span>
                        <span class="text-sm font-bold text-white">View cute visual reports</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl bg-white/15 p-4 backdrop-blur-sm hover:bg-white/25 transition-all">
                        <span class="text-xl">🎯</span>
                        <span class="text-sm font-bold text-white">Save smarter every day</span>
                    </div>
                </div>
            </div>

            <p class="relative z-10 text-sm text-white/50 font-medium">&copy; SpendWise &mdash; Making saving fun! 🎀</p>
        </div>

        <!-- Right Form Panel -->
        <div class="flex w-full items-center justify-center px-6 py-12 lg:w-1/2">
            <div class="absolute left-0 top-0 flex w-full items-center justify-center gap-2 border-b border-kpink/10 bg-white p-4 lg:hidden">
                <Link href="/" class="inline-flex items-center gap-2">
                    <ApplicationLogo class="h-8 w-8" />
                    <span class="text-lg font-extrabold text-ktext">SpendWise</span>
                </Link>
            </div>

            <div class="w-full max-w-md">
                <div class="rounded-4xl bg-white p-8 shadow-xl shadow-kpink/10 ring-1 ring-kpink/10">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
