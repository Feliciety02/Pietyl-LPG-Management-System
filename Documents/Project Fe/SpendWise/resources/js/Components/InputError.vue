<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message" class="animate-pop">
        <p class="text-sm font-semibold text-coral">🥺 {{ message }}</p>
    </div>
</template>
