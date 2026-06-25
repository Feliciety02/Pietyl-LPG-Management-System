<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

const navItems = [
    { name: 'Dashboard', route: 'dashboard', emoji: '🏡' },
    { name: 'Transactions', route: 'transactions.index', emoji: '💸' },
    { name: 'Categories', route: 'categories.index', emoji: '🧁' },
    { name: 'Reports', route: 'reports.monthly', emoji: '📖' },
    { name: 'Achievements', route: 'achievements.index', emoji: '🏆' },
    { name: 'Profile', route: 'profile.edit', emoji: '🎀' },
];
</script>

<template>
    <div class="min-h-screen bg-kcream">
        <!-- Mobile Nav -->
        <nav class="border-b border-kpink/10 bg-white lg:hidden">
            <div class="mx-auto max-w-7xl px-4 sm:px-6">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-3">
                        <Link :href="route('dashboard')" class="flex items-center gap-2">
                            <ApplicationLogo class="h-8 w-8" />
                            <span class="text-lg font-extrabold text-ktext">SpendWise</span>
                        </Link>
                    </div>
                    <div class="flex items-center gap-2">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button class="flex items-center gap-2 rounded-2xl px-3 py-2 text-sm font-bold text-ktext hover:bg-kpink/10 transition-all">
                                    <span class="text-lg">🐷</span>
                                    <span class="hidden sm:inline">{{ $page.props.auth.user.name }}</span>
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </template>
                            <template #content>
                                <DropdownLink :href="route('profile.edit')">🎀 Profile</DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button">🚪 Log Out</DropdownLink>
                            </template>
                        </Dropdown>
                        <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="rounded-2xl p-2 text-gray-400 hover:bg-kpink/10 transition-all">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="border-t border-kpink/10 px-4 pb-3 pt-2">
                <div class="space-y-1">
                    <Link v-for="item in navItems" :key="item.name" :href="route(item.route)" :class="['flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition-all', route().current(item.route + '*') ? 'bg-gradient-to-r from-kpink/20 to-klavender/20 text-ktext shadow-sm' : 'text-gray-500 hover:bg-kpink/10 hover:text-ktext']">
                        <span class="text-lg">{{ item.emoji }}</span>
                        {{ item.name }}
                    </Link>
                </div>
            </div>
        </nav>

        <!-- Desktop Sidebar -->
        <aside class="fixed left-0 top-0 hidden h-full w-64 flex-col border-r border-kpink/10 bg-white lg:flex">
            <div class="flex items-center gap-3 border-b border-kpink/10 px-6 py-5">
                <Link :href="route('dashboard')" class="flex items-center gap-3">
                    <ApplicationLogo class="h-10 w-10" />
                    <span class="text-xl font-extrabold text-ktext">SpendWise</span>
                </Link>
            </div>
            <nav class="flex-1 space-y-1.5 px-4 py-5">
                <Link v-for="item in navItems" :key="item.name" :href="route(item.route)" :class="['flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition-all duration-200 hover:scale-[1.02]', route().current(item.route + '*') ? 'bg-gradient-to-r from-kpink/20 to-klavender/20 text-ktext shadow-sm' : 'text-gray-500 hover:text-ktext hover:bg-kpink/10']">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-white to-gray-50 shadow-sm text-base">{{ item.emoji }}</span>
                    {{ item.name }}
                </Link>
            </nav>
            <div class="border-t border-kpink/10 p-4">
                <Dropdown align="left" width="48">
                    <template #trigger>
                        <button class="flex w-full items-center gap-3 rounded-2xl px-3 py-2.5 text-sm font-bold text-ktext transition-all hover:bg-kpink/10">
                            <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-kpink/20 to-klavender/20 text-base">🐷</span>
                            <span class="flex-1 truncate text-left">{{ $page.props.auth.user.name }}</span>
                            <svg class="h-4 w-4 shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </template>
                    <template #content>
                        <DropdownLink :href="route('profile.edit')">🎀 Profile</DropdownLink>
                        <DropdownLink :href="route('logout')" method="post" as="button">🚪 Log Out</DropdownLink>
                    </template>
                </Dropdown>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="lg:pl-64">
            <main class="p-4 sm:p-6 lg:p-8">
                <slot />
            </main>
        </div>
    </div>
</template>
