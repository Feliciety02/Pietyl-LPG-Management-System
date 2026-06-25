<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="block w-full px-5 py-3 text-start text-sm font-semibold text-ktext/60 transition-all duration-200 hover:bg-kpink/10 hover:text-ktext rounded-xl"
    >
        <slot />
    </Link>
</template>
