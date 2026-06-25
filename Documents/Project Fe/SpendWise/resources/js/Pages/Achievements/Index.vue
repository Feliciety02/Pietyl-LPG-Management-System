<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MascotCompanion from '@/Components/MascotCompanion.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    stats: Object,
    unlocked_achievements: Array,
    locked_achievements: Array,
    total_achievements: Number,
    unlocked_count: Number,
});
</script>

<template>
    <Head title="Achievements" />

    <AuthenticatedLayout>
        <div class="mb-6">
            <div class="flex items-center gap-4">
                <MascotCompanion mood="excited" size="lg" />
                <div>
                    <h1 class="text-2xl font-extrabold text-ktext">🏆 Achievements</h1>
                    <p class="text-sm text-gray-500">Collect them all and become a SpendWise Legend!</p>
                </div>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="mb-8 rounded-3xl bg-white p-6 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                <div class="text-center">
                    <div class="text-sm font-semibold text-gray-500">Level</div>
                    <div class="text-2xl font-extrabold text-ktext">{{ stats.level }}</div>
                    <div class="text-xs font-medium text-kpink">{{ stats.title }}</div>
                </div>
                <div class="text-center">
                    <div class="text-sm font-semibold text-gray-500">XP</div>
                    <div class="text-2xl font-extrabold text-ktext">{{ stats.xp.toLocaleString() }}</div>
                    <div class="text-xs text-gray-400">{{ stats.current_level_xp }} / {{ stats.next_level_xp }}</div>
                </div>
                <div class="text-center">
                    <div class="text-sm font-semibold text-gray-500">🔥 Streak</div>
                    <div class="text-2xl font-extrabold text-ktext">{{ stats.streak }} days</div>
                    <div class="text-xs font-medium text-kpeach" v-if="stats.streak > 0">Keep going!</div>
                </div>
                <div class="text-center">
                    <div class="text-sm font-semibold text-gray-500">🎯 Progress</div>
                    <div class="text-2xl font-extrabold text-ktext">{{ unlocked_count }}/{{ total_achievements }}</div>
                    <div class="text-xs text-gray-400">{{ total_achievements > 0 ? Math.round((unlocked_count / total_achievements) * 100) : 0 }}% complete</div>
                </div>
            </div>

            <!-- XP Progress Bar -->
            <div class="mt-4">
                <div class="flex justify-between text-xs text-gray-400 mb-1.5">
                    <span>Level {{ stats.level }}</span>
                    <span>{{ stats.xp - stats.current_level_xp }} / {{ stats.next_level_xp - stats.current_level_xp }} XP</span>
                </div>
                <div class="h-3 rounded-full bg-gray-100 overflow-hidden">
                    <div
                        class="h-full rounded-full bg-gradient-to-r from-kpink to-klavender transition-all duration-500"
                        :style="{ width: Math.min(stats.progress_in_level, 100) + '%' }"
                    ></div>
                </div>
            </div>
        </div>

        <!-- Unlocked Achievements -->
        <div v-if="unlocked_achievements.length > 0" class="mb-8">
            <h2 class="mb-4 text-lg font-extrabold text-ktext">🎀 Recently Unlocked</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="achievement in unlocked_achievements" :key="achievement.id"
                    class="group rounded-3xl bg-white p-5 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10 transition-all duration-300 hover:shadow-lg hover:-translate-y-1"
                >
                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-kbutter/50 to-kpink/20 text-3xl animate-bounce-soft">
                            {{ achievement.emoji }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-ktext truncate">{{ achievement.name }}</h3>
                            <p class="text-xs text-gray-400 truncate">{{ achievement.description }}</p>
                            <div class="mt-1 inline-flex items-center gap-1 rounded-full bg-kbutter/30 px-2 py-0.5 text-xs font-bold text-ktext">
                                ✨ +{{ achievement.xp_reward }} XP
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Locked Achievements -->
        <div>
            <h2 class="mb-4 text-lg font-extrabold text-ktext">🔒 Still to Unlock</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="achievement in locked_achievements" :key="achievement.id"
                    class="group rounded-3xl bg-white/50 p-5 shadow-sm ring-1 ring-gray-100 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 opacity-70 hover:opacity-100"
                >
                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-3xl grayscale">
                            {{ achievement.emoji }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-400 truncate">{{ achievement.name }}</h3>
                            <p class="text-xs text-gray-300 truncate">{{ achievement.description }}</p>
                            <div class="mt-1 flex items-center gap-2">
                                <div class="flex-1 h-1.5 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full rounded-full bg-kpink/50" :style="{ width: Math.min((achievement.progress / achievement.condition_value) * 100, 100) + '%' }"></div>
                                </div>
                                <span class="text-xs font-bold text-gray-400">{{ achievement.progress }}/{{ achievement.condition_value }}</span>
                            </div>
                        </div>
                        <span class="text-lg">🔒</span>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
