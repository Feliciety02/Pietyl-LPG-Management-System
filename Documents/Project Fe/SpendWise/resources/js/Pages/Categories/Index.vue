<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({ categories: Array });

const categoryEmojis = {
    'Food': '🍔', 'Entertainment': '🍿', 'Shopping': '🛍️', 'Transport': '🚗',
    'Bills': '🏠', 'Gifts': '🎁', 'Work': '💻', 'Salary': '💼',
    'Freelance': '💻', 'Investment': '📈', 'Drinks': '🧋', 'Games': '🎮',
    'Home': '🏡', 'School': '📚',
};

const typeColors = {
    income: 'bg-kmint/30 text-emerald-700',
    expense: 'bg-kpink/30 text-ktext',
};

function destroy(id) {
    if (confirm('Are you sure you want to delete this category?')) {
        router.delete(route('categories.destroy', id));
    }
}
</script>

<template>
    <Head title="Categories" />
    <AuthenticatedLayout>
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-ktext">🧁 Categories</h1>
                <p class="text-sm text-gray-500">Every category has its own personality!</p>
            </div>
            <Link :href="route('categories.create')" class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-kpink to-klavender px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-kpink/30 transition-all hover:shadow-xl hover:scale-[1.03]">✨ Add Category</Link>
        </div>

        <div v-if="categories.length === 0" class="rounded-3xl bg-white p-10 text-center shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
            <div class="text-6xl mb-4 animate-float">🐰</div>
            <h3 class="text-lg font-extrabold text-ktext">No categories yet!</h3>
            <p class="mt-2 text-sm text-gray-500">Create your first category to organize your transactions.</p>
        </div>

        <div v-else class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div v-for="category in categories" :key="category.id" class="group rounded-3xl bg-white p-5 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:shadow-kpink/20">
                <div class="flex items-start justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl text-2xl bg-gradient-to-br from-kpeach/30 to-kbutter/30">
                            {{ categoryEmojis[category.name] || '📁' }}
                        </div>
                        <div>
                            <h3 class="font-extrabold text-ktext">{{ category.name }}</h3>
                            <span class="rounded-full px-3 py-0.5 text-xs font-bold" :class="typeColors[category.type] || 'bg-gray-100 text-gray-600'">{{ category.type }}</span>
                        </div>
                    </div>
                    <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all">
                        <Link :href="route('categories.edit', category.id)" class="rounded-xl bg-kpink/20 px-3 py-1.5 text-xs font-bold text-kpink hover:bg-kpink/30 transition">✏️</Link>
                        <button @click="destroy(category.id)" class="rounded-xl bg-coral/20 px-3 py-1.5 text-xs font-bold text-coral hover:bg-coral/30 transition">🗑️</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
