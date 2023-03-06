<template>
    <router-link :to="{ name: 'resume' }">About me</router-link>
    <router-link :to="{ name: 'resume' }">Resume</router-link>
    <router-link
        :to="{ name: 'resume' }"
        @click.prevent="toggleTrackMessageModal"
        >Track message</router-link
    >
    <router-link :to="{ name: 'resume' }">Blog</router-link>
    <router-link :to="{ name: 'resume' }" @click.prevent="toggleMessageModal"
        >Contact</router-link
    >
    <router-link :to="{ name: 'resume' }">Extra</router-link>

    <!-- contact form modal -->

    <modal v-model="showMessageThreadModal">
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

    <modal v-model="showTrackMessageModal">
        <form action="" class="support-form" @submit.prevent="getMessage()">
            <h3 class="contact-form-heading">Track Your message</h3>
            <multi-step />
            <form-input
                type="text"
                labelText="Tracking Code"
                inputType="normal"
                v-model="trackMessage"
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

const showMessageThreadModal = ref(false);
const showTrackMessageModal = ref(false);

const toggleMessageModal = () => {
    document.body.classList.toggle("ov-hid");
    showMessageThreadModal.value = !showMessageThreadModal.value;
};

const toggleTrackMessageModal = () => {
    document.body.classList.toggle("ov-hid");
    showTrackMessageModal.value = !showTrackMessageModal.value;
};

const trackMessage = ref(null);

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

const getMessage = async () => {
    await axiosClient.get(`/api/messageThread/${trackMessage.value}`);
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
