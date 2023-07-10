<template>
    <TabGroup :selected-index="selectedIndex" @change="changeTab">
        <TabList class="flex space-x-1 rounded-xl bg-blue-900/20 p-1 mb-6 mt-6">
            <tab
                as="template"
                v-slot="{ selected }"
                v-for="(tab, idx) in props.tabs"
                :key="tab.title"
                :disabled="tab.disabled"
            >
                <button
                    :class="[
                        'w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700',
                        'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                        selected
                            ? 'bg-white shadow'
                            : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',
                    ]"
                >
                    {{ tab.title }}
                </button>
            </tab>
        </TabList>

        <TabPanels class="mt-2">
            <slot name="tab-panels"></slot>
        </TabPanels>
    </TabGroup>
</template>

<script setup>
import { computed, ref, toRef } from "vue";
import { TabGroup, TabList, TabPanels, Tab } from "@headlessui/vue";

const props = defineProps({ tabs: Array });

const tabTitlesArray = computed(() =>
    props.tabs.reduce((acc, tab) => acc.concat(tab.title), [])
);
const selectedIndex = ref(0);
const changeTab = (index) => {
    selectedIndex.value = index;
};

const changeTabByTitle = (title) => {
    changeTab(tabTitlesArray.value.findIndex((tabTitle) => tabTitle === title));
    // selectedIndex.value = 2;
};

const nextTab = () => {
    selectedIndex.value++;
};
const previousTab = () => {
    selectedIndex.value--;
};

defineExpose({ changeTab, nextTab, previousTab, changeTabByTitle });
</script>

<style lang="scss" scoped>
@use "../abstracts/index" as *;
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
