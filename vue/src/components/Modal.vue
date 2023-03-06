<template>
    <Teleport to="body">
        <div class="modal-container" :class="{ active: modelValue }">
            <div class="modal-background">
                <div
                    class="border-animation"
                    :class="{ active: modelValue }"
                    v-modal-click-away="closeModal"
                >
                    <div class="modal">
                        <slot></slot>
                    </div>
                </div>
            </div></div
    ></Teleport>
</template>

<script setup>
const props = defineProps(["modelValue", "title"]);
const emits = defineEmits(["update:modelValue"]);
const closeModal = () => {
    document.body.classList.remove("ov-hid");
    emits("update:modelValue", false);
};
</script>

<style lang="scss" scoped>
@use "../abstracts" as *;
.border-animation {
    --border-width: 5px;
    --animation-speed: 0.8s;
    width: min(50em, 80%);
    position: relative;
    display: inline-block;
    line-height: 1em;
    font-size: 1em;
    transform: scale(1, 0.8);
    border: var(--border-width) solid transparent;
    border-radius: 2em;
    overflow: hidden;

    .border-animation__inner {
        position: relative;
        display: inline-block;
        width: 100%;
        font-weight: 300;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        cursor: pointer;
        // background: rgba(50, 50, 50, 0.5);
        z-index: 1;
    }

    &:before,
    &:after {
        content: "";
        position: absolute;
        pointer-events: none;
    }

    &.active {
        &:before,
        &:after {
            animation: beforeBorders var(--animation-speed) forwards ease-in-out;
            animation: afterBorders var(--animation-speed) forwards ease-in-out;
        }
        animation: borderColors var(--animation-speed) steps(30) forwards;
        outline: none;

        .border-animation__inner {
            animation: background calc(var(--animation-speed) / 5 * 3) forwards
                ease-in-out;
            animation-delay: calc(var(--animation-speed) / 5 * 2);
        }
    }
}

@keyframes beforeBorders {
    0% {
        top: calc(var(--border-width) * -1);
        left: 50%;
        bottom: auto;
        right: auto;
        width: 0;
        height: var(--border-width);
    }
    33% {
        top: calc(var(--border-width) * -1);
        left: calc(var(--border-width) * -1);
        bottom: auto;
        right: auto;
        width: calc(var(--border-width) + 50%);
        height: var(--border-width);
    }
    66% {
        top: calc(var(--border-width) * -1);
        left: calc(var(--border-width) * -1);
        bottom: auto;
        right: auto;
        width: var(--border-width);
        height: calc((var(--border-width) * 2) + 100%);
    }
    100% {
        top: auto;
        left: calc(var(--border-width) * -1);
        bottom: calc(var(--border-width) * -1);
        right: auto;
        width: calc(var(--border-width) + 50%);
        height: calc((var(--border-width) * 2) + 100%);
    }
}

@keyframes afterBorders {
    0% {
        top: calc(var(--border-width) * -1);
        left: auto;
        bottom: auto;
        right: 50%;
        width: 0;
        height: var(--border-width);
    }
    33% {
        top: calc(var(--border-width) * -1);
        left: auto;
        bottom: auto;
        right: calc(var(--border-width) * -1);
        width: calc(var(--border-width) + 50%);
        height: var(--border-width);
    }
    66% {
        top: calc(var(--border-width) * -1);
        left: auto;
        bottom: auto;
        right: calc(var(--border-width) * -1);
        width: var(--border-width);
        height: calc((var(--border-width) * 2) + 100%);
    }
    100% {
        top: auto;
        left: auto;
        bottom: calc(var(--border-width) * -1);
        right: calc(var(--border-width) * -1);
        width: calc(var(--border-width) + 50%);
        height: calc((var(--border-width) * 2) + 100%);
    }
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

.modal-container {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    transform: scale(0);
    z-index: 1;

    &.active {
        transform: scale(1);
        .modal-background {
            background: rgba(0, 0, 0, 0);
            animation: fadeIn 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
            .modal {
                background-color: transparent;
                animation: modalFadeIn 0.5s 0.8s
                    cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
                h2,
                p {
                    opacity: 0;
                    position: relative;
                    animation: modalContentFadeIn 0.5s 1s
                        cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
                }
            }
        }
        &.out {
            animation: quickScaleDown 0s 0.5s linear forwards;
            .modal-background {
                animation: fadeOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1)
                    forwards;
                .modal {
                    animation: modalFadeOut 0.5s
                        cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
                    h2,
                    p {
                        animation: modalContentFadeOut 0.5s
                            cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
                    }
                    .modal-svg {
                        rect {
                            animation: sketchOut 0.5s
                                cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
                        }
                    }
                }
            }
        }
    }
    .modal-background {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0, 0, 0, 0.8);
        .modal {
            padding: 2em;
            background: gray;
            display: inline-block;
            border-radius: 3px;
            font-weight: 300;
            position: relative;
            width: 100%;
        }
    }
}

