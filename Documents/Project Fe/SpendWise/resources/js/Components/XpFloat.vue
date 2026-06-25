<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    amount: { type: Number, default: 0 },
    x: { type: Number, default: 0 },
    y: { type: Number, default: 0 },
});

const opacity = ref(1);
const offsetY = ref(0);

const emit = defineEmits(['done']);

onMounted(() => {
    const interval = setInterval(() => {
        offsetY.value -= 1;
        opacity.value -= 0.02;
        if (opacity.value <= 0) {
            clearInterval(interval);
            emit('done');
        }
    }, 16);
});
</script>

<template>
    <div
        class="pointer-events-none fixed z-50 font-extrabold text-kpink drop-shadow-lg transition-all"
        :style="{
            left: x + 'px',
            top: y + 'px',
            opacity,
            transform: `translateY(${offsetY}px)`,
        }"
    >
        +{{ amount }} XP ✨
    </div>
</template>
