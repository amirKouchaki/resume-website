<template>
    <modal v-model="modals.showTrackMessageModal">
        <!-- <multi-step /> -->
        <tabs-wrapper>
            <tab title="tab 1">hello</tab>
            <tab title="tab 2">from</tab>
            <tab title="tab 3">the</tab>
            <tab title="tab 4">other</tab>
            <tab title="tab 5">side</tab>
        </tabs-wrapper>
        <form action="" class="support-form" @submit.prevent="getMessage()">
            <h3 class="contact-form-heading">Track Your message</h3>

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
import useModals from "../../stores/modals";
import TabsWrapper from "../TabsWrapper.vue";
import Tab from "../Tab.vue";

const modals = useModals();

const trackMessage = ref(null);
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
