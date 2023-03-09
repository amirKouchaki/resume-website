<template>
    <button class="form-btn" type="submit">send</button>
</template>

<script setup></script>

<style lang="scss">
@use "../abstracts" as *;
.form-btn {
    position: relative;
    display: block;
    width: 100%;
    margin-top: 2em;
    padding-block: 0.95em;
    border-radius: 3em;
    border: 2px solid $main-text-color;
    background-color: transparent;
    color: $main-text-color;
    font-family: "Montserrat", arial, sans-serif;
    font-weight: bold;
    font-size: 1.1rem;
    z-index: 0;
    cursor: pointer;
    overflow: hidden;
    border: 2px solid $secondary-text-color;
    color: $secondary-text-color;

    &::before {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        content: "";
        transition: 300ms ease;
        color: $secondary-text-color;
        z-index: -1;
        background-color: $main-color;
        transform-origin: top;
        width: 110%;
        transform: translateX(-100%) skew(-30deg);
        transition: all 300ms ease-in-out;
    }
    &:hover::before,
    &:focus::before {
        transform: translateX(0);
        transition-delay: 0.4s;
    }
    &:hover,
    &:focus {
        color: $secondary-text-color;
        animation: borderColors 0.3s steps(30) forwards;
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
        border-top-color: $main-color;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
    }
    50% {
        border-top-color: $main-color;
        border-right-color: $main-color;
        border-bottom-color: transparent;
        border-left-color: transparent;
    }
    75% {
        border-top-color: $main-color;
        border-right-color: $main-color;
        border-bottom-color: $main-color;
        border-left-color: transparent;
    }
    100% {
        border-top-color: $main-color;
        border-right-color: $main-color;
        border-bottom-color: $main-color;
        border-left-color: $main-color;
    }
}
</style>
