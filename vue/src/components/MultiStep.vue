<template>
    <div class="steps">
        <span class="step started">track</span>
        <span class="step">visit</span>
        <span class="step">add</span>
        <button @click="next()">next</button>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";

const page = ref(0);
const next = () => {
    page.value++;
};
const steps = document.getElementsByClassName("step");
console.log(steps);
watch(page.value, (newVal) => {
    steps[newVal].classList.toggle("started");
});
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

.started {
    &::before {
        background-color: $main-color !important;
    }

    &::after {
        background-color: $main-color !important;
    }
}
</style>
