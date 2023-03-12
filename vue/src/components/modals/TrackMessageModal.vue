<template>
    <modal
        v-if="modals.showTrackMessageModal"
        :toggle="modals.toggleTrackMessageModal"
    >
        <tabs-wrapper ref="tabWrapper">
            <tab title="track   ">
                <form
                    action=""
                    class="support-form"
                    @submit.prevent="getMessage()"
                >
                    <h3 class="contact-form-heading">Track Your message</h3>

                    <form-input
                        type="text"
                        labelText="Tracking Code"
                        inputType="normal"
                        v-model="trackMessage"
                    />
                    <form-button /></form
            ></tab>
            <tab title="show"
                ><show-messages :thread="messageThread" />
                <div class="edit-thread-btns">
                    <button
                        class="reply-btn thread-btn"
                        @click="tabWrapper.next()"
                    >
                        reply</button
                    ><button class="finish-thread-btn thread-btn">
                        finish
                    </button>
                </div>
            </tab>
            <tab title="tab 3">the</tab>
            <tab title="tab 4">other</tab>
            <tab title="tab 5">side</tab>
        </tabs-wrapper>
    </modal>
    >
</template>

<script setup>
import Modal from "../../components/Modal.vue";
import FormInput from "../../components/FormInput.vue";
import FormButton from "../../components/FormButton.vue";
import { ref } from "vue";
import axiosClient from "../../../axios";
import useModals from "../../stores/modals";
import TabsWrapper from "../TabsWrapper.vue";
import Tab from "../Tab.vue";
import ShowMessages from "../ShowMessages.vue";

const tabWrapper = ref();
const modals = useModals();
const messageThread = ref({});
const trackMessage = ref(null);
const getMessage = async () => {
    const res = await axiosClient.get(
        `/api/messageThread/${trackMessage.value}`
    );
    messageThread.value = res.data;
    console.log(messageThread.value);
    tabWrapper.value.next();
};
</script>

<style lang="scss" scoped>
@use "../../abstracts" as *;
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

.edit-thread-btns {
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.thread-btn {
    padding: 0.7em 3em;
    font-size: 1.1rem;
    letter-spacing: 0.7px;
    margin-block: 1em;
}

.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
