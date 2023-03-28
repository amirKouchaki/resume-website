<template>
    <Teleport to="body">
        <div class="modal-container">
            <div class="modal" v-modal-click-away="close" role="dialog">
                <animated-close-btn @close="close" />
                <div class="modal-content">
                    <slot></slot>
                </div>
            </div>
        </div>
    </Teleport>
</template>

<script setup>
import AnimatedCloseBtn from "./AnimatedCloseBtn.vue";
import { ref } from "vue";

const props = defineProps({ toggle: Function });
const close = () => {
    props.toggle();
};
</script>

<style lang="scss">
@use "../abstracts" as *;
.modal-container {
    position: fixed;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal {
    position: relative;
    width: min(50em, 80%);
    background-color: transparent;
    animation: borderColors 0.3s steps(30) forwards,
        modalFadeIn 0.5s 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    border: 5px solid transparent;
    outline: none;
    border-radius: 0.5em;
    padding: 0.7em 1em;
}

.modal-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    & > * {
        width: 100%;
    }
}

@media (max-width: $sm-screen) {
    .modal {
        max-width: unset;
        width: 100%;
        height: 100%;
        border-radius: 0;
        gap: 2em;
    }
}

.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}

@keyframes borderColors {
    0% {
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
    }
    25% {
        border-top-color: $main-modal-border-color;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
    }
    50% {
        border-top-color: $main-modal-border-color;
        border-right-color: $main-modal-border-color;
        border-bottom-color: transparent;
        border-left-color: transparent;
    }
    75% {
        border-top-color: $main-modal-border-color;
        border-right-color: $main-modal-border-color;
        border-bottom-color: $main-modal-border-color;
        border-left-color: transparent;
    }
    100% {
        border-top-color: $main-modal-border-color;
        border-right-color: $main-modal-border-color;
        border-bottom-color: $main-modal-border-color;
        border-left-color: $main-modal-border-color;
    }
}

@keyframes modalFadeIn {
    0% {
        background-color: transparent;
    }
    100% {
        background-color: $main-modal-bg-color;
    }
}

@keyframes modalFadeOut {
    0% {
        background-color: $main-modal-bg-color;
    }
    100% {
        background-color: transparent;
    }
}
</style>
