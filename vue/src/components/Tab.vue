<template>
    <div class="tab" v-show="selectedTitle == title">
        <slot></slot>
    </div>
</template>

<script setup>
import { inject } from "vue";

const props = defineProps(["title"]);

const selectedTitle = inject("selectedTitle");
</script>

<style></style>
