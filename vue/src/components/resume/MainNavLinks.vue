<template>
    <router-link :to="{ name: 'resume' }">About me</router-link>
    <router-link :to="{ name: 'resume' }">Resume</router-link>
    <router-link
        :to="{ name: 'resume' }"
        @click.prevent="modals.toggleTrackMessageModal"
        >Track message</router-link
    >
    <router-link :to="{ name: 'resume' }">Blog</router-link>
    <router-link
        :to="{ name: 'resume' }"
        @click.prevent="modals.toggleMessageModal"
        >Contact</router-link
    >
    <router-link
        :to="{ name: 'resume' }"
        @click.prevent="modals.toggleAuthModal"
        >Login / Sign Up</router-link
    >
</template>

<script setup>
import useModals from "../../stores/modals";
const modals = useModals();
</script>

<style lang="scss" scoped></style>
