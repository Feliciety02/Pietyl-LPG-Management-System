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
        ? 'block w-full ps-4 pe-4 py-3 rounded-2xl text-start text-base font-bold text-ktext bg-gradient-to-r from-kpink/20 to-klavender/20 shadow-sm transition-all duration-300'
        : 'block w-full ps-4 pe-4 py-3 rounded-2xl text-start text-base font-semibold text-ktext/60 hover:text-ktext/80 hover:bg-kpink/10 transition-all duration-300',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
