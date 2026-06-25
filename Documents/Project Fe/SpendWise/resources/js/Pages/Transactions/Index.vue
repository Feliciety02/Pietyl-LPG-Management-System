<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ transactions: Object, categories: Array, filters: Object });

const search = ref(props.filters?.search || '');
const type = ref(props.filters?.type || '');
const categoryId = ref(props.filters?.category_id || '');
const month = ref(props.filters?.month || '');

const categoryEmojis = {
    'Food': '🍔', 'Entertainment': '🍿', 'Shopping': '🛍️', 'Transport': '🚗',
    'Bills': '🏠', 'Gifts': '🎁', 'Work': '💻', 'Salary': '💼',
    'Freelance': '💻', 'Investment': '📈', 'Drinks': '🧋', 'Games': '🎮',
    'Home': '🏡', 'School': '📚',
};

function destroy(id) {
    if (confirm('Are you sure you want to delete this transaction?')) {
        router.delete(route('transactions.destroy', id));
    }
}

function applyFilters() {
    router.get(route('transactions.index'), {
        search: search.value, type: type.value, category_id: categoryId.value, month: month.value,
    }, { preserveState: true, replace: true });
}
</script>

<template>
    <Head title="Transactions" />
    <AuthenticatedLayout>
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-ktext">💸 Transactions</h1>
                <p class="text-sm text-gray-500">Each transaction tells a story 📖</p>
            </div>
            <Link :href="route('transactions.create')" class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-kpink to-klavender px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-kpink/30 transition-all hover:shadow-xl hover:scale-[1.03]">🌸 Add Transaction</Link>
        </div>

        <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-4">
            <input v-model="search" placeholder="🔍 Search..." @input="applyFilters" class="rounded-2xl border-2 border-kpink/20 bg-white px-4 py-2.5 text-sm shadow-sm transition placeholder:text-gray-300 focus:border-kpink/50 focus:ring-4 focus:ring-kpink/10 focus:outline-none" />
            <select v-model="type" @change="applyFilters" class="rounded-2xl border-2 border-kpink/20 bg-white px-4 py-2.5 text-sm shadow-sm transition focus:border-kpink/50 focus:ring-4 focus:ring-kpink/10 focus:outline-none">
                <option value="">All Types</option>
                <option value="income">💰 Income</option>
                <option value="expense">💳 Expense</option>
            </select>
            <select v-model="categoryId" @change="applyFilters" class="rounded-2xl border-2 border-kpink/20 bg-white px-4 py-2.5 text-sm shadow-sm transition focus:border-kpink/50 focus:ring-4 focus:ring-kpink/10 focus:outline-none">
                <option value="">All Categories</option>
                <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ categoryEmojis[cat.name] || '📁' }} {{ cat.name }}</option>
            </select>
            <input v-model="month" type="month" @change="applyFilters" class="rounded-2xl border-2 border-kpink/20 bg-white px-4 py-2.5 text-sm shadow-sm transition focus:border-kpink/50 focus:ring-4 focus:ring-kpink/10 focus:outline-none" />
        </div>

        <div v-if="transactions.data.length === 0" class="rounded-3xl bg-white p-10 text-center shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
            <div class="text-6xl mb-4 animate-float">🐰</div>
            <h3 class="text-lg font-extrabold text-ktext">Nothing here yet!</h3>
            <p class="mt-2 text-sm text-gray-500">Let's record your first transaction!</p>
        </div>

        <div v-else class="space-y-3">
            <div v-for="txn in transactions.data" :key="txn.id" class="group rounded-3xl bg-white p-4 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10 transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 hover:shadow-kpink/20">
                <div class="flex items-center gap-4">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl text-2xl bg-gradient-to-br" :class="txn.type === 'income' ? 'from-kmint/30 to-kblue/30' : 'from-kpink/20 to-klavender/20'">
                        {{ txn.type === 'income' ? '💼' : (categoryEmojis[txn.category?.name] || '💳') }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-extrabold text-ktext truncate">{{ txn.title }}</span>
                            <span class="shrink-0 rounded-full px-2.5 py-0.5 text-xs font-bold" :class="txn.type === 'income' ? 'bg-kmint/30 text-emerald-700' : 'bg-kpink/30 text-ktext'">{{ txn.category?.name || 'Uncategorized' }}</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-0.5">📅 {{ txn.transaction_date }}</p>
                    </div>
                    <div class="text-right shrink-0">
                        <div class="text-lg font-extrabold" :class="txn.type === 'income' ? 'text-emerald-600' : 'text-coral'">{{ txn.type === 'income' ? '+' : '-' }}{{ parseFloat(txn.amount).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}</div>
                    </div>
                    <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-all shrink-0">
                        <Link :href="route('transactions.edit', txn.id)" class="rounded-xl bg-kpink/20 px-3 py-1.5 text-xs font-bold text-kpink hover:bg-kpink/30 transition">✏️</Link>
                        <button @click="destroy(txn.id)" class="rounded-xl bg-coral/20 px-3 py-1.5 text-xs font-bold text-coral hover:bg-coral/30 transition">🗑️</button>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="transactions.links" class="mt-6 flex flex-wrap justify-center gap-2">
            <Link v-for="(link, i) in transactions.links" :key="i" :href="link.url || '#'" v-html="link.label" :class="[link.active ? 'bg-gradient-to-r from-kpink to-klavender text-white shadow-md' : 'bg-white text-gray-600 hover:bg-kpink/10 ring-1 ring-kpink/10', 'rounded-2xl px-4 py-2 text-sm font-bold transition-all']" />
        </div>
    </AuthenticatedLayout>
</template>
