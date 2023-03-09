<template>
    <div class="form-group" v-if="inputType == 'normal'">
        <input
            ref="inputRef"
            :type="type"
            class="form-control"
            placeholder=""
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <span :data-placeholder="labelText" class="input-focus"></span>
    </div>
    <div
        class="form-group text-area"
        v-if="inputType == 'textarea'"
        @click="focusElement"
    >
        <textarea
            ref="inputRef"
            :rows="tRow"
            :type="type"
            class="form-control"
            placeholder=""
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <span :data-placeholder="labelText" class="input-focus"></span>
    </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";

const props = defineProps([
    "type",
    "labelText",
    "inputType",
    "modelValue",
    "tRow",
]);
const emits = defineEmits(["update:modelValue"]);
const inputRef = ref(null);
const focusElement = () => {
    console.log(inputRef.value.focus());
};
</script>

<style scoped lang="scss">
@use "../abstracts" as *;
.form-group {
    position: relative;
    margin-bottom: 2em;
    width: 100%;
    cursor: pointer;
}
.form-control {
    padding-block: 1.4em;
    padding-inline: 0.6em;
    color: $main-text-color;
    width: 100%;
    font-size: 1.3rem;
    background-color: transparent;
    border: none;
    outline: none;

    border-bottom: 0.2px solid $secondary-text-color;
    &:not(:placeholder-shown),
    &:focus {
        & + .input-focus::before {
            top: 0;
        }

        & + .input-focus::after {
            width: 100%;
        }
    }
}

.input-focus {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 4;
    pointer-events: none;
    &::before {
        content: attr(data-placeholder);
        color: $secondary-text-color;
        position: absolute;
        z-index: inherit;
        top: 16px;
        left: 10px;
        font-size: 1.5rem;
        transition: top 0.2s ease-in-out;
        font-family: Poppins-Regular;
        text-align: left;
    }
    &::after {
        content: "";
        display: block;
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        min-height: 3px;
        width: 0;
        -moz-transition: all 0.4s;
        -o-transition: all 0.4s;
        transition: all 0.4s;
        -webkit-transition: all 0.4s left;
        background: linear-gradient(
            45deg,
            $main-color,
            rgba($main-color, 0.75)
        );
    }
}
</style>
