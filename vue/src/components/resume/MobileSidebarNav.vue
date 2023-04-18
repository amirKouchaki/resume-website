<template>
    <nav class="sidebar-nav">
        <main-nav-links />
    </nav>
</template>

<script setup>
import mainNavLinks from "./MainNavLinks.vue";
</script>

<style lang="scss" scoped>
@use "../../abstracts" as *;
.sidebar-nav {
    position: absolute;
    display: flex;
    flex-direction: column;
    gap: 1.5em;
    right: 0;
    top: 0;
    width: 20em;
    background-color: $main-bg-color;
    border-radius: 0.5em;
    padding: 1em 1.5em;
    border: 2px solid $main-modal-border-color;
    transform: translateX(-10%);
}
</style>
