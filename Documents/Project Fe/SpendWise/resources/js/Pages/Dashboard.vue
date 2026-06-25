<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MascotCompanion from '@/Components/MascotCompanion.vue';
import AchievementUnlock from '@/Components/AchievementUnlock.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

const props = defineProps({
    totalIncome: Number,
    totalExpenses: Number,
    balance: Number,
    thisMonthExpenses: Number,
    expensesByCategory: Array,
    monthlyOverview: Array,
    gamification: Object,
});

const showUnlock = ref(false);
const lastAchievement = ref(null);

let expenseChart = null;
let overviewChart = null;

onMounted(() => {
    renderExpenseChart();
    renderOverviewChart();
});

watch(() => props.monthlyOverview, () => {
    renderOverviewChart();
});

function renderExpenseChart() {
    const ctx = document.getElementById('expenseChart');
    if (!ctx) return;

    const labels = props.expensesByCategory.map(e => e.category?.name || 'Unknown');
    const data = props.expensesByCategory.map(e => parseFloat(e.total));

    if (expenseChart) expenseChart.destroy();

    expenseChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels,
            datasets: [{
                data,
                backgroundColor: ['#FFB6D9', '#DCC6FF', '#BFE8FF', '#B9FBC0', '#FFD6BA', '#FFF3B0', '#FB7185', '#A78BFA'],
                borderWidth: 0,
            }],
        },
        options: {
            responsive: true,
            cutout: '72%',
            plugins: {
                legend: { position: 'right', labels: { usePointStyle: true, padding: 16, font: { family: 'Fredoka', size: 11 } } },
            },
        },
    });
}

