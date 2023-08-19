<template>
    <button
        class="social-btn"
        @click="onClick"
        :style="'background-color:' + bgColor"
    >
        <img
            class="social-btn-icon"
            :src="'/svgs/' + iconSrc"
            style="width: 30px; height: 30px"
            alt=""
        />
        <span class="social-btn-text" :style="'color:' + textColor">{{
            text
        }}</span>
    </button>
</template>

<script setup>
const props = defineProps({
    onClick: Function,
    text: String,
    bgColor: String,
    textColor: String,
    iconSrc: String,
});
</script>

<style lang="scss" scoped>
.social-btn {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1em;
    padding: 0.3em 0.9em;
    width: 100%;
    border-radius: 0.3em;
}
</style>
