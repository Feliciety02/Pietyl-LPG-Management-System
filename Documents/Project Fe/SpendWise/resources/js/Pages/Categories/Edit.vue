<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ category: Object });
const form = useForm({ name: props.category.name, type: props.category.type });
function submit() { form.put(route('categories.update', props.category.id)); }
</script>

<template>
    <Head title="Edit Category" />
    <AuthenticatedLayout>
        <div class="mb-6">
            <h1 class="text-2xl font-extrabold text-ktext">✏️ Edit Category</h1>
            <p class="text-sm text-gray-500">Update your category details</p>
        </div>
        <div class="mx-auto max-w-lg">
            <div class="rounded-3xl bg-white p-8 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
                <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-ktext/80">Name</label>
                        <input v-model="form.name" type="text" class="mt-1.5 block w-full rounded-2xl border-2 border-kpink/20 bg-white px-5 py-3 text-sm shadow-sm transition placeholder:text-gray-300 focus:border-kpink/50 focus:ring-4 focus:ring-kpink/10 focus:outline-none" />
                        <div v-if="form.errors.name" class="mt-1.5 text-sm font-bold text-coral">🥺 {{ form.errors.name }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-ktext/80">Type</label>
                        <select v-model="form.type" class="mt-1.5 block w-full rounded-2xl border-2 border-kpink/20 bg-white px-5 py-3 text-sm shadow-sm transition focus:border-kpink/50 focus:ring-4 focus:ring-kpink/10 focus:outline-none">
                            <option value="income">💰 Income</option>
                            <option value="expense">💳 Expense</option>
                        </select>
                        <div v-if="form.errors.type" class="mt-1.5 text-sm font-bold text-coral">🥺 {{ form.errors.type }}</div>
                    </div>
                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" :disabled="form.processing" class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-kpink to-klavender px-6 py-3 text-sm font-bold text-white shadow-lg shadow-kpink/30 transition-all hover:shadow-xl hover:scale-[1.03] disabled:opacity-50 disabled:hover:scale-100">
                            <svg v-if="form.processing" class="-ml-1 mr-1 h-4 w-4 animate-spin text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" /><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" /></svg>
                            💾 Update
                        </button>
                        <Link :href="route('categories.index')" class="text-sm font-bold text-gray-500 hover:text-ktext transition">Cancel</Link>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
