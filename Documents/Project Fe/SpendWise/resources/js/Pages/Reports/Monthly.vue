<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

const props = defineProps({ months: Array, totals: Object, topCategory: Object, year: Number });
const currentYear = ref(props.year);
let incomeExpenseChart = null;
const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

function updateYear(year) {
    currentYear.value = year;
    router.get(route('reports.monthly'), { year }, { preserveState: true, replace: true });
}

onMounted(() => { renderChart(); });
watch(() => props.months, () => { renderChart(); });

function renderChart() {
    if (incomeExpenseChart) incomeExpenseChart.destroy();
    const ctx = document.getElementById('incomeExpenseChart');
    if (!ctx) return;

    const labels = props.months.map(m => monthNames[m.month - 1]);
    const incomeData = props.months.map(m => parseFloat(m.income));
    const expenseData = props.months.map(m => parseFloat(m.expense));

    incomeExpenseChart = new Chart(ctx, {
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
            plugins: { legend: { position: 'top', labels: { usePointStyle: true, font: { family: 'Fredoka', size: 11 } } } },
            scales: { y: { beginAtZero: true, grid: { color: '#F3F4F6' } }, x: { grid: { display: false } } },
        },
    });
}
</script>

<template>
    <Head title="Monthly Report" />
    <AuthenticatedLayout>
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-ktext">📖 Monthly Report</h1>
                <p class="text-sm text-gray-500">Your financial story for the year</p>
            </div>
            <div class="flex items-center gap-2">
                <button @click="updateYear(currentYear - 1)" class="rounded-2xl bg-white px-4 py-2 text-sm font-bold text-gray-600 shadow-sm ring-1 ring-kpink/10 transition hover:bg-kpink/10">‹</button>
                <span class="text-lg font-extrabold text-ktext min-w-[80px] text-center">{{ currentYear }}</span>
                <button @click="updateYear(currentYear + 1)" class="rounded-2xl bg-white px-4 py-2 text-sm font-bold text-gray-600 shadow-sm ring-1 ring-kpink/10 transition hover:bg-kpink/10">›</button>
            </div>
        </div>

        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="group rounded-3xl bg-white p-5 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-500">🌷 Total Income</span>
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-kmint/30 to-kblue/30">💰</div>
                </div>
                <div class="mt-3 text-2xl font-extrabold text-ktext">{{ parseFloat(totals.income).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}</div>
            </div>
            <div class="group rounded-3xl bg-white p-5 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-500">🍓 Total Expenses</span>
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-kpink/20 to-klavender/20">💳</div>
                </div>
                <div class="mt-3 text-2xl font-extrabold text-coral">{{ parseFloat(totals.expense).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}</div>
            </div>
            <div class="group rounded-3xl bg-white p-5 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-500">⭐ Balance</span>
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-kpeach/30 to-kbutter/30">🐷</div>
                </div>
                <div :class="totals.balance >= 0 ? 'text-ktext' : 'text-coral'" class="mt-3 text-2xl font-extrabold">{{ parseFloat(totals.balance).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}</div>
            </div>
        </div>

        <div v-if="topCategory" class="mb-6 rounded-3xl bg-white p-5 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-coral/20 to-kpeach/30 text-2xl">🔥</div>
                <div>
                    <div class="text-sm font-semibold text-gray-500">Top Spending Category</div>
                    <div class="text-xl font-extrabold text-ktext">{{ topCategory.name }}</div>
                    <div class="text-sm font-bold text-coral">{{ parseFloat(topCategory.transactions_sum_amount || 0).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}</div>
                </div>
            </div>
        </div>

        <div class="mb-6 rounded-3xl bg-white shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
            <div class="p-6">
                <h3 class="mb-4 text-lg font-extrabold text-ktext">📊 Monthly Breakdown</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-kpink/10">
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Month</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Income</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Expenses</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Balance</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-kpink/10">
                            <tr v-for="m in months" :key="m.month" class="hover:bg-kpink/5 transition">
                                <td class="px-4 py-4 font-extrabold text-ktext">{{ monthNames[m.month - 1] }}</td>
                                <td class="px-4 py-4 font-extrabold text-emerald-600">{{ parseFloat(m.income).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}</td>
                                <td class="px-4 py-4 font-extrabold text-coral">{{ parseFloat(m.expense).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}</td>
                                <td class="px-4 py-4 font-extrabold" :class="parseFloat(m.income) - parseFloat(m.expense) >= 0 ? 'text-ktext' : 'text-coral'">{{ (parseFloat(m.income) - parseFloat(m.expense)).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
            <h3 class="mb-4 text-lg font-extrabold text-ktext">📈 Income vs Expenses</h3>
            <canvas id="incomeExpenseChart"></canvas>
        </div>
    </AuthenticatedLayout>
</template>
