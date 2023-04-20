<template>
    <div class="steps" v-if="type == 'multi-step'">
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
    <div class="pages" ref="pages" v-else-if="type == 'multi-page'">
        <span
            v-for="(title, index) in slotTitles"
            :key="title"
            @click="changeSelectedTitle(index)"
            :class="{ 'active-page': tabNum == index }"
            :style="`width: ${100 / slotTitles.length}%`"
            class="page"
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
import { computed } from "@vue/reactivity";

const props = defineProps({
    navigation: Boolean,
    type: {
        type: String,
        default: "",
    },
});

const tabNum = ref(0);
const slots = useSlots();
const slotTitles = ref(slots.default().map((tab) => tab.props.title));
const selectedTitle = ref(slotTitles.value[tabNum.value]);
const pages = ref(null);
provide("selectedTitle", selectedTitle);

const slotRenderRules = computed(() => {
    return slots.default().reduce((acc, tab, index) => {
        acc.set(index, tab.props.renderRule ?? true);
        return acc;
    }, new Map());
});

const isAllowedToRender = (tabIndex) => {
    if (slotRenderRules.value.get(tabIndex)) return true;
    const selectedPage = pages.value.children[tabIndex];
    selectedPage.classList.add("error-animation");
    setTimeout(() => {
        selectedPage.classList.remove("error-animation");
    }, 820);
    return false;
};

const changeSelectedTitle = (index) => {
    if (!isAllowedToRender(index)) return;
    tabNum.value = index;
    updateTitle();
};

const next = (num = 1) => {
    if (
        tabNum.value + num < slotTitles.value.length &&
        isAllowedToRender(tabNum.value + num)
    ) {
        tabNum.value = tabNum.value + num;
        updateTitle();
    }
};

const previous = (num = 1) => {
    if (tabNum.value >= num && isAllowedToRender(tabNum.value - num)) {
        tabNum.value = tabNum.value - num;
        updateTitle();
    }
};

const updateTitle = () => {
    selectedTitle.value = slotTitles.value[tabNum.value];
};

defineExpose({
    next,
    previous,
});
</script>

<style lang="scss" scoped>
@use "../abstracts" as *;

.steps {
    display: flex;
    counter-reset: step;
    margin-bottom: 2em;
}

.step {
    display: block;
    width: 33.33%;
    text-align: center;
    position: relative;
    cursor: pointer;
    user-select: none;
    &::before {
        position: relative;
        font-size: 1.4rem;
        font-weight: bold;
        content: counter(step);
        counter-increment: step;
        display: block;
        margin-inline: auto;
        border-radius: 0.4em;
        padding: 0.2em 0.5em;
        width: 25px;
        aspect-ratio: 1;
        text-align: center;
        background-color: $secondary-bg-color;
        z-index: 2;
    }

    &:not(:first-child)::after {
        content: "";
        position: absolute;
        min-width: 100%;
        min-height: 4px;
        left: -60%;
        top: 28%;
        background-color: $secondary-bg-color;
        z-index: 1;
    }
}

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

.active {
    &::before {
        background-color: $main-color !important;
    }

    &::after {
        background-color: $main-color !important;
    }
}

.active-page {
    background-color: $main-color !important;
}

.error-animation {
    animation: shake 0.82s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
    transform: translateX(0);
}

@keyframes shake {
    10%,
    90% {
        transform: translateX(-1px);
    }

    20%,
    80% {
        transform: translateX(2px);
    }

    30%,
    50%,
    70% {
        transform: translateX(-4px);
    }

    40%,
    60% {
        transform: translateX(4px);
    }
}
</style>
