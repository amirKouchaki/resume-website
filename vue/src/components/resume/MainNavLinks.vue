<template>
    <router-link :to="{ name: 'resume' }">About me</router-link>
    <router-link :to="{ name: 'resume' }">Resume</router-link>
    <router-link :to="{ name: 'resume' }">Portfolio</router-link>
    <router-link :to="{ name: 'resume' }">Blog</router-link>
    <router-link :to="{ name: 'resume' }" @click.prevent="toggleModal"
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
</template>

<script setup>
import Modal from "../../components/Modal.vue";
import FormInput from "../../components/FormInput.vue";
import FormButton from "../../components/FormButton.vue";
import { ref } from "vue";

const showMessageThreadModal = ref(false);

const toggleModal = () => {
    document.body.classList.toggle("ov-hid");
    showMessageThreadModal.value = !showMessageThreadModal.value;
};

const contactPerson = {
    name: "amir",
    email: "amirkouchaki1@gmail.com",
    phone: "0911436636",
};

const messageThread = {
    title: "averg",
    body: "erjkbqpierfvl jfvdhfiqwehfkljqwebnf;kquhcvpqwefbqlwkjfnpqxn cwqehfqeuifiqhenfkljnwfkjshfv87asdn;awlekjf[owe8yfghbnwgk]",
};

const createMessageThread = async () => {
    await axiosClient.get("/sanctum/csrf-cookie");
    await axiosClient.post("/api/messageThread", {
        ...messageThread,
        ...contactPerson,
    });
};
</script>

<style lang="scss" scoped></style>
