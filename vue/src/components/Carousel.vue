<template>
    <div>
        <swiper-container
            slides-per-view="4"
            speed="500"
            loop="true"
            Pagination="true"
            :breakpoints="{
                440: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },

                1200: {
                    slidesPerView: 4,
                },
            }"
        >
            <swiper-slide
                v-for="technology in technologies"
                :key="technology.id"
            >
                <div class="carousel__item">
                    <img
                        class="technology-logo"
                        :src="publicPath(technology.logo)"
                        alt=""
                    /></div
            ></swiper-slide>
        </swiper-container>
    </div>
</template>

<script setup>
import { publicPath } from "../composables/publicUrl";

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

swiper-container::part(pagination) {
    position: static !important;
    margin-top: 0.5em;
}
</style>
