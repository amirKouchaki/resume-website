<script setup>
import supportModal from "./components/SupportModal.vue";
import FormInput from "./components/FormInput.vue";
</script>

<template>
    <support-modal>
        <form class="support-form">
            <form-input type="text" labelText="Name" />
            <form-input type="email" labelText="Email" />

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </support-modal>
    <router-view />
</template>

<style lang="scss" scoped>
.support-form {
    width: 500px;
    padding: 1em;
}
</style>
