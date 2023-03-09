<template>
    <div class="tabs">
        <ul>
            <li
                v-for="title in slotTitles"
                :key="title"
                @click="changeSelectedTitle(e, title)"
            >
                {{ title }}
            </li>
        </ul>
        <slot></slot>
    </div>
</template>

<script setup>
import { provide, ref, useSlots } from "vue";

const slots = useSlots();
const slotTitles = ref(slots.default().map((tab) => tab.props.title));
const selectedTitle = ref(slotTitles[0]);
provide("selectedTitle", selectedTitle);
const changeSelectedTitle = (e, title) => {
    selectedTitle.value = title;
};
</script>

<style lang="scss" scoped></style>
