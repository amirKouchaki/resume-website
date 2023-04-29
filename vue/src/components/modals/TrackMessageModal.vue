<template>
    <modal
        :show="modals.showTrackMessageModal"
        :close="modals.toggleTrackMessageModal"
    >
        <tabs-wrapper
            ref="tabWrapper"
            :tabs="[
                { title: 'track', disabled: false },
                {
                    title: 'show',
                    disabled: Object.keys(messageThread).length == 0,
                },
                {
                    title: 'reply',
                    disabled: Object.keys(messageThread).length == 0,
                },
            ]"
        >
            <template #tab-panels>
                <tab-panel-transition>
                    <FormKit
                        type="form"
                        @submit="trackMessageThread"
                        submit-label="Find Thread"
                    >
                        <h3 class="modal-form-heading">Track Your message</h3>
                        <FormKit
                            type="text"
                            label="Thread code"
                            v-model="trackMessage"
                            validation="required|number|length:15,15"
                        />
                    </FormKit>
                </tab-panel-transition>
                <tab-panel-transition>
                    <show-messages :thread="messageThread" />
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
                </tab-panel-transition>

                <tab-panel-transition>
                    <FormKit
                        type="form"
                        @submit="addReply"
                        submit-label="Add Reply"
                        v-model="reply"
                    >
                        <h3 class="contact-form-heading">Add a reply</h3>
                        <FormKit type="text" label="Title" name="title" />
                        <FormKit type="textarea" label="Body" name="body"
                    /></FormKit>
                </tab-panel-transition>
            </template>
        </tabs-wrapper>
    </modal>
</template>

<script setup>
import tabPanelTransition from "../transitions/TabPanelTransition.vue";
import { ref } from "vue";
import axiosClient from "../../../axios";
import useModals from "../../stores/modals";
import TabsWrapper from "../TabsWrapper.vue";
// import Tab from "../Tab.vue";
import ShowMessages from "../ShowMessages.vue";
import modal from "../Modal.vue";

const tabWrapper = ref();
const modals = useModals();
const messageThread = ref({});
const trackMessage = ref("");
const trackMessageErrors = ref(null);

const reply = ref({
    title: "",
    body: "",
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

    tabWrapper.value.previousTab();
};

const trackMessageThread = async () => {
    await getMessageThread();
    tabWrapper.value.nextTab();
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
</script>

<style lang="scss" scoped>
@use "../../abstracts" as *;

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
</style>
