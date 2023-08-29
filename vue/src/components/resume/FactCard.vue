<template>
    <div
        class="fact-card"
        @mouseenter.self.prevent="animateOnHover"
        @mouseleave.self.prevent="animateOnHoverOver"
    >
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
import { onMounted } from "vue";
import { publicPath } from "../../composables/publicUrl";
import { gsap } from "gsap";
const animateOnHover = (event) => {
    gsap.to(event.target, { duration: 0.5, y: "-20px", ease: "ease" });
};

const animateOnHoverOver = (event) => {
    gsap.to(event.target, { duration: 1, y: "0px", ease: "bounce" });
};

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
