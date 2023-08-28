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
    gap: 1.3em;
    text-align: center;
    padding: 1.5em 1em;
    background-color: $secondary-bg-color;
    border: 2px solid $fact-border-color;
    border-radius: 0.5em;
    transition: transform 0.3s ease-in-out;

    &:hover {
        transform: translateY(-12px);
    }
}
.fact-logo {
    background-color: $main-color;

    width: 35px;
    height: 35px;
    cursor: pointer;
    margin-inline: auto;
}

.fact-data {
    font-size: 3.6rem;
}

.fact-heading {
    font-size: 1.4rem;
    font-weight: bold;
}
</style>
