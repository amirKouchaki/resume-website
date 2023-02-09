<template>
    <article class="container">
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
                <router-link :to="{ name: 'resume' }">About me</router-link>
                <router-link :to="{ name: 'resume' }">Resume</router-link>
                <router-link :to="{ name: 'resume' }">Portfolio</router-link>
                <router-link :to="{ name: 'resume' }">Blog</router-link>
                <router-link :to="{ name: 'resume' }">Contact</router-link>
                <router-link :to="{ name: 'resume' }">Extra</router-link>
            </nav>
            <aside class="mobile">
                <div class="sidebar-nav"></div>
            </aside>
        </header>
        <section class="hero-section">
            <img src="../assets/images/profile.jpg" alt="" class="hero-img" />
            <div class="hero-info">
                <p class="short-intro">Web Designer</p>
                <h2 class="hero-name">Amir Kouchaki</h2>
                <p class="hero-description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Quam illum excepturi assumenda magnam, error, eligendi
                    suscipit placeat vitae, tempora perferendis atque? Ipsa odit
                    veritatis repellat eveniet fuga quae.
                </p>
                <div class="hero-btns">
                    <button class="hero-cv-btn hero-btn">Download CV</button
                    ><button class="hero-btn hero-contact-btn">Contact</button>
                </div>
            </div>
        </section>
    </article>
</template>

<script setup></script>

<style lang="scss" scoped>
@use "../abstracts" as *;
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

.sidebar-nav {
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
    }
}
</style>
