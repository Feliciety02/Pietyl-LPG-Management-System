<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: { type: Boolean },
    status: { type: String },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="mb-6 text-center">
            <div class="text-5xl mb-3 animate-bounce-soft">🐷</div>
            <h2 class="text-2xl font-extrabold text-ktext">Welcome Back!</h2>
            <p class="mt-1 text-sm text-gray-500">Ready to check your savings today?</p>
        </div>

        <div v-if="status" class="mb-4 rounded-2xl bg-kmint/30 px-4 py-3 text-sm font-bold text-ktext ring-1 ring-kmint/30">
            🌿 {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-5">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="email" class="mt-1.5 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                <InputError class="mt-1.5" :message="form.errors.email" />
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <InputLabel for="password" value="Password" />
                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm font-bold text-kpink hover:text-klavender transition">Forgot?</Link>
                </div>
                <TextInput id="password" type="password" class="mt-1.5 block w-full" v-model="form.password" required autocomplete="current-password" />
                <InputError class="mt-1.5" :message="form.errors.password" />
            </div>

            <div class="flex items-center">
                <Checkbox id="remember" name="remember" v-model:checked="form.remember" />
                <label for="remember" class="ml-2 text-sm font-semibold text-gray-500">Remember me</label>
            </div>

            <PrimaryButton class="w-full justify-center" :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                <svg v-if="form.processing" class="-ml-1 mr-2 h-4 w-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                </svg>
                ✨ Sign In
            </PrimaryButton>

            <p class="text-center text-sm font-semibold text-gray-500">
                Don't have an account?
                <Link :href="route('register')" class="font-extrabold text-kpink hover:text-klavender transition">Sign up 🎀</Link>
            </p>
        </form>
    </GuestLayout>
</template>
