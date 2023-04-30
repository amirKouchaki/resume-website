<template>
    <modal :show="modals.showAuthModal" :close="modals.toggleAuthModal">
        <tabs-wrapper
            :tabs="[
                { title: 'Login', disabled: false },
                { title: 'Sign Up', disabled: false },
                { title: 'Forgot Password', disabled: false },
            ]"
            ref="tabsWrapper"
        >
            <template #tab-panels>
                <tab-panel-transition>
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
                        ></FormKit
                        ><a @click.prevent="forgotPassTab">Forgot password</a>
                    </FormKit>

                    <social-auth-button
                        text="Login With Google"
                        iconSrc="google.svg"
                        :onClick="test"
                        bgColor="#007bff"
                        text-color="#f2f2f2"
                    />
                </tab-panel-transition>
                <tab-panel-transition>
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
                </tab-panel-transition>
                <tab-panel-transition>
                    <FormKit
                        type="form"
                        submit-label="Sign Up"
                        @submit="forgotPassword"
                    >
                        <FormKit
                            type="email"
                            label="Email"
                            name="email"
                            validation="required"
                            v-model="loginData.email"
                            :errors="forgotPassErrors.email"
                        ></FormKit>
                    </FormKit>
                </tab-panel-transition>
            </template>
        </tabs-wrapper>
    </modal>
</template>

<script setup>
import SocialAuthButton from "../resume/SocialAuthButton.vue";
import useModals from "../../stores/modals";
import modal from "../Modal.vue";
import TabsWrapper from "../TabsWrapper.vue";
import TabPanelTransition from "../transitions/TabPanelTransition.vue";
import { ref } from "vue";
import axiosClient from "../../../axios";
import { useRouter } from "vue-router";
const modals = useModals();
const signUpErrors = ref({});
const loginErrors = ref({});
const forgotPassErrors = ref({});
const tabsWrapper = ref();
const router = useRouter();
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

const forgotPassTab = () => {
    tabsWrapper.value.changeTab(2);
};

const login = async () => {
    try {
        loginErrors.value = {};
        await axiosClient.post("login", loginData.value);
        loginData.value = {
            email: "",
            password: "",
        };
        router.push({ name: "dashboard" });
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

const forgotPassword = async () => {
    try {
        signUpErrors.value = {};
        await axiosClient.post("forgot-password", {
            email: loginData.value.email,
        });
    } catch (error) {
        forgotPassErrors.value = error.response.data.errors;
    }
};
const test = async () => {
    try {
        const res = await axiosClient.get("oauth/google/redirect");
        window.location.href = res.data.redirectUrl;
    } catch (e) {
        console.log(e);
    }
};
</script>

<style></style>
