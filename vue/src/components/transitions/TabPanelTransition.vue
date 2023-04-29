<template>
    <transition name="tab">
        <tab-panel>
            <slot></slot>
        </tab-panel>
    </transition>
</template>
<script setup>
import { TabPanel } from "@headlessui/vue";
</script>
<style lang="scss" setup>
.tab-enter-from,
.tab-leave-to {
    opacity: 0;
}

.tab-enter-active,
.tab-leave-active {
    transition: opacity 350ms ease-in-out;
}

.tab-enter-to,
.tab-leave-from {
    opacity: 1;
}
</style>
