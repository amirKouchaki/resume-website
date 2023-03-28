<template>
    <section class="generic-section">
        <h2 class="generic-heading">{{ title }}</h2>
        <slot> </slot>
    </section>
</template>

<script setup>
const props = defineProps({
    title: String,
});
</script>

<style lang="scss" scoped>
@use "../../abstracts" as *;

.generic-section {
    margin-bottom: 5em;
}
.generic-heading {
    position: relative;
    font-size: 1.2rem;
    letter-spacing: 0.6px;
    width: fit-content;
    margin-bottom: 1.6em;

    &::before {
        content: "";
        position: absolute;
        display: block;
        height: 2px;
        width: 10px;
        background-color: $heading-underline-bg-color;
        line-height: 1.6;
        bottom: 0;
        width: 100%;
        transform: translateY(3px);
    }

    &::after {
        content: "";
        position: absolute;
        display: block;
        height: 2px;
        width: 20px;
        background-color: $main-color;
        line-height: 1.6;
        bottom: 0;
        transform: translateY(3px);
    }
}
</style>
