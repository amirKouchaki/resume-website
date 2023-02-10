<template>
    <Carousel
        :autoplay="4000"
        :settings="{ itemsToShow: 3 }"
        :wrap-around="true"
        :transition="500"
    >
        <Slide v-for="technology in technologies" :key="technology.id">
            <div class="carousel__item">
                <img class="technology-logo" :src="technology.logo" alt="" />
            </div>
        </Slide>

        <template #addons>
            <Pagination />
        </template>
    </Carousel>
</template>

<script setup>
// If you are using PurgeCSS, make sure to whitelist the carousel CSS classes
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";

const technologies = [
    {
        id: 1,
        logo: "/css.svg",
    },
    { id: 2, logo: "/database.svg" },
    { id: 3, logo: "/docker.svg" },
    { id: 4, logo: "/git.svg" },
    { id: 5, logo: "/javascript.svg" },
    { id: 6, logo: "/laravel.svg" },
    { id: 7, logo: "/linux.svg" },
    { id: 8, logo: "/vue.svg" },
];
</script>

<style lang="scss">
@use "../abstracts" as *;

.technology-logo {
    width: 50px;
}

.carousel__item {
    min-height: 75px;
    width: 100%;
    user-select: none;
    font-size: 20px;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.carousel__slide {
    padding: 10px;
}

.carousel__prev,
.carousel__next {
    box-sizing: content-box;
    border: 5px solid white;
}

.carousel__pagination-button:hover::after,
.carousel__pagination-button--active::after {
    background-color: $main-color;
}
</style>
