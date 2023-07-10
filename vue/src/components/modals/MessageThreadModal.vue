<template>
    <modal
        :show="modals.showMessageThreadModal"
        :close="modals.toggleMessageModal"
    >
        <FormKit
            type="form"
            @submit="createMessageThread"
            submit-label="Create Thread"
            ref="contactForm"
            id="contactForm"
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
    </modal>
</template>

<script setup>
import Modal from "../Modal.vue";
import useModals from "../../stores/modals";
import { computed, ref } from "vue";
import { errorToast, successToast } from "../../composables/toasts";
import { createMessageThreadReq } from "../../services/messageThread";
import { useMutation } from "@tanstack/vue-query";
import { reset } from "@formkit/core";
import {
    submitStarted,
    submitFinished,
} from "../../composables/formLoadingHandler";
const contactForm = ref(null);

const modals = useModals();
const contactPerson = ref({
    name: "",
    email: "",
    phone: "",
});

const messageThread = ref({
    title: "",
    body: "",
});

const { error, mutate } = useMutation({
    mutationFn: createMessageThreadReq,
    onSuccess: () => reset("contactForm"),
    onSettled: () => submitFinished(contactForm),
});

const errors = computed(() => error.value?.response?.data.errors ?? {});

const createMessageThread = () => {
    mutate({ ...messageThread.value, ...contactPerson.value });
    submitStarted(contactForm);
};
</script>

<style lang="scss" scoped></style>
