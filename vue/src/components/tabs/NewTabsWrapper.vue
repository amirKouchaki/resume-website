<template>
    <TabGroup>
        <TabList class="flex space-x-1 rounded-xl bg-blue-900/20 p-1 mb-6">
            <slot name="tab-list"> </slot>
        </TabList>

        <TabPanels class="mt-2">
            <slot name="tab-panels"></slot>
        </TabPanels>
    </TabGroup>
</template>

<script setup>
import { ref } from "vue";
import { TabGroup, TabList, TabPanels } from "@headlessui/vue";
</script>

<style lang="scss" scoped>
@use ".././../abstracts" as *;
.pages {
    display: flex;
    gap: 1em;
    margin-block: 1.5em;
}

.page {
    text-align: center;
    padding: clamp(0.3em, 4vw, 0.7em) clamp(0.1em, 4vw, 0.3em);
    background-color: $secondary-bg-color;
    cursor: pointer;
    border-radius: 0.2em;
    user-select: none;
}
</style>
