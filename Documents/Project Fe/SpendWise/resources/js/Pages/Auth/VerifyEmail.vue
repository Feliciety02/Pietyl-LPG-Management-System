<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ status: { type: String } });
const form = useForm({});
const submit = () => { form.post(route('verification.send')); };
const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />
        <div class="mb-6 text-center">
            <div class="text-5xl mb-3 animate-float">📧</div>
            <h2 class="text-2xl font-extrabold text-ktext">Verify your email</h2>
            <p class="mt-1 text-sm text-gray-500">Check your inbox and confirm your address! 🐷</p>
        </div>
        <div class="mb-4 rounded-2xl bg-kblue/20 px-5 py-4 text-sm font-semibold text-ktext ring-1 ring-kblue/20">
            ☺️ Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
        </div>
        <div v-if="verificationLinkSent" class="mb-4 rounded-2xl bg-kmint/30 px-4 py-3 text-sm font-bold text-ktext ring-1 ring-kmint/30">🌿 A new verification link has been sent!</div>
        <form @submit.prevent="submit" class="space-y-4">
            <PrimaryButton class="w-full justify-center" :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                <svg v-if="form.processing" class="-ml-1 mr-2 h-4 w-4 animate-spin text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" /><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" /></svg>
                🔄 Resend Verification Email
            </PrimaryButton>
            <Link :href="route('logout')" method="post" as="button" class="w-full text-center text-sm font-bold text-gray-500 hover:text-ktext transition">🚪 Log Out</Link>
        </form>
    </GuestLayout>
</template>
