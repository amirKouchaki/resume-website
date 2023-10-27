<template>
    <div>
        <h4 class="title">{{ title }}</h4>
        <q-linear-progress
            :value="value"
            size="9px"
            label="60%"
            rounded
            class="q-mt-sm"
            stripe
        >
        </q-linear-progress>
    </div>
</template>

<script setup>
const props = defineProps({
    title: String,
    value: Number,
});
</script>

<style lang="scss" scoped>
@use "../abstracts/" as *;
:deep(.q-linear-progress__model) {
    color: $main-color;
}

.title {
    margin-bottom: 0.6em;
}
</style>
