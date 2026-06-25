<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({ password: '' });
const submit = () => { form.post(route('password.confirm'), { onFinish: () => form.reset() }); };
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />
        <div class="mb-6 text-center">
            <div class="text-5xl mb-3 animate-float">🔒</div>
            <h2 class="text-2xl font-extrabold text-ktext">Confirm your password</h2>
            <p class="mt-1 text-sm text-gray-500">This is a secure area. Please confirm your password before continuing.</p>
        </div>
        <form @submit.prevent="submit" class="space-y-5">
            <div>
                <InputLabel for="password" value="Password" />
                <TextInput id="password" type="password" class="mt-1.5 block w-full" v-model="form.password" required autocomplete="current-password" autofocus />
                <InputError class="mt-1.5" :message="form.errors.password" />
            </div>
            <PrimaryButton class="w-full justify-center" :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                <svg v-if="form.processing" class="-ml-1 mr-2 h-4 w-4 animate-spin text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" /><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" /></svg>
                ✅ Confirm
            </PrimaryButton>
        </form>
    </GuestLayout>
</template>
