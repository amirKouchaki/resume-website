<template>
    <Teleport to="body">
        <Transition name="modal" :duration="450">
            <slot></slot>
        </Transition>
    </Teleport>
</template>

<script setup></script>

<style lang="scss">
@use "../../abstracts" as *;

.modal-enter-active .modal {
    animation: borderColors 0.25s steps(30) forwards;
    transition: background-color 0.25s 0.2s ease-in-out;
}

.modal-leave-active .modal {
    animation: borderColors 0.25s steps(30) reverse;
}

.modal-enter-from .modal,
.modal-leave-to .modal {
    background-color: transparent !important;
    border-color: transparent;
}

.modal-enter-to .modal,
.modal-leave-from .modal {
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
</style>
