<template>
    <transition name="fade">
        <div class="tab" v-show="selectedTitle == title">
            <slot></slot>
        </div>
    </transition>
</template>

<script setup>
import { inject } from "vue";

const props = defineProps(["title"]);

const selectedTitle = inject("selectedTitle");
</script>

<style>
.tab {
    display: flex;
    flex-direction: column;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-active {
    transition-delay: 0.2s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
