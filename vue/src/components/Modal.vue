<template>
    <transition-root appear :show="show" as="template">
        <Dialog class="modal-container" @close="close">
            <Transition-child
                as="template"
                enter="modal-enter-active"
                enter-from="modal-enter-from"
                enter-to="modal-enter-to"
                leave="modal-leave-active"
                leave-from="modal-leave-from"
                leave-to="modal-leave-to"
            >
                <DialogPanel class="modal">
                    <animated-close-btn @close="close" />
                    <div class="modal-content">
                        <slot> </slot>
                    </div>
                </DialogPanel>
            </Transition-child>
        </Dialog>
    </transition-root>
</template>

<script setup>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
    DialogDescription,
} from "@headlessui/vue";
import AnimatedCloseBtn from "./AnimatedCloseBtn.vue";
const props = defineProps({
    close: Function,
    show: Boolean,
});
</script>

<style lang="scss">
@use "../abstracts" as *;
.modal-container {
    position: fixed;
    z-index: 999;
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

.modal-form-heading {
    font-family: sans-serif;
    font-weight: bold;
    font-size: 2rem;
    letter-spacing: 0.7px;
    line-height: 1.6;
}

.modal-enter-active {
    animation: borderColors 0.25s steps(30) forwards;
    transition: background-color 0.25s 0.2s ease-in-out;
}

.modal-leave-active {
    animation: borderColors 0.25s steps(30) reverse;
    transition: background-color 0.25s 0.2s ease-in-out;
}

.modal-enter-from,
.modal-leave-to {
    background-color: transparent !important;
    border-color: transparent;
}

.modal-enter-to,
.modal-leave-from {
    border-color: $main-modal-border-color;
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
.modal
