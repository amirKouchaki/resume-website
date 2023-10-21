<template>
    <Carousel :autoplay="4000" :transition="500">
        <Slide v-for="technology in technologies" :key="technology.id">
            <div class="carousel__item">
                <!-- <a :href="technology.link" target="_blank"> -->
                <img
                    class="technology-logo"
                    :src="publicPath(technology.logo)"
                    alt=""
                />
                <!-- </a> -->
            </div>
        </Slide>

        <template #addons>
            <Pagination />
        </template>
    </Carousel>
</template>

<script setup>
import { publicPath } from "../composables/publicUrl";
// If you are using PurgeCSS, make sure to whitelist the carousel CSS classes
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";

const technologies = [
    {
        id: 1,
        logo: "svgs/css.svg",
        link: "https://developer.mozilla.org/en-US/docs/Web/CSS",
    },
    { id: 2, logo: "svgs/database.svg", link: "https://www.mysql.com/" },
    { id: 3, logo: "svgs/docker.svg", link: "https://www.docker.com/" },
    { id: 4, logo: "svgs/git.svg", link: "https://git-scm.com/" },
    {
        id: 5,
        logo: "svgs/javascript.svg",
        link: "https://www.javascript.com/",
    },
    { id: 6, logo: "svgs/laravel.svg", link: "https://laravel.com/" },
    { id: 7, logo: "svgs/linux.svg", link: "https://www.linux.org/" },
    { id: 8, logo: "svgs/vue.svg", link: "https://vuejs.org/" },
];
</script>

<style lang="scss">
@use "../abstracts" as *;

.technology-logo {
    width: 60px;
}

.carousel__item {
    min-height: 75px;
    user-select: none;
    font-size: 20px;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.carousel__slide {
    padding: 10px;
    width: 33.33% !important;
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