function renderOverviewChart() {
    const ctx = document.getElementById('overviewChart');
    if (!ctx) return;

    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const labels = props.monthlyOverview.map(m => {
        const [y, month] = m.month.split('-');
        return monthNames[parseInt(month) - 1];
    });
    const incomeData = props.monthlyOverview.map(m => parseFloat(m.income));
    const expenseData = props.monthlyOverview.map(m => parseFloat(m.expense));

    if (overviewChart) overviewChart.destroy();

    overviewChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [
                { label: 'Income', data: incomeData, backgroundColor: 'rgba(185, 251, 192, 0.7)', borderRadius: 8, borderSkipped: false },
                { label: 'Expenses', data: expenseData, backgroundColor: 'rgba(255, 182, 217, 0.7)', borderRadius: 8, borderSkipped: false },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top', labels: { usePointStyle: true, font: { family: 'Fredoka', size: 11 } } },
            },
            scales: {
                y: { beginAtZero: true, grid: { color: '#F3F4F6' } },
                x: { grid: { display: false } },
            },
        },
    });
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- Greeting + Gamification -->
        <div class="mb-6">
            <div class="flex items-start gap-4">
                <MascotCompanion :mood="gamification.streak > 0 ? 'happy' : 'wave'" size="lg" />
                <div class="flex-1">
                    <h1 class="text-2xl font-extrabold text-ktext">🌸 Good {{ new Date().getHours() < 12 ? 'Morning' : new Date().getHours() < 18 ? 'Afternoon' : 'Evening' }}, {{ $page.props.auth.user.name }}!</h1>
                    <p class="text-sm text-gray-500" v-if="gamification.streak > 0">🔥 {{ gamification.streak }}-day streak! How's your wallet feeling today?</p>
                    <p class="text-sm text-gray-500" v-else>Let's start tracking today! 🐷</p>
                </div>
            </div>

            <!-- XP Bar -->
            <div class="mt-4 rounded-3xl bg-white p-4 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <span class="rounded-xl bg-gradient-to-r from-kpink/20 to-klavender/20 px-3 py-1 text-sm font-bold text-ktext">⭐ Lv.{{ gamification.level }}</span>
                        <span class="text-sm font-semibold text-gray-500">{{ gamification.title }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span v-if="gamification.recent_achievements.length > 0" class="text-sm font-bold text-kpink">🏆 {{ gamification.recent_achievements[0].name }}</span>
                        <Link :href="route('achievements.index')" class="text-xs font-bold text-klavender hover:text-kpink transition">View All →</Link>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex-1 h-2.5 rounded-full bg-gray-100 overflow-hidden">
                        <div class="h-full rounded-full bg-gradient-to-r from-kpink to-klavender transition-all duration-500" :style="{ width: Math.min(gamification.progress_in_level, 100) + '%' }"></div>
                    </div>
                    <span class="text-xs font-bold text-gray-400 shrink-0">{{ gamification.xp - gamification.current_level_xp }}/{{ gamification.next_level_xp - gamification.current_level_xp }} XP</span>
                </div>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="group rounded-3xl bg-white p-5 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:shadow-kpink/20">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-500">💰 Balance</span>
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-kpink/20 to-klavender/20">🐷</div>
                </div>
                <div :class="balance >= 0 ? 'text-ktext' : 'text-coral'" class="mt-3 text-2xl font-extrabold">
                    {{ balance.toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}
                </div>
                <p class="mt-1 text-xs font-semibold text-kpink">{{ balance >= 0 ? '🌸 Looking good!' : '🥺 Need attention' }}</p>
            </div>

            <div class="group rounded-3xl bg-white p-5 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:shadow-kpink/20">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-500">🌷 Income</span>
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-kmint/30 to-kblue/30">💎</div>
                </div>
                <div class="mt-3 text-2xl font-extrabold text-ktext">{{ totalIncome.toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}</div>
                <p class="mt-1 text-xs font-semibold text-kmint-600">✨ Total earnings</p>
            </div>

            <div class="group rounded-3xl bg-white p-5 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:shadow-kpink/20">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-500">🍓 Expenses</span>
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-kpeach/30 to-kbutter/30">💳</div>
                </div>
                <div class="mt-3 text-2xl font-extrabold text-ktext">{{ totalExpenses.toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}</div>
                <p class="mt-1 text-xs font-semibold">🍔 Mostly Food</p>
            </div>

            <div class="group rounded-3xl bg-white p-5 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:shadow-kpink/20">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-500">⭐ Savings Rate</span>
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-klavender/30 to-kpink/20">🌟</div>
                </div>
                <div class="mt-3 text-2xl font-extrabold text-ktext">{{ totalIncome > 0 ? Math.round((balance / totalIncome) * 100) : 0 }}%</div>
                <p class="mt-1 text-xs font-semibold text-klavender">🌈 Amazing!</p>
            </div>
        </div>

        <!-- Charts -->
        <div v-if="expensesByCategory.length > 0 || monthlyOverview.length > 0" class="mb-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div v-if="expensesByCategory.length > 0" class="rounded-3xl bg-white p-6 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
                <h3 class="mb-4 text-lg font-extrabold text-ktext">🌷 Expenses by Category</h3>
                <canvas id="expenseChart"></canvas>
            </div>
            <div v-if="monthlyOverview.length > 0" class="rounded-3xl bg-white p-6 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
                <h3 class="mb-4 text-lg font-extrabold text-ktext">📊 Income vs Expenses</h3>
                <canvas id="overviewChart"></canvas>
            </div>
        </div>

        <!-- Empty State -->
        <div v-if="expensesByCategory.length === 0 && monthlyOverview.length === 0" class="rounded-3xl bg-white p-10 text-center shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
            <div class="mb-4 flex justify-center">
                <MascotCompanion mood="excited" size="xl" />
            </div>
            <h3 class="text-lg font-extrabold text-ktext">🐰 Nothing here yet!</h3>
            <p class="mt-2 text-sm text-gray-500">Let's record your first expense or income!</p>
            <Link :href="route('transactions.create')" class="mt-4 inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-kpink to-klavender px-6 py-3 text-sm font-bold text-white shadow-lg shadow-kpink/30 transition-all hover:shadow-xl hover:scale-[1.03]">
                🌸 Add Transaction
            </Link>
        </div>

        <!-- Savings Goal -->
        <div class="rounded-3xl bg-white p-6 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
            <h3 class="text-lg font-extrabold text-ktext mb-4">🎯 Savings Goal</h3>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="font-semibold text-gray-500">Progress</span>
                    <span class="font-extrabold text-kpink">{{ totalIncome > 0 ? Math.round((balance / totalIncome) * 100) : 0 }}%</span>
                </div>
                <div class="h-4 rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full rounded-full bg-gradient-to-r from-kpink to-klavender transition-all duration-500" :style="{ width: Math.min(totalIncome > 0 ? (balance / totalIncome) * 100 : 0, 100) + '%' }"></div>
                </div>
                <p class="text-xs text-gray-400">
                    <span v-if="balance >= 0">🌱🌱🌱 Almost there! Keep it up!</span>
                    <span v-else>🌱 Let's focus on saving more!</span>
                </p>
            </div>
        </div>

        <AchievementUnlock :show="showUnlock" :achievement="lastAchievement" @close="showUnlock = false" />
    </AuthenticatedLayout>
</template>
