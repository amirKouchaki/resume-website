<template>
    <div>
        <h4 style="text-align: center">{{ title }}</h4>
        <div class="knob-wrapper" style="display: flex">
            <q-knob
                v-model="modelValue"
                readonly
                size="150px"
                class="q-ma-md"
                show-value
                thickness=".12"
                font-size="2rem"
                track-color="gray"
            >
                {{ modelValue }}%
            </q-knob>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
    title: String,
});

const modelValue = defineModel();
const knobValue = ref(75);
const click = () => {
    knobValue.value = knobValue.value == 0 ? 75 : 0;
};
</script>

<style lang="scss" scoped>
@use "../abstracts" as *;
:deep(.q-circular-progress) {
    stroke-linecap: round;
}

:deep(.q-circular-progress__circle) {
    color: $main-color;
}

// :deep(.q-circular-progress__center) {
//     color: rgba($main-color, 0.1) !important;
// }

:deep(.q-circular-progress__track) {
    color: gray !important;
    stroke-width: 1.7;
}

.knob-wrapper {
    justify-content: center;
}
</style>
