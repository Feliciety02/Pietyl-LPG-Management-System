<script setup>
import { computed } from 'vue';

const props = defineProps({
    mood: {
        type: String,
        default: 'happy',
    },
    size: {
        type: String,
        default: 'md',
    },
});

const sizeClasses = {
    sm: 'text-2xl',
    md: 'text-4xl',
    lg: 'text-6xl',
    xl: 'text-8xl',
};

const moods = {
    happy: { emoji: '🐷', animation: 'animate-bounce-soft' },
    celebrate: { emoji: '🎉', animation: 'animate-wiggle' },
    sleepy: { emoji: '😴', animation: 'animate-float' },
    excited: { emoji: '🥳', animation: 'animate-wiggle' },
    wave: { emoji: '👋', animation: 'animate-bounce-soft' },
    love: { emoji: '🥰', animation: 'animate-float' },
};

const current = computed(() => moods[props.mood] || moods.happy);
</script>

<template>
    <span :class="[sizeClasses[size] || sizeClasses.md, current.animation]" class="inline-block drop-shadow-sm">
        {{ current.emoji }}
    </span>
</template>
