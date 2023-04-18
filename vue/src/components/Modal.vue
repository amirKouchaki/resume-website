<template>
    <div class="modal-container">
        <div class="modal" v-modal-click-away="close" role="dialog">
            <animated-close-btn @close="close" />
            <div class="modal-content">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
import AnimatedCloseBtn from "./AnimatedCloseBtn.vue";

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
    background-color: $main-modal-bg-color;
    border: 3px solid $main-modal-border-color;
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
</style>
