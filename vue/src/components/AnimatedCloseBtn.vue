<template>
    <div class="close-container" @click="$emit('close')">
        <div class="leftright"></div>
        <div class="rightleft"></div>
    </div>
</template>

<script setup>
const emits = defineEmits(["close"]);
</script>

<style lang="scss" scoped>
@use "../abstracts" as *;
// COLORS

.close-container {
    position: relative;
    margin-left: auto;
    margin-block: 0.3em 0.7em;
    margin-right: 0.3em;
    width: 25px;
    height: 25px;
    cursor: pointer;
}

.leftright {
    height: 4px;
    width: 25px;
    position: absolute;
    margin-top: 12px;
    background-color: $secondary-text-color;
    border-radius: 2px;
    transform: rotate(45deg);
    transition: all 0.3s ease-in;
}

.rightleft {
    height: 4px;
    width: 25px;
    position: absolute;
    margin-top: 12px;
    background-color: $secondary-text-color;
    border-radius: 2px;
    transform: rotate(-45deg);
    transition: all 0.3s ease-in;
}

label {
    color: white;
    font-family: Helvetica, Arial, sans-serif;
    font-size: 0.6em;
    text-transform: uppercase;
    letter-spacing: 2px;
    transition: all 0.3s ease-in;
    opacity: 0;
}
.close {
    position: absolute;
}

.close-container:hover .leftright {
    transform: rotate(-45deg);
    background-color: $main-color;
}
.close-container:hover .rightleft {
    transform: rotate(45deg);
    background-color: $main-color;
}
.close-container:hover label {
    opacity: 1;
}
</style>
