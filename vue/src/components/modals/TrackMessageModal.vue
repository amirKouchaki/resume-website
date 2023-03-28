<template>
    <modal
        v-if="modals.showTrackMessageModal"
        :toggle="modals.toggleTrackMessageModal"
    >
        <tabs-wrapper ref="tabWrapper" type="multi-page">
            <tab title="track">
                <FormKit
                    type="form"
                    @submit="trackMessageThread"
                    submit-label="Find Thread"
                >
                    <h3 class="contact-form-heading">Track Your message</h3>
                    <FormKit
                        type="number"
                        label="Thread code"
                        v-model="trackMessage"
                    />
                </FormKit>
            </tab>
            <tab
                title="show"
                :renderRule="Object.keys(messageThread).length !== 0"
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
            <tab
                title="reply"
                :renderRule="Object.keys(messageThread).length !== 0"
            >
                <FormKit
                    type="form"
                    @submit="addReply"
                    submit-label="Add Reply"
                    v-model="reply"
                >
                    <h3 class="contact-form-heading">Add a reply</h3>
                    <FormKit type="text" label="Title" name="title" />
                    <!-- <FormKit
                        type="textarea"
                        label="Floating Textarea Label via prop" /> -->
                    <FormKit type="textarea" label="Body" name="body"
                /></FormKit>
            </tab>
            <tab title="test">
                <FormKit
                    type="form"
                    @submit="sendTest"
                    submit-label="send Test"
                    v-model="testData"
                >
                    <FormKit
                        type="text"
                        label="Floating Text Label via prop"
                        name="username" />
                    <!-- <FormKit
                        type="textarea"
                        label="Floating Textarea Label via prop" /> -->
                    <FormKit
                        type="email"
                        label="I have a standard label"
                        name="email"
                /></FormKit>
            </tab>
        </tabs-wrapper>
    </modal>
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
const trackMessage = ref("");

const reply = ref({
    title: "",
    body: "",
});

const testData = ref({
    username: "",
    email: "",
});

const addReply = async () => {
    const res = await axiosClient.post(
        `/api/messageThread/${messageThread.value.id}/reply`,
        {
            title: reply.value.title,
            body: reply.value.body,
        }
    );
    await getMessageThread();
    reply.value = {
        title: "",
        body: "",
    };

    tabWrapper.value.previous();
};

const trackMessageThread = async () => {
    await getMessageThread();
    tabWrapper.value.next();
};

const getMessageThread = async () => {
    try {
        const res = await axiosClient.get(
            `/api/messageThread/${trackMessage.value}`
        );
        messageThread.value = res.data;
    } catch (err) {
        console.log(err);
    }
};
function sleep(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
}

const sendTest = async (data) => {
    await sleep(3000);
    console.log("hello");
    console.log(data);
};
</script>

<style lang="scss" scoped>
@use "../../abstracts" as *;

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
    border-radius: 0.2em;
    background-color: $secondary-bg-color;
    border: 1px solid $fact-border-color;
    color: $main-text-color;
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
