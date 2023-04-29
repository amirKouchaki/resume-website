<template>
    <button id="close" @click="$emit('close')">close</button>
</template>

<script setup>
const emits = defineEmits(["close"]);
</script>

<style lang="scss" scoped>
@use "../abstracts" as *;
#close {
    overflow: hidden;
    position: relative;
    border: none;
    padding: 0;
    width: 2.2em;
    height: 2.2em;
    border-radius: 50%;
    background: transparent;
    color: $main-color;
    font: inherit;
    text-indent: 100%;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    margin-left: auto;

    &:hover,
    &:focus {
        outline: solid 0 transparent;
        box-shadow: 0 0 0 2px rgba($main-color, 0.5);
        background-color: rgba($main-color, 0.08);
    }

    &:before,
    &:after {
        position: absolute;
        top: 15%;
        left: calc(50% - 0.0625em);
        width: 0.125em;
        height: 70%;
        border-radius: 0.125em;
        transform: rotate(45deg);
        background: currentcolor;
        content: "";
    }

    &:after {
        transform: rotate(-45deg);
    }
}
</style>
