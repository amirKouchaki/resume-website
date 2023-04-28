<template>
    <new-modals
        :show="modals.showMessageThreadModal"
        :close="modals.toggleMessageModal"
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
                :errors="errors.name"
            />

            <FormKit
                type="email"
                label="Email"
                name="email"
                v-model="contactPerson.email"
                validation="email|length:0,255"
                :errors="errors.email"
            />

            <FormKit
                type="tel"
                label="Phone"
                name="phone"
                v-model="contactPerson.phone"
                validation="length:0,11|matches:/^09\d{9}$/"
                :errors="errors.phone"
            />

            <FormKit
                type="text"
                label="title"
                name="title"
                v-model="messageThread.title"
                validation="required|length:1,200"
                :errors="errors.title"
            />

            <FormKit
                type="textarea"
                label="Text"
                name="body"
                v-model="messageThread.body"
                validation="required|length:1,800"
                :errors="errors.body"
            />
        </FormKit>
    </new-modals>
</template>

<script setup>
import NewModals from "../tabs/NewModals.vue";
import Modal from "../../components/Modal.vue";
import axiosClient from "../../../axios";
import useModals from "../../stores/modals";
import ModalTransition from "../transitions/ModalTransition.vue";
import { ref } from "vue";
const modals = useModals();
let contactPerson = ref({
    name: "",
    email: "",
    phone: "",
});

let messageThread = ref({
    title: "",
    body: "",
});

const errors = ref({});
const createMessageThread = async () => {
    try {
        errors.value = {};
        await axiosClient.post("/api/messageThread", {
            ...messageThread.value,
            ...contactPerson.value,
        });
        contactPerson.value = {
            name: "",
            email: "",
            phone: "",
        };
        messageThread.value = {
            title: "",
            body: "",
        };
    } catch (e) {
        errors.value = e.response.data.errors;
    }
};
</script>

<style lang="scss" scoped></style>
