<template>
    <section class="skills">
        <section class="core-skills">
            <h3 class="core-skills-title">Core Skills</h3>
            <div class="core-skills-wrapper">
                <circular-skill-bar
                    v-for="skill in coreSkills"
                    :title="skill.title"
                    v-model="skill.value"
                />
            </div>
        </section>
        <section class="util-skills">
            <h3 class="util-skills-title">Util Skills</h3>
            <div class="util-skills-wrapper">
                <linear-skill-bar
                    v-for="skill in utilSkills"
                    :title="skill.title"
                    :value="skill.value"
                />
            </div>
        </section>
        <section class="work-experiences"></section>
    </section>
</template>

<script setup>
import CircularSkillBar from "../CircularSkillBar.vue";
import LinearSkillBar from "../LinearSkillBar.vue";
import { ref } from "vue";

const coreSkills = ref([
    {
        title: "Laravel",
        value: 60,
    },
    {
        title: "Php",
        value: 70,
    },
    {
        title: "Vue",
        value: 55,
    },
    {
        title: "Sql",
        value: 50,
    },
    {
        title: "MongoDB",
        value: 25,
    },
    {
        title: "English",
        value: "85",
    },
]);

const utilSkills = ref([
    {
        title: "Github",
        value: 0.4,
    },
    {
        title: "Linux",
        value: 0.5,
    },
    {
        title: "TDD",
        value: 0.7,
    },
    {
        title: "Github Actions",
        value: 0.35,
    },
    {
        title: "server Management",
        value: 0.6,
    },
]);
</script>

<style lang="scss" scoped>
.core-skills-wrapper {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    row-gap: 3em;
}

.util-skills-wrapper {
    display: flex;
    flex-direction: column;
    gap: 2.5em;
    // margin-block: auto;
}

.skills {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2em;
}

.util-skills {
    display: flex;
    flex-direction: column;
}

.util-skills-title {
    justify-content: flex-start;
    margin-bottom: 1em;
}

.core-skills-title {
    margin-bottom: 1em;
}
</style>
