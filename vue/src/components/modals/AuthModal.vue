<template>
    <modal-transition>
        <modal v-if="modals.showAuthModal" :toggle="modals.toggleAuthModal">
            <tabs-wrapper type="multi-page">
                <tab title="Login">
                    <h3 class="modal-form-heading">Login</h3>
                    <FormKit type="form" submit-label="Login" @submit="login">
                        <FormKit
                            type="email"
                            label="Email"
                            name="email"
                            v-model="loginData.email"
                            :errors="loginErrors.email"
                        ></FormKit>

                        <FormKit
                            type="password"
                            label="Password"
                            name="password"
                            v-model="loginData.password"
                            :errors="loginErrors.password"
                        ></FormKit>
                    </FormKit>
                    <button @click="test">test login</button>
                </tab>
                <tab title="Sign Up">
                    <h3 class="modal-form-heading">Sign Up</h3>
                    <FormKit
                        type="form"
                        submit-label="Sign Up"
                        @submit="register"
                    >
                        <FormKit
                            type="text"
                            label="Name"
                            name="name"
                            v-model="SignUpData.name"
                            validation="length:0,100"
                            :errors="signUpErrors.name"
                        />
                        <FormKit
                            type="email"
                            label="Email"
                            name="email"
                            validation="required"
                            v-model="SignUpData.email"
                            :errors="signUpErrors.email"
                        ></FormKit>
                        <FormKit
                            type="tel"
                            label="Phone"
                            name="phone"
                            v-model="SignUpData.phone"
                            validation="length:0,11|matches:/^09\d{9}$/"
                            :errors="signUpErrors.phone"
                        />
                        <FormKit type="group">
                            <FormKit
                                type="password"
                                name="password"
                                label="Password"
                                validation="required"
                                v-model="SignUpData.password"
                                :errors="signUpErrors.password"
                            />
                            <FormKit
                                type="password"
                                name="password_confirm"
                                label="Confirm Password"
                                validation="required|confirm"
                                validation-label="Confirmation"
                                v-model="SignUpData.password_confirmation"
                            />
                        </FormKit>
                        <FormKit
                            type="checkbox"
                            label="Remember Me"
                            name="remember_me"
                            v-model="SignUpData.remember"
                            validation="required"
                        />
                    </FormKit>
                </tab>
            </tabs-wrapper>
        </modal>
    </modal-transition>
</template>

<script setup>
import useModals from "../../stores/modals";
import ModalTransition from "../transitions/ModalTransition.vue";
import Modal from "../Modal.vue";
import TabsWrapper from "../TabsWrapper.vue";
import Tab from "../Tab.vue";
import { ref } from "vue";
import axiosClient from "../../../axios";
const modals = useModals();
const signUpErrors = ref({});
const loginErrors = ref({});
const loginData = ref({
    email: "",
    password: "",
});
const SignUpData = ref({
    name: "",
    email: "",
    phone: "",
    password: "",
    password_confirmation: "",
    remember: false,
});

const login = async () => {
    try {
        loginErrors.value = {};
        await axiosClient.post("login", loginData.value);
        loginData.value = {
            email: "",
            password: "",
        };
    } catch (e) {
        loginErrors.value = e.response.data.errors;
    }
    loginData.value.password = "";
};

const register = async () => {
    try {
        signUpErrors.value = {};
        await axiosClient.post("register", SignUpData.value);
        SignUpData.value = {
            name: "",
            email: "",
            phone: "",
            password: "",
            password_confirmation: "",
            remember: false,
        };
    } catch (e) {
        signUpErrors.value = e.response.data.errors;
    }
};

const test = async () => {
    try {
        console.log(await axiosClient.get("api/user"));
    } catch (e) {
        console.log(e);
    }
};
</script>

<style></style>
