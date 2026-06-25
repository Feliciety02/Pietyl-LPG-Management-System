<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);
const form = useForm({ password: '' });

const confirmUserDeletion = () => { confirmingUserDeletion.value = true; nextTick(() => passwordInput.value.focus()); };
const deleteUser = () => { form.delete(route('profile.destroy'), { preserveScroll: true, onSuccess: () => closeModal(), onError: () => passwordInput.value.focus(), onFinish: () => form.reset() }); };
const closeModal = () => { confirmingUserDeletion.value = false; form.clearErrors(); form.reset(); };
</script>

<template>
    <section class="space-y-6">
        <header class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-coral/20 to-kpeach/30 text-xl">⚠️</div>
            <div>
                <h2 class="text-lg font-extrabold text-ktext">Delete Account</h2>
                <p class="mt-0.5 text-sm text-gray-500">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
            </div>
        </header>
        <DangerButton @click="confirmUserDeletion">🗑️ Delete Account</DangerButton>
        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-extrabold text-ktext">Are you sure you want to delete your account?</h2>
                <p class="mt-2 text-sm text-gray-500">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.</p>
                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />
                    <TextInput id="password" ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-3/4" placeholder="Password" @keyup.enter="deleteUser" />
                    <InputError :message="form.errors.password" class="mt-2" />
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                    <DangerButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="deleteUser">🗑️ Delete Account</DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
