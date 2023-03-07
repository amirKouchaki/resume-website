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
        <div class="pages" ref="pages">
            <div class="page page-is-active">hello</div>
            <div class="page">from</div>
            <div class="page">other</div>
            <div class="page">side</div>
        </div>
        <button @click="next()">next</button>
        <button @click="previous()">prev</button>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";

const pageNum = ref(0);
const pages = ref(null);
const next = () => {
    if (pageNum.value < steps.value.length - 1) {
        pageNum.value++;

        updateActivatedSteps(true);
    }
};

const previous = () => {
    if (pageNum.value >= 1) {
        updateActivatedSteps(false);
        pageNum.value--;
    }
};

const updateActivatedSteps = (updatedValue) => {
    if (pageNum.value != 0) {
        steps.value[pageNum.value].isActive = updatedValue;
        pages.value.childNodes[pageNum.value - 1].classList.toggle(
            "page-is-active"
        );
        pages.value.childNodes[pageNum.value].classList.toggle(
            "page-is-active"
        );
    }
};

const stepsArr = ["track", "visit", "add", "goodluck"];
const steps = ref([]);

const convertStepsArr = () => {
    steps.value = stepsArr.map((value, index) => {
        console.log("hello");
        return {
            id: index + 1,
            name: value,
            isActive: index == 0 ? true : false,
        };
    });
};
convertStepsArr();
console.log(steps.value);

// const steps = ref([
//     {
//         id: 1,
//         name: "track",
//         isActive: true,
//     },
//     {
//         id: 2,
//         name: "visit",
//         isActive: false,
//     },
//     {
//         id: 3,
//         name: "add",
//         isActive: false,
//     },
//     {
//         id: 4,
//         name: "goodbye",
//         isActive: false,
//     },
// ]);
</script>

<style lang="scss" scoped>
@use "../abstracts" as *;

.page {
    display: none;
}

.page-is-active {
    display: block;
}
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
