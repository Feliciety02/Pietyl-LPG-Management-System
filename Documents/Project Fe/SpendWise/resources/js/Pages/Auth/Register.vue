<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="mb-6 text-center">
            <div class="text-5xl mb-3 animate-bounce-soft">🐷</div>
            <h2 class="text-2xl font-extrabold text-ktext">Create an account</h2>
            <p class="mt-1 text-sm text-gray-500">Start your savings journey today! 🌸</p>
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput id="name" type="text" class="mt-1.5 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                <InputError class="mt-1.5" :message="form.errors.name" />
            </div>
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="email" class="mt-1.5 block w-full" v-model="form.email" required autocomplete="username" />
                <InputError class="mt-1.5" :message="form.errors.email" />
            </div>
            <div>
                <InputLabel for="password" value="Password" />
                <TextInput id="password" type="password" class="mt-1.5 block w-full" v-model="form.password" required autocomplete="new-password" />
                <InputError class="mt-1.5" :message="form.errors.password" />
            </div>
            <div>
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput id="password_confirmation" type="password" class="mt-1.5 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                <InputError class="mt-1.5" :message="form.errors.password_confirmation" />
            </div>

            <PrimaryButton class="w-full justify-center mt-2" :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                <svg v-if="form.processing" class="-ml-1 mr-2 h-4 w-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                </svg>
                🌸 Create Account
            </PrimaryButton>

            <p class="text-center text-sm font-semibold text-gray-500">
                Already have an account?
                <Link :href="route('login')" class="font-extrabold text-kpink hover:text-klavender transition">Sign in 🎀</Link>
            </p>
        </form>
    </GuestLayout>
</template>
