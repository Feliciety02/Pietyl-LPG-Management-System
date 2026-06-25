<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-4 py-2 rounded-2xl bg-gradient-to-r from-kpink/20 to-klavender/20 text-sm font-bold text-kpink-700 shadow-sm transition-all duration-300'
        : 'inline-flex items-center px-4 py-2 rounded-2xl text-sm font-semibold text-ktext/60 hover:text-ktext/80 hover:bg-kpink/10 transition-all duration-300',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
