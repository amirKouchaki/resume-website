<template>
    <modal
        v-if="modals.showMessageThreadModal"
        :toggle="modals.toggleMessageModal"
    >
        <FormKit
            type="form"
            @submit="createMessageThread"
            submit-label="Create Thread"
        >
            <h3 class="contact-form-heading">Contact me</h3>
            <FormKit
                type="text"
                label="Name"
                name="name"
                v-model="contactPerson.name" />
            <FormKit
                type="email"
                label="Email"
                name="email"
                v-model="contactPerson.email" />
            <FormKit
                type="tel"
                label="Phone"
                name="phone"
                v-model="contactPerson.phone" />
            <FormKit
                type="text"
                label="title"
                name="title"
                v-model="messageThread.title" />
            <FormKit
                type="textarea"
                label="Text"
                name="body"
                v-model="messageThread.body"
        /></FormKit>
    </modal>
</template>

<script setup>
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
    padding: 1em;
}

.contact-form-heading {
    font-family: sans-serif;
    font-weight: bold;
    font-size: 2rem;
    letter-spacing: 0.7px;
    line-height: 1.6;
    margin-bottom: 1em;
}
</style>
