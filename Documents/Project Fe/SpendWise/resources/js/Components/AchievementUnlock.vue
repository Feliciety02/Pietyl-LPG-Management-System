<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    achievement: { type: Object, default: null },
    show: { type: Boolean, default: false },
});

const emit = defineEmits(['close']);
const visible = ref(false);

watch(() => props.show, (val) => {
    if (val) {
        visible.value = true;
        setTimeout(() => {
            visible.value = false;
            emit('close');
        }, 4000);
    }
});
</script>

<template>
    <Teleport to="body">
        <Transition
            enter-active-class="transition-all duration-500 ease-out"
            enter-from-class="opacity-0 scale-50"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition-all duration-300 ease-in"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-50"
        >
            <div v-if="visible && achievement" class="fixed inset-0 z-[100] flex items-center justify-center bg-kpink/10 backdrop-blur-sm">
                <div class="animate-pop mx-4 max-w-md rounded-3xl bg-white p-8 text-center shadow-2xl shadow-kpink/20 ring-1 ring-kpink/10">
                    <!-- Confetti-like sparkles -->
                    <div class="mb-4 flex justify-center gap-2 text-2xl">
                        <span class="animate-twinkle">✨</span>
                        <span class="animate-twinkle" style="animation-delay: 0.3s">🎉</span>
                        <span class="animate-twinkle" style="animation-delay: 0.6s">🌈</span>
                    </div>

                    <div class="mb-4 text-7xl animate-bounce-soft">{{ achievement.emoji }}</div>

                    <h2 class="mb-2 text-2xl font-extrabold text-ktext">Achievement Unlocked!</h2>
                    <p class="mb-1 text-xl font-bold text-kpink">🏆 {{ achievement.name }}</p>
                    <p class="mb-6 text-sm text-gray-500">{{ achievement.description }}</p>

                    <div class="mb-6 inline-flex items-center gap-2 rounded-2xl bg-kbutter/50 px-5 py-2 text-sm font-bold text-ktext">
                        ✨ +{{ achievement.xp_reward }} XP
                    </div>

                    <button
                        @click="visible = false; emit('close')"
                        class="rounded-2xl bg-gradient-to-r from-kpink to-klavender px-8 py-3 text-sm font-bold text-white shadow-lg shadow-kpink/30 transition-all hover:shadow-xl hover:scale-[1.03] active:scale-[0.97]"
                    >
                        🎀 Awesome!
                    </button>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
