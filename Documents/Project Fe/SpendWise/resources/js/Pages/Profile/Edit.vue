<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({ mustVerifyEmail: { type: Boolean }, status: { type: String } });
</script>

<template>
    <Head title="Profile" />
    <AuthenticatedLayout>
        <div class="mb-6">
            <h1 class="text-2xl font-extrabold text-ktext">🎀 Profile</h1>
            <p class="text-sm text-gray-500">Manage your account settings</p>
        </div>
        <div class="mx-auto max-w-3xl space-y-6">
            <div class="rounded-3xl bg-white p-8 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
                <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" class="max-w-xl" />
            </div>
            <div class="rounded-3xl bg-white p-8 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
                <UpdatePasswordForm class="max-w-xl" />
            </div>
            <div class="rounded-3xl bg-white p-8 shadow-sm shadow-kpink/10 ring-1 ring-kpink/10">
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
