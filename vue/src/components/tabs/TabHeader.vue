<template>
    <tab as="template" v-slot="{ selected }">
        <button
            :class="[
                'w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700',
                'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                selected
                    ? 'bg-white shadow'
                    : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',
            ]"
        >
            <slot></slot>
        </button>
    </tab>
</template>
<script setup>
import { Tab } from "@headlessui/vue";
</script>
<style lang="scss" scoped></style>
