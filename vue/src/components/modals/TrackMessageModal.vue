<template>
    <new-modals
        :show="modals.showTrackMessageModal"
        :close="modals.toggleTrackMessageModal"
    >
        <!-- <tabs-wrapper ref="tabWrapper" type="multi-page">
            <tab title="track">
                <FormKit
                    type="form"
                    @submit="trackMessageThread"
                    submit-label="Find Thread"
                >
                    <h3 class="modal-form-heading">Track Your message</h3>
                    <FormKit
                        type="number"
                        label="Thread code"
                        v-model="trackMessage"
                        validation="required|number|length:15,15"
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
                    <FormKit type="textarea" label="Body" name="body"
                /></FormKit>
            </tab>
        </tabs-wrapper> -->
        <new-tabs-wrapper>
            <template #tab-list>
                <tab-header>hello</tab-header>
                <tab-header>from</tab-header>
                <tab-header>reply</tab-header>
            </template>
            <template #tab-panels>
                <transition name="tab">
                    <tab-panel>
                        <FormKit
                            type="form"
                            @submit="trackMessageThread"
                            submit-label="Find Thread"
                        >
                            <h3 class="modal-form-heading">
                                Track Your message
                            </h3>
                            <FormKit
                                type="number"
                                label="Thread code"
                                v-model="trackMessage"
                                validation="required|number|length:15,15"
                            />
                        </FormKit> </tab-panel
                ></transition>
                <transition name="tab">
                    <tab-panel>
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
                    </tab-panel></transition
                >
                <transition name="tab">
                    <tab-panel>
                        <FormKit
                            type="form"
                            @submit="addReply"
                            submit-label="Add Reply"
                            v-model="reply"
                        >
                            <h3 class="contact-form-heading">Add a reply</h3>
                            <FormKit type="text" label="Title" name="title" />
                            <FormKit type="textarea" label="Body" name="body"
                        /></FormKit> </tab-panel
                ></transition>
            </template>
        </new-tabs-wrapper>
    </new-modals>
</template>

<script setup>
import { TabPanel } from "@headlessui/vue";
import NewTabsWrapper from "../tabs/NewTabsWrapper.vue";
import Modal from "../../components/Modal.vue";
import TabHeader from "../tabs/TabHeader.vue";
import { ref } from "vue";
import axiosClient from "../../../axios";
import useModals from "../../stores/modals";
import TabsWrapper from "../TabsWrapper.vue";
// import Tab from "../Tab.vue";
import ShowMessages from "../ShowMessages.vue";
import ModalTransition from "../transitions/ModalTransition.vue";
import NewModals from "../tabs/NewModals.vue";

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

.tab-enter-from,
.tab-leave-to {
    opacity: 0;
}

.tab-enter-active,
.tab-leave-active {
    transition: opacity 350ms ease-in-out;
}

.tab-enter-to,
.tab-leave-from {
    opacity: 1;
}
</style>
