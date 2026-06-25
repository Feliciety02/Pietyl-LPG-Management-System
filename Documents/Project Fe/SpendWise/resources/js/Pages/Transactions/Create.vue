<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ categories: Array });

const categoryEmojis = {
    'Food': '🍔', 'Entertainment': '🍿', 'Shopping': '🛍️', 'Transport': '🚗',
    'Bills': '🏠', 'Gifts': '🎁', 'Work': '💻', 'Salary': '💼',
};

const form = useForm({ category_id: '', title: '', amount: '', type: 'expense', transaction_date: new Date().toISOString().split('T')[0], notes: '' });
function submit() { form.post(route('transactions.store')); }
</script>

<template>
    <Head title="Create Transaction" />
    <AuthenticatedLayout>
        <div class="mb-6">
            <h1 class="text-2xl font-extrabold text-ktext">🌸 Add Transaction</h1>
            <p class="text-sm text-gray-500">Record a new income or expense</p>
        </div>
        <div class="mx-auto max-w-lg">
            <div class="rounded-3xl bg-white p-8 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
                <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-ktext/80">Type</label>
                        <div class="mt-1.5 grid grid-cols-2 gap-3">
                            <button type="button" @click="form.type = 'expense'" :class="['rounded-2xl border-2 px-4 py-3 text-sm font-bold transition-all', form.type === 'expense' ? 'border-coral bg-coral/10 text-coral' : 'border-kpink/20 bg-white text-gray-500 hover:border-gray-300']">💳 Expense</button>
                            <button type="button" @click="form.type = 'income'" :class="['rounded-2xl border-2 px-4 py-3 text-sm font-bold transition-all', form.type === 'income' ? 'border-kmint bg-kmint/30 text-emerald-700' : 'border-kpink/20 bg-white text-gray-500 hover:border-gray-300']">💰 Income</button>
                        </div>
                        <div v-if="form.errors.type" class="mt-1.5 text-sm font-bold text-coral">🥺 {{ form.errors.type }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-ktext/80">Category</label>
                        <select v-model="form.category_id" class="mt-1.5 block w-full rounded-2xl border-2 border-kpink/20 bg-white px-5 py-3 text-sm shadow-sm transition focus:border-kpink/50 focus:ring-4 focus:ring-kpink/10 focus:outline-none">
                            <option value="">Select Category</option>
                            <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ categoryEmojis[cat.name] || '📁' }} {{ cat.name }}</option>
                        </select>
                        <div v-if="form.errors.category_id" class="mt-1.5 text-sm font-bold text-coral">🥺 {{ form.errors.category_id }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-ktext/80">Title</label>
                        <input v-model="form.title" type="text" placeholder="e.g. Pizza Hut, Salary" class="mt-1.5 block w-full rounded-2xl border-2 border-kpink/20 bg-white px-5 py-3 text-sm shadow-sm transition placeholder:text-gray-300 focus:border-kpink/50 focus:ring-4 focus:ring-kpink/10 focus:outline-none" />
                        <div v-if="form.errors.title" class="mt-1.5 text-sm font-bold text-coral">🥺 {{ form.errors.title }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-ktext/80">Amount</label>
                        <div class="relative mt-1.5">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-sm font-bold text-gray-400">$</span>
                            <input v-model="form.amount" type="number" step="0.01" min="0" placeholder="0.00" class="block w-full rounded-2xl border-2 border-kpink/20 bg-white pl-10 pr-5 py-3 text-sm shadow-sm transition placeholder:text-gray-300 focus:border-kpink/50 focus:ring-4 focus:ring-kpink/10 focus:outline-none" />
                        </div>
                        <div v-if="form.errors.amount" class="mt-1.5 text-sm font-bold text-coral">🥺 {{ form.errors.amount }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-ktext/80">Date</label>
                        <input v-model="form.transaction_date" type="date" class="mt-1.5 block w-full rounded-2xl border-2 border-kpink/20 bg-white px-5 py-3 text-sm shadow-sm transition focus:border-kpink/50 focus:ring-4 focus:ring-kpink/10 focus:outline-none" />
                        <div v-if="form.errors.transaction_date" class="mt-1.5 text-sm font-bold text-coral">🥺 {{ form.errors.transaction_date }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-ktext/80">Notes</label>
                        <textarea v-model="form.notes" rows="3" placeholder="Optional notes..." class="mt-1.5 block w-full rounded-2xl border-2 border-kpink/20 bg-white px-5 py-3 text-sm shadow-sm transition placeholder:text-gray-300 focus:border-kpink/50 focus:ring-4 focus:ring-kpink/10 focus:outline-none"></textarea>
                        <div v-if="form.errors.notes" class="mt-1.5 text-sm font-bold text-coral">🥺 {{ form.errors.notes }}</div>
                    </div>
                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" :disabled="form.processing" class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-kpink to-klavender px-6 py-3 text-sm font-bold text-white shadow-lg shadow-kpink/30 transition-all hover:shadow-xl hover:scale-[1.03] disabled:opacity-50 disabled:hover:scale-100">
                            <svg v-if="form.processing" class="-ml-1 mr-1 h-4 w-4 animate-spin text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" /><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" /></svg>
                            🌸 Add Transaction
                        </button>
                        <Link :href="route('transactions.index')" class="text-sm font-bold text-gray-500 hover:text-ktext transition">Cancel</Link>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
