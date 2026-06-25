<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center justify-center rounded-2xl border-2 border-klavender/30 bg-white px-6 py-3 text-sm font-bold text-ktext shadow-sm transition-all duration-300 hover:bg-klavender/10 hover:shadow-md hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-klavender/30 focus:ring-offset-2 disabled:opacity-25"
    >
        <slot />
    </button>
</template>
