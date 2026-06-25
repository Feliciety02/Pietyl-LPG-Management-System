<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({ mustVerifyEmail: { type: Boolean }, status: { type: String } });

const user = usePage().props.auth.user;
const form = useForm({ name: user.name, email: user.email });
</script>

<template>
    <section>
        <header class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-kpink/20 to-klavender/20 text-xl">🐷</div>
            <div>
                <h2 class="text-lg font-extrabold text-ktext">Profile Information</h2>
                <p class="mt-0.5 text-sm text-gray-500">Update your account's profile information and email address.</p>
            </div>
        </header>
        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-5">
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
            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm text-gray-600">Your email address is unverified. <Link :href="route('verification.send')" method="post" as="button" class="font-extrabold text-kpink hover:text-klavender underline">Click here to re-send the verification email.</Link></p>
                <div v-show="status === 'verification-link-sent'" class="mt-2 text-sm font-bold text-emerald-600">🌿 A new verification link has been sent!</div>
            </div>
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">💾 Save</PrimaryButton>
                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm font-bold text-emerald-600">✨ Saved!</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
