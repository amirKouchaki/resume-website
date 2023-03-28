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
    width: 0;
    top: 0;
    bottom: 0;
    background-color: $main-bg-color;
    transition: width 250ms ease-in-out;
    overflow: hidden;
}

.visible {
    width: 20em;
    padding: 0.5em 1em;
}
</style>
