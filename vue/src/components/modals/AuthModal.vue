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
                        ></FormKit>

                        <FormKit
                            type="password"
                            label="Password"
                            name="password"
                            v-model="loginData.password"
                        ></FormKit>
                        <p class="error" v-if="errors">{{ errors }}</p>
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
                        />
                        <FormKit
                            type="email"
                            label="Email"
                            name="email"
                            validation="required"
                            v-model="SignUpData.email"
                        ></FormKit>
                        <FormKit
                            type="tel"
                            label="Phone"
                            name="phone"
                            v-model="SignUpData.phone"
                            validation="length:0,11|matches:/^09\d{9}$/"
                        />
                        <FormKit type="group">
                            <FormKit
                                type="password"
                                name="password"
                                label="Password"
                                validation="required"
                                v-model="SignUpData.password"
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
                        <p class="error" v-if="errors">{{ errors }}</p>
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
const errors = ref(null);
let loginData = {
    email: "",
    password: "",
};
let SignUpData = {
    name: "",
    email: "",
    phone: "",
    password: "",
    password_confirmation: "",
    remember: false,
};

const login = async () => {
    try {
        errors.value = null;
        await axiosClient.post("login", loginData);
        loginData = {
            email: "",
            password: "",
        };
    } catch (e) {
        errors.value = e.response.message;
    }
};

const register = async () => {
    try {
        errors.value = null;
        await axiosClient.post("register", SignUpData);
        SignUpData = {
            name: "",
            email: "",
            phone: "",
            password: "",
            password_confirmation: "",
            remember: false,
        };
    } catch (e) {
        errors.value = e.response.message;
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
