<template>
    <div class="steps">
        <span
            v-for="step in steps"
            :key="step.id"
            :style="`width: ${100 / steps.length}%`"
            :class="{ active: step.isActive }"
            class="step"
            >{{ step.name }}</span
        >
        <button @click="next()">next</button>
        <button @click="previous()">prev</button>
    </div>
</template>

<script setup>
import { ref } from "vue";

const page = ref(0);

const next = () => {
    if (page.value < steps.value.length - 1) page.value++;
    updateActivatedSteps(true);
};

const previous = () => {
    updateActivatedSteps(false);
    if (page.value >= 1) page.value--;
};

const updateActivatedSteps = (updatedValue) => {
    if (page.value != 0) steps.value[page.value].isActive = updatedValue;
};

let steps = ref([
    {
        id: 1,
        name: "track",
        isActive: true,
    },
    {
        id: 2,
        name: "visit",
        isActive: false,
    },
    {
        id: 3,
        name: "add",
        isActive: false,
    },
    {
        id: 4,
        name: "goodbye",
        isActive: false,
    },
]);
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
        background-color: blue;
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
