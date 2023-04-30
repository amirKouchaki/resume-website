<template>
    <div class="container">
        <article class="resume">
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
                    <a
                        class="link"
                        v-for="(link, idx) in navLinks"
                        :key="idx"
                        @click.prevent="link.click"
                        >{{ link.text }}</a
                    >
                </nav>
                <aside class="sidebar mobile">
                    <mobile-menu :links="navLinks"></mobile-menu>
                    <!-- <div class="sidebar-logo" @click="toggleSidebar"></div> -->
                </aside>
            </header>
            <section class="main-section">
                <section class="hero-section">
                    <img
                        src="../assets/images/profile.jpg"
                        alt=""
                        class="hero-img"
                    />
                    <div class="hero-info">
                        <p class="short-intro">Fullstack Web Developer</p>
                        <h2 class="hero-name">Amir Kouchaki</h2>
                        <p class="hero-description">
                            Software Engineering major in Guilan University.
                            Experienced in Laravel and php with a good
                            understanding of MySQL , HTML , CSS , Vue ,
                            Javascript. Enthusiastic to learn new
                            frameworks,languages or patterns .
                        </p>
                        <div class="hero-btns">
                            <button class="hero-cv-btn hero-btn">
                                Download CV</button
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
                            v-for="jobDescription in jobDescriptions"
                            :key="jobDescription.id"
                        >
                            <div
                                class="job-description-logo"
                                :style="` -webkit-mask: url(${publicPath(
                                    jobDescription.logo
                                )}) no-repeat center; mask: url(${publicPath(
                                    jobDescription.logo
                                )}) no-repeat center;`"
                            ></div>
                            <div class="job-description-info">
                                <h3 class="job-description-heading">
                                    {{ jobDescription.title }}
                                </h3>
                                <p class="job-description">
                                    {{ jobDescription.description }}
                                </p>
                            </div>
                        </section>
                    </div>
                </generic-section>
                <generic-section title="Technologies I Use">
                    <carousel></carousel>
                </generic-section>

                <generic-section title="Fun Facts">
                    <div class="fact-cards">
                        <fact-card
                            v-for="funFact in funFacts"
                            :key="funFact.id"
                            :funFact="funFact"
                        />
                    </div>
                </generic-section>
            </section>
            <section class="resume-footer">
                <nav class="footer-nav">
                    <a target="_blank" href="https://github.com/amirKouchaki"
                        >Github</a
                    >
                    <a target="_blank" href="https://t.me/amir3409">Telegram</a>
                    <a href="mailto:amirkouchaki1@gmail.com">Email</a>
                </nav>
                <p class="copywrite">
                    The design belongs to
                    <a
                        target="_blank"
                        href="https://lmpixels.com/wp/leven-wp/dark/"
                        >Impixels.com</a
                    >
                </p>
            </section>
        </article>
    </div>
    <message-thread-modal />
    <track-message-modal />
    <auth-modal />
</template>

<script setup>
import { publicPath } from "../composables/publicUrl";
import GenericSection from "../components/resume/GenericSection.vue";
import Carousel from "../components/Carousel.vue";
import FactCard from "../components/resume/FactCard.vue";
import MessageThreadModal from "../components/modals/MessageThreadModal.vue";
import TrackMessageModal from "../components/modals/TrackMessageModal.vue";
import useModals from "../stores/modals";
import AuthModal from "../components/modals/AuthModal.vue";
import MobileMenu from "../components/MobileMenu.vue";
import { ref } from "vue";

const modals = useModals();

const showSidebar = ref(false);

const jobDescriptions = [
    {
        id: 1,
        logo: "svgs/pencil.svg",
        title: "Backend",
        description:
            "Development of rest or stateful APIs to add the desired functionality to your website's design using Latest version of php with Laravel .",
    },
    {
        id: 2,
        logo: "svgs/shop.svg",
        title: "Deployment",
        description:
            "Deploying and configuring your website on vps , linux host ( cpanel , directAdmin )  from scratch using nginx. Deploying your fullstack website on your custom domain with required subdomains . ",
    },
    {
        id: 3,
        logo: "svgs/monitor.svg",
        title: "Frontend",
        description:
            "Customer-oriented development and conversion of the desired UI/UX to HTML,CSS,SCSS,Javascript and connecting it to The backend and server .",
    },
    {
        id: 4,
        logo: "svgs/megaphone.svg",
        title: "TDD",
        description:
            "Writing tests using phpunit before implementing the features so when anyone needs to refactor the code, the tests will fail if anything goes wrong so you can add features or change features much faster .",
    },
];

const funFacts = [
    {
        id: 1,
        logo: "svgs/heart.svg",
        title: "Happy Clients",
        data: 578,
    },
    {
        id: 2,
        logo: "svgs/clock.svg",
        title: "Working Hours",
        data: 4780,
    },
    {
        id: 3,
        logo: "svgs/star.svg",
        title: "Awards Won",
        data: 15,
    },
    {
        id: 4,
        logo: "svgs/mug.svg",
        title: "Coffee Consumed",
        data: 1286,
    },
];

const navLinks = [
    {
        text: "About Me",
        click: "",
    },
    {
        text: "Resume",
        click: "",
    },
    {
        text: "Track Message",
        click: modals.toggleTrackMessageModal,
    },
    {
        text: "Blog",
        click: "",
    },
    {
        text: "Contact",
        click: modals.toggleMessageModal,
    },
    {
        text: "Login -- Sign Up",
        click: modals.toggleAuthModal,
    },
];
</script>

<style lang="scss" scoped>
@use "../abstracts" as *;

.main-section {
    position: relative;
    padding: 2em $container-inline-padding;
}

.resume-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 2em $container-inline-padding;
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
    gap: clamp(1.5em, 1em + 1vw, 2.7em);
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

    &:hover,
    &:focus {
        background-color: $border-color;
        color: $o-main-text-color;
        transition: all 350ms ease-in-out;
        outline: none;
    }
}

.hero-cv-btn {
    $border-color: $main-button-border-color;
    border: 1.1px solid $border-color;
    user-select: none;
    &:hover,
    &:focus {
        background-color: $border-color;
    }
}

.sidebar-logo {
    background-color: $main-text-color;
    -webkit-mask: url(svgs/menu-bars.svg) no-repeat center;
    mask: url(/svgs/menu-bars.svg) no-repeat center;
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

.job-description-heading {
    margin-bottom: 0.3em;
}

.job-description-logo {
    flex-grow: 1;
    background-color: $main-color;

    width: 25px;
    height: 25px;
    cursor: pointer;
}

.job-description-info {
    flex: 17;
}

.fact-cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5em;
}

.resume-footer {
    padding-inline: $container-inline-padding;
    display: flex;
    justify-content: space-between;
    padding-block: 1em;
    font-size: 0.9rem;
    background-color: $footer-bg-color;
    border-top: 2px solid $footer-border-color;
}

.footer-nav {
    display: flex;
    gap: 1.5em;
}

.copywrite {
    display: flex;
    gap: 0.2em;
}

@media (max-width: $sm-screen) {
    .job-descriptions {
        grid-template-columns: 1fr;
    }

    .fact-cards {
        display: flex;
        flex-direction: column;
    }

    .resume-footer {
        flex-direction: column;
        gap: 0.7em;
    }

    .footer-nav,
    .copywrite {
        justify-content: center;
    }
}

@media (max-width: $sm-to-md-screen) {
    .fact-cards {
        grid-template-columns: repeat(2, 1fr);
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
        max-width: 100%;
        width: 100%;
        margin: 0;
        border-radius: 0;
        min-height: 100vh;
        padding-block: 0.5em;
    }
}
</style>
