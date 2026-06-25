<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({ status: { type: String } });

const form = useForm({ email: '' });

const submit = () => { form.post(route('password.email')); };
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />
        <div class="mb-6 text-center">
            <div class="text-5xl mb-3 animate-float">🔐</div>
            <h2 class="text-2xl font-extrabold text-ktext">Forgot password?</h2>
            <p class="mt-1 text-sm text-gray-500">No worries! We'll send you a reset link. 🐷</p>
        </div>
        <div v-if="status" class="mb-4 rounded-2xl bg-kmint/30 px-4 py-3 text-sm font-bold text-ktext ring-1 ring-kmint/30">🌿 {{ status }}</div>
        <form @submit.prevent="submit" class="space-y-5">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="email" class="mt-1.5 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                <InputError class="mt-1.5" :message="form.errors.email" />
            </div>
            <PrimaryButton class="w-full justify-center" :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                <svg v-if="form.processing" class="-ml-1 mr-2 h-4 w-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                </svg>
                ✨ Send Reset Link
            </PrimaryButton>
            <p class="text-center text-sm font-semibold text-gray-500">
                Remember your password?
                <Link :href="route('login')" class="font-extrabold text-kpink hover:text-klavender transition">Sign in 🎀</Link>
            </p>
        </form>
    </GuestLayout>
</template>
