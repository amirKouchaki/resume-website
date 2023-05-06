<template>
    <div class="center">
        <section class="container reset-pass-section">
            <FormKit
                type="form"
                @submit="resetPassword"
                submit-label="Create Thread"
            >
                <h3 class="modal-form-heading">Reset Password</h3>
                <FormKit type="group">
                    <FormKit
                        type="password"
                        name="password"
                        label="Password"
                        validation="required"
                        v-model="resetPasswordModel.password"
                        :errors="errors.password"
                    />
                    <FormKit
                        type="password"
                        name="password_confirm"
                        label="Confirm Password"
                        validation="required|confirm"
                        validation-label="Confirmation"
                        v-model="resetPasswordModel.password_confirmation"
                        :errors="errors.password_confirmation"
                    />
                </FormKit>
            </FormKit>
        </section>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useRoute } from "vue-router";
import axiosClient from "../../axios";
const route = useRoute();
const errors = ref({});

const resetPasswordModel = ref({
    password: "",
    password_confirmation: "",
});

const resetPassword = async () => {
    try {
        errors.value = {};
        await axiosClient.post("reset-password", {
            ...resetPasswordModel.value,
            ...route.query,
        });
    } catch (errorResponse) {
        errors.value = errorResponse.response.data.errors;
    }
};
</script>

<style lang="scss" scoped>
@use "../abstracts" as *;
.center {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.reset-pass-section {
    padding: 2em $container-inline-padding;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    & > * {
        width: 100%;
    }
}
</style>
