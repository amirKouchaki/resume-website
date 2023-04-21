<template>
    <modal-transition>
        <modal
            v-if="modals.showMessageThreadModal"
            :toggle="modals.toggleMessageModal"
        >
            <FormKit
                type="form"
                @submit="createMessageThread"
                submit-label="Create Thread"
            >
                <h3 class="modal-form-heading">Contact me</h3>
                <FormKit
                    type="text"
                    label="Name"
                    name="name"
                    v-model="contactPerson.name"
                    validation="length:0,100"
                />

                <FormKit
                    type="email"
                    label="Email"
                    name="email"
                    v-model="contactPerson.email"
                    validation="email|length:0,255"
                />

                <FormKit
                    type="tel"
                    label="Phone"
                    name="phone"
                    v-model="contactPerson.phone"
                    validation="length:0,11|matches:/^09\d{9}$/"
                />

                <FormKit
                    type="text"
                    label="title"
                    name="title"
                    v-model="messageThread.title"
                    validation="required|length:1,200"
                />

                <FormKit
                    type="textarea"
                    label="Text"
                    name="body"
                    v-model="messageThread.body"
                    validation="required|length:1,800"
                />
                <p class="error" v-if="errors">{{ errors }}</p>
            </FormKit>
        </modal></modal-transition
    >
</template>

<script setup>
import Modal from "../../components/Modal.vue";
import axiosClient from "../../../axios";
import useModals from "../../stores/modals";
import ModalTransition from "../transitions/ModalTransition.vue";
import { ref } from "vue";
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

const errors = ref(null);
const createMessageThread = async () => {
    try {
        errors.value = null;
        await axiosClient.get("/sanctum/csrf-cookie");
        await axiosClient.post("/api/messageThread", {
            ...messageThread,
            ...contactPerson,
        });
        contactPerson = {
            name: "",
            email: "",
            phone: "",
        };
        messageThread = {
            title: "",
            body: "",
        };
    } catch (e) {
        errors.value = e.response.data.message;
    }
};
</script>

<style lang="scss" scoped>
.support-form {
    padding: 1em;
}
</style>
