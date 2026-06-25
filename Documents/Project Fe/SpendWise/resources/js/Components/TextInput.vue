<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="rounded-2xl border-2 border-kpink/20 bg-white px-5 py-3 text-sm text-ktext shadow-sm transition-all duration-200 placeholder:text-gray-300 focus:border-kpink/50 focus:ring-4 focus:ring-kpink/10 focus:outline-none hover:border-kpink/30"
        v-model="model"
        ref="input"
    />
</template>
