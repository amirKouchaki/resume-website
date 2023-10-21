<script setup>
import { loadFull } from "tsparticles";
import { onMounted, ref } from "vue";
import axiosClient from "../axios";
import { gsap } from "gsap";

const cardIsFlipped = ref(false);

const particlesInit = async (engine) => {
    await loadFull(engine);
};

onMounted(() => {
    try {
        tl.value = gsap
            .timeline({ paused: true })
            .to(".front", { duration: 1, rotationY: -180 }, 0)
            .to(".back", { duration: 1, rotationY: 0 }, 0)
            .to(".flipper", { z: 50 }, 0);
        axiosClient.get("sanctum/csrf-cookie");
    } catch (error) {
        console.log(error);
    }
});
const tl = ref();

const flip = () => {
    cardIsFlipped.value = !cardIsFlipped.value;
    if (cardIsFlipped.value) tl.value.play();
    else tl.value.reverse();
};
</script>

<template>
    <div class="area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    <router-view />
    <!-- <div class="container flipper">
        <div class="front">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem
            quam nemo, cum iusto quae nesciunt iure provident quo suscipit est
            reiciendis nostrum, similique voluptatibus corrupti quas alias vitae
            sed in recusandae aliquam velit molestias autem rem. Facilis harum
            sequi in! Saepe laborum soluta obcaecati inventore odio possimus,
            iste repellendus porro nulla aut itaque dicta qui, esse dolorem quos
            aperiam eos architecto deserunt fuga nobis deleniti sequi? Ad
            laborum a omnis ipsum cum suscipit pariatur sed vel, ut officia
            consectetur aut quae quaerat, est deleniti excepturi quos? Inventore
            odit numquam praesentium vel labore ipsa, aspernatur amet omnis
            officia explicabo dolorem hic?
        </div>
        <div class="back">hello</div>
    </div>
    <button @click="flip" class="button">click me</button> -->
</template>

<style lang="scss" scoped>
@use "./abstracts/" as *;
/* entire container, keeps perspective */
/* hide back of pane during swap */

/* front pane, placed above back */

.button {
    background-color: #4e54c8;
}

.flipper {
    display: grid;
    grid-template-rows: 1fr;
    padding: 2em;
}

.area {
    position: fixed;
    inset: 0;
    background: #4e54c8;
    background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8);
    z-index: -10;
}

.circles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.circles li {
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.2);
    animation: animate 25s linear infinite;
    bottom: -150px;
}

.circles li:nth-child(1) {
    left: 25%;
    width: 80px;
    height: 80px;
    animation-delay: 0s;
}

.circles li:nth-child(2) {
    left: 10%;
    width: 20px;
    height: 20px;
    animation-delay: 2s;
    animation-duration: 12s;
}

.circles li:nth-child(3) {
    left: 70%;
    width: 20px;
    height: 20px;
    animation-delay: 4s;
}

.circles li:nth-child(4) {
    left: 40%;
    width: 60px;
    height: 60px;
    animation-delay: 0s;
    animation-duration: 18s;
}

.circles li:nth-child(5) {
    left: 65%;
    width: 20px;
    height: 20px;
    animation-delay: 0s;
}

.circles li:nth-child(6) {
    left: 75%;
    width: 110px;
    height: 110px;
    animation-delay: 3s;
}

.circles li:nth-child(7) {
    left: 35%;
    width: 150px;
    height: 150px;
    animation-delay: 7s;
}

.circles li:nth-child(8) {
    left: 50%;
    width: 25px;
    height: 25px;
    animation-delay: 15s;
    animation-duration: 45s;
}

.circles li:nth-child(9) {
    left: 20%;
    width: 15px;
    height: 15px;
    animation-delay: 2s;
    animation-duration: 35s;
}

.circles li:nth-child(10) {
    left: 85%;
    width: 150px;
    height: 150px;
    animation-delay: 0s;
    animation-duration: 11s;
}

@keyframes animate {
    0% {
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }

    100% {
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
    }
}
</style>

<script></script>
