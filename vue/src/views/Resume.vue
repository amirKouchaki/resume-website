<template>
    <article class="container resume">
        <header class="resume-header">
            <div class="header-profile-info">
                <img
                    class="alphabet-profile"
                    src="../assets/images/resume-alphabet-profile.png"
                    alt=""
                />
                <h1 class="header-name">
                    <span class="first-name">Amir</span>
                    <span class="last-name"> Kouchaki</span>
                </h1>
            </div>
            <nav class="main-nav desktop">
                <main-nav-links />
            </nav>
            <aside class="mobile sidebar">
                <div
                    class="sidebar-logo"
                    @click="showSideBar = !showSideBar"
                ></div>
            </aside>
        </header>
        <section class="main-section">
            <mobile-sidebar-nav :class="{ visible: showSideBar }" />
            <section class="hero-section">
                <img
                    src="../assets/images/profile.jpg"
                    alt=""
                    class="hero-img"
                />
                <div class="hero-info">
                    <p class="short-intro">Web Designer</p>
                    <h2 class="hero-name">Amir Kouchaki</h2>
                    <p class="hero-description">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quam illum excepturi assumenda magnam, error, eligendi
                        suscipit placeat vitae, tempora perferendis atque? Ipsa
                        odit veritatis repellat eveniet fuga quae.
                    </p>
                    <div class="hero-btns">
                        <button class="hero-cv-btn hero-btn">Download CV</button
                        ><button class="hero-btn hero-contact-btn">
                            Contact
                        </button>
                    </div>
                </div>
            </section>
            <generic-section title="What I Do">
                <div class="job-descriptions">
                    <section
                        class="job-description-section"
                        v-for="n in 4"
                        :key="n"
                    >
                        <div class="job-description-logo"></div>
                        <div class="job-description-info">
                            <h3 class="job-description-header">Copywrite</h3>
                            <p class="job-description">
                                Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. Incidunt id doloribus sint,
                                cum recusandae quas. Eligendi laborum assumenda
                                numquam perferendis.
                            </p>
                        </div>
                    </section>
                </div>
            </generic-section>
        </section>
    </article>
</template>

<script setup>
import MobileSidebarNav from "../components/resume/MobileSidebarNav.vue";
import mainNavLinks from "../components/resume/MainNavLinks.vue";
import GenericSection from "../components/resume/GenericSection.vue";
import { ref } from "@vue/reactivity";

const showSideBar = ref(false);
</script>

<style lang="scss" scoped>
@use "../abstracts" as *;

.main-section {
    position: relative;
}
.resume-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.header-profile-info {
    display: flex;
    align-items: center;
    gap: 0.5em;
}

.header-name {
    font-weight: bold;
    font-size: 1.1em;
    .last-name {
        font-weight: normal;
    }
}

.alphabet-profile {
    width: 44px;
    border-radius: 9999px;
    scale: 0.9;
}

.main-nav {
    display: flex;
    gap: 2.7em;
}

.hero-section {
    display: flex;
    gap: 3em;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding-block: 5em;

    .hero-info {
        max-width: 53ch;
    }
}

.hero-img {
    max-width: 200px;
    min-width: 180px;
    border-radius: 999px;
    object-position: left;
    box-shadow: 0 0 23px 0 rgba(0, 0, 0, 0.8);
    border: 10px solid $hero-border-color;
}

.short-intro {
    color: $secondary-text-color;
}

.hero-name {
    font-size: xx-large;
}

.hero-description {
    color: $long-text-color;
    padding-block: 1.7em;
}

.hero-btns {
    display: flex;
    gap: 0.7em;
}

.hero-btn {
    background-color: $main-bg-color;
    color: $main-text-color;
    $border-color: $secondary-button-border-color;
    border: 1.1px solid $border-color;
    padding: 0.45em 1.4em;
    border-radius: 1.2em;

    &:hover {
        background-color: $border-color;
        color: $o-main-text-color;
        transition: all 350ms ease-in-out;
    }
}

.hero-cv-btn {
    $border-color: $main-button-border-color;
    border: 1.1px solid $border-color;
    &:hover {
        background-color: $border-color;
    }
}

.sidebar-logo {
    background-color: $main-text-color;
    -webkit-mask: url(../../public/menu-bars.svg) no-repeat center;
    mask: url(../../public/menu-bars.svg) no-repeat center;
    width: 22px;
    height: 22px;
    cursor: pointer;
}

.mobile {
    display: none;
}

.job-descriptions {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5em;
}

.job-description-section {
    display: flex;
    gap: 1em;
}

.job-description-logo {
    flex-grow: 1;
    background-color: $main-color;
    -webkit-mask: url($megaphone-logo) no-repeat center;
    mask: url($megaphone-logo) no-repeat center;
    width: 25px;
    height: 25px;
    cursor: pointer;
}

.job-description-info {
    flex: 17;
}

@media (max-width: $sm-screen) {
    .job-descriptions {
        grid-template-columns: 1fr;
    }
}

@media (max-width: $md-screen) {
    .desktop {
        display: none;
    }

    .mobile {
        display: inherit;
    }

    .alphabet-profile {
        width: 30px;
    }
}

//TODO: add new screen sizes

@media (max-width: $md-screen) {
    .hero-info {
        text-align: center;
    }

    .hero-btns {
        justify-content: center;
    }

    .hero-img {
        max-width: unset;
        width: clamp(200px, 100px + 30vw, 275px);
    }

    .hero-description {
        width: 100%;
    }
    .container {
        width: 100%;
        margin: 0;
        border-radius: 0;
        min-height: 100vh;
        padding-block: 0.5em;
    }
}
</style>
