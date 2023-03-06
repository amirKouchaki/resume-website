<template>
    <modal v-model="modals.showMessageThreadModal">
        <form class="support-form" @submit.prevent="createMessageThread()">
            <h3 class="contact-form-heading">Contact me</h3>
            <form-input
                type="text"
                labelText="Name"
                inputType="normal"
                v-model="contactPerson.name"
            />
            <form-input
                type="email"
                labelText="Email"
                inputType="normal"
                v-model="contactPerson.email"
            />
            <form-input
                type="tel"
                labelText="Phone"
                inputType="normal"
                v-model="contactPerson.phone"
            />
            <form-input
                labelText="title"
                inputType="textarea"
                v-model="messageThread.title"
                t-row="2"
            />
            <form-input
                labelText="Text"
                inputType="textarea"
                v-model="messageThread.body"
                t-row="10"
            />
            <form-button />
        </form>
    </modal>
</template>

<script setup>
import MultiStep from "../MultiStep.vue";
import Modal from "../../components/Modal.vue";
import FormInput from "../../components/FormInput.vue";
import FormButton from "../../components/FormButton.vue";
import { ref } from "vue";
import axiosClient from "../../../axios";
import useModals from "../../stores/modals";
const modals = useModals();
const contactPerson = {
    name: "",
    email: "",
    phone: "",
};

const messageThread = {
    title: "",
    body: "",
};

const createMessageThread = async () => {
    await axiosClient.get("/sanctum/csrf-cookie");
    await axiosClient.post("/api/messageThread", {
        ...messageThread,
        ...contactPerson,
    });
};
</script>

<style lang="scss" scoped>
.support-form {
    padding: 2em 1em;
}

.contact-form-heading {
    font-family: sans-serif;
    font-weight: bold;
    font-size: 2rem;
    letter-spacing: 0.7px;
    line-height: 1.6;
}
</style>