@keyframes unfoldIn {
    0% {
        transform: scaleY(0.005) scaleX(0);
    }
    50% {
        transform: scaleY(0.005) scaleX(1);
    }
    100% {
        transform: scaleY(1) scaleX(1);
    }
}

@keyframes unfoldOut {
    0% {
        transform: scaleY(1) scaleX(1);
    }
    50% {
        transform: scaleY(0.005) scaleX(1);
    }
    100% {
        transform: scaleY(0.005) scaleX(0);
    }
}

@keyframes zoomIn {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes zoomOut {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(0);
    }
}

@keyframes fadeIn {
    0% {
        background: rgba(0, 0, 0, 0);
    }
    100% {
        background: rgba(0, 0, 0, 0.7);
    }
}

@keyframes fadeOut {
    0% {
        background: rgba(0, 0, 0, 0.7);
    }
    100% {
        background: rgba(0, 0, 0, 0);
    }
}

@keyframes scaleUp {
    0% {
        transform: scale(0.8) translateY(1000px);
        opacity: 0;
    }
    100% {
        transform: scale(1) translateY(0px);
        opacity: 1;
    }
}

@keyframes scaleDown {
    0% {
        transform: scale(1) translateY(0px);
        opacity: 1;
    }
    100% {
        transform: scale(0.8) translateY(1000px);
        opacity: 0;
    }
}

@keyframes scaleBack {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(0.85);
    }
}

@keyframes scaleForward {
    0% {
        transform: scale(0.85);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes quickScaleDown {
    0% {
        transform: scale(1);
    }
    99.9% {
        transform: scale(1);
    }
    100% {
        transform: scale(0);
    }
}

@keyframes slideUpLarge {
    0% {
        transform: translateY(0%);
    }
    100% {
        transform: translateY(-100%);
    }
}

@keyframes slideDownLarge {
    0% {
        transform: translateY(-100%);
    }
    100% {
        transform: translateY(0%);
    }
}

@keyframes moveUp {
    0% {
        transform: translateY(150px);
    }
    100% {
        transform: translateY(0);
    }
}

@keyframes moveDown {
    0% {
        transform: translateY(0px);
    }
    100% {
        transform: translateY(150px);
    }
}

@keyframes blowUpContent {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    99.9% {
        transform: scale(2);
        opacity: 0;
    }
    100% {
        transform: scale(0);
    }
}

@keyframes blowUpContentTwo {
    0% {
        transform: scale(2);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes blowUpModal {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes blowUpModalTwo {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        transform: scale(0);
        opacity: 0;
    }
}

@keyframes roadRunnerIn {
    0% {
        transform: translateX(-1500px) skewX(30deg) scaleX(1.3);
    }
    70% {
        transform: translateX(30px) skewX(0deg) scaleX(0.9);
    }
    100% {
        transform: translateX(0px) skewX(0deg) scaleX(1);
    }
}

@keyframes roadRunnerOut {
    0% {
        transform: translateX(0px) skewX(0deg) scaleX(1);
    }
    30% {
        transform: translateX(-30px) skewX(-5deg) scaleX(0.9);
    }
    100% {
        transform: translateX(1500px) skewX(30deg) scaleX(1.3);
    }
}

@keyframes sketchIn {
    0% {
        stroke-dashoffset: 778;
    }
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes sketchOut {
    0% {
        stroke-dashoffset: 0;
    }
    100% {
        stroke-dashoffset: 778;
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

@keyframes modalContentFadeIn {
    0% {
        opacity: 0;
        top: -20px;
    }
    100% {
        opacity: 1;
        top: 0;
    }
}

@keyframes modalContentFadeOut {
    0% {
        opacity: 1;
        top: 0px;
    }
    100% {
        opacity: 0;
        top: -20px;
    }
}

@keyframes bondJamesBond {
    0% {
        transform: translateX(1000px);
    }
    80% {
        transform: translateX(0px);
        border-radius: 75px;
        height: 75px;
        width: 75px;
    }
    90% {
        border-radius: 3px;
        height: 182px;
        width: 247px;
    }
    100% {
        border-radius: 3px;
        height: 162px;
        width: 227px;
    }
}

@keyframes killShot {
    0% {
        transform: translateY(0) rotate(0deg);
        opacity: 1;
    }
    100% {
        transform: translateY(300px) rotate(45deg);
        opacity: 0;
    }
}

@keyframes fadeToRed {
    0% {
        background-color: rgba(black, 0.6);
    }
    100% {
        background-color: rgba(red, 0.8);
    }
}

@keyframes slowFade {
    0% {
        opacity: 1;
    }
    99.9% {
        opacity: 0;
        transform: scale(1);
    }
    100% {
        transform: scale(0);
    }
}
</style>
