<template>
    <div class="container">
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
            <nav class="main-nav">
                <router-link :to="{ name: 'resume' }">About me</router-link>
                <router-link :to="{ name: 'resume' }">Resume</router-link>
                <router-link :to="{ name: 'resume' }">Portfolio</router-link>
                <router-link :to="{ name: 'resume' }">Blog</router-link>
                <router-link :to="{ name: 'resume' }">Contact</router-link>
                <router-link :to="{ name: 'resume' }">Extra</router-link>
            </nav>
        </header>
    </div>
</template>

<script setup></script>

<style lang="scss" scoped>
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
</style>
