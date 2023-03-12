<template>
    <div class="fact-card">
        <div
            class="fact-logo"
            :style="`-webkit-mask: url(${publicPath(
                funFact.logo
            )}) no-repeat center;
    mask: url(${publicPath(funFact.logo)}) no-repeat center;`"
        ></div>
        <h3 class="fact-heading">{{ funFact.title }}</h3>
        <p class="fact-data">
            {{
                new Intl.NumberFormat("en-IN", {
                    maximumSignificantDigits: 3,
                }).format(funFact.data)
            }}
        </p>
    </div>
</template>

<script setup>
import { publicPath } from "../../composables/publicUrl";
const props = defineProps({
    funFact: Object,
});
</script>

<style lang="scss" scoped>
@use "../../abstracts" as *;

.fact-card {
    display: flex;
    flex-direction: column;
    gap: 1em;
    text-align: center;
    padding: 1.5em 1em;
    background-color: $secondary-bg-color;
    border: 2px solid $fact-border-color;
    border-radius: 0.5em;

    &:hover {
        animation: moveUp linear 0.3s forwards;
    }
}
.fact-logo {
    background-color: $main-color;

    width: 25px;
    height: 25px;
    cursor: pointer;
    margin-inline: auto;
}

.fact-data {
    font-size: 2.5rem;
}

@keyframes moveUp {
    0% {
        transform: translateY(0px);
    }
    100% {
        transform: translateY(-15px);
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
</style>
