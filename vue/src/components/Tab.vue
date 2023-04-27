<template>
    <transition name="tab">
        <div class="tab" v-show="selectedTitle == title">
            <slot></slot>
        </div>
    </transition>
</template>

<script setup>
import { inject } from "vue";
const selectedTitle = inject("selectedTitle");

const props = defineProps({
    title: String,
    renderRule: {
        type: Boolean,
        default: true,
    },
});
</script>

<style lang="scss" scoped>
.tab {
    display: flex;
    flex-direction: column;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease-in-out;
}

.fade-enter-active {
    transition: scale 0.2s ease-in-out;
    transition-delay: 0.2s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    scale: 0;
}

.tab-enter-from,
.tab-leave-to {
    scale: 0;
    opacity: 0;
}

.tab-enter-active {
    transition: scale 350ms ease-in-out, opacity 350ms ease-in-out;
}

.tab-enter-to,
.tab-leave-from {
    scale: 1;
    opacity: 1;
}
</style>
