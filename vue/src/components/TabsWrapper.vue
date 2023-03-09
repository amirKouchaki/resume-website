<template>
    <div class="steps">
        <span
            v-for="(title, index) in slotTitles"
            :key="title"
            @click="changeSelectedTitle(index)"
            :style="`width: ${100 / slotTitles.length}%`"
            :class="{ active: tabNum >= index }"
            class="step"
            >{{ title }}</span
        >
    </div>
    <div v-if="navigation">
        <button @click="next()">next</button>
        <button @click="previous()">prev</button>
    </div>
    <div class="tabs">
        <slot></slot>
    </div>
</template>

<script setup>
import { provide, ref, useSlots } from "vue";
const props = defineProps({
    navigation: Boolean,
});
const tabNum = ref(0);
const slots = useSlots();
const slotTitles = ref(slots.default().map((tab) => tab.props.title));
const selectedTitle = ref(slotTitles.value[tabNum.value]);
provide("selectedTitle", selectedTitle);
const changeSelectedTitle = (index) => {
    tabNum.value = index;
    updateTitle();
};

const next = () => {
    if (tabNum.value < slotTitles.value.length - 1) {
        tabNum.value++;
        updateTitle();
    }
};

const previous = () => {
    if (tabNum.value >= 1) {
        tabNum.value--;
        updateTitle();
    }
};

const updateTitle = () => {
    selectedTitle.value = slotTitles.value[tabNum.value];
};
</script>

<style lang="scss" scoped>
@use "../abstracts" as *;
.steps {
    display: flex;
    margin: 2em;
    counter-reset: step;
}

.step {
    display: block;
    width: 33.33%;
    text-align: center;
    position: relative;
    &::before {
        position: relative;
        font-size: 1.4rem;
        font-weight: bold;
        content: counter(step);
        counter-increment: step;
        display: block;
        margin-inline: auto;
        border-radius: 50%;
        padding: 0.3em;
        width: 15px;
        aspect-ratio: 1;
        text-align: center;
        background-color: $secondary-bg-color;
        z-index: 2;
    }

    &:not(:first-child)::after {
        content: "";
        position: absolute;
        min-width: 100%;
        min-height: 3px;
        left: -50%;
        top: 28%;
        background-color: $secondary-bg-color;
        z-index: 1;
    }
}

.active {
    &::before {
        background-color: $main-color !important;
    }

    &::after {
        background-color: $main-color !important;
    }
}
</style>
