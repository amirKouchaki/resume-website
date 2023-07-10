<template>
    <modal
        :show="modals.showSearchMessageModal"
        :close="modals.toggleSearchMessageModal"
    >
        <tabs-wrapper ref="tabWrapper" :tabs="tabs">
            <template #tab-panels>
                <tab-panel-transition>
                    <FormKit
                        type="form"
                        id="searchMessageThreadForm"
                        ref="searchMessageThreadForm"
                        @submit="activateMessageThreadSearch"
                        submit-label="Find Thread"
                    >
                        <h3 class="modal-form-heading">
                            Search Your messageThread
                        </h3>
                        <FormKit
                            type="text"
                            label="Thread code"
                            v-model="messageThreadId"
                            :value="messageThreadId"
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
                        <h3 class="modal-form-heading">Add a reply</h3>
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
import { computed, nextTick, onMounted, ref, watch } from "vue";
import useModals from "../../stores/modals";
import TabsWrapper from "../TabsWrapper.vue";
import ShowMessages from "../ShowMessages.vue";
import modal from "../Modal.vue";
import { useMutation, useQuery } from "@tanstack/vue-query";
import {
    showMessageThreadReq,
    replyToMessageThread,
} from "../../services/messageThread";
import { useRoute } from "vue-router";
import { updateRouteQuery } from "../../composables/routerHelper";
import { successToast } from "../../composables/toasts";

const route = useRoute();
const messageThreadKey = "messageThread";
const searchMessageThreadForm = ref(null);
const tabWrapper = ref();
const modals = useModals();
const messageThreadId = ref(route.query[messageThreadKey] ?? "");
const reply = ref({});
const searchMessageThreadSuccessFlag = ref(true);

const activateMessageThreadSearch = () => {
    console.log("activate");
    console.log("messageThread :" + messageThread?.value?.id);
    console.log("messageThreadId :" + messageThreadId.value);
    console.log(messageThread?.value?.id == messageThreadId.value);
    if (messageThread?.value?.id == messageThreadId.value) {
        tabWrapper.value.changeTabByTitle("show");
    } else {
        searchMessageThreadSuccessFlag.value = true;
        refetchMessageThread();
        updateRouteQuery(messageThreadKey, messageThreadId.value);
    }
};

const {
    error,
    mutate: mutateReply,
    isSuccess: replySuccess,
} = useMutation({
    mutationFn: replyToMessageThread,
});

const {
    data: messageThread,
    isSuccess: searchMessageThreadSuccess,
    refetch: refetchMessageThread,
} = useQuery({
    queryKey: [messageThreadKey, messageThreadId],
    queryFn: showMessageThreadReq,
    select: (res) => res.data,
    enabled: false,
});

const tabs = computed(() => [
    {
        title: "search",
        disabled: false,
    },
    {
        title: "show",
        disabled: !messageThread?.value,
    },
    {
        title: "reply",
        disabled: !messageThread?.value,
    },
]);

const addReply = () => {
    mutateReply({
        reply: reply.value,
        messageThreadId: messageThread.value.id,
    });
};

onMounted(() => {
    if (route.query.hasOwnProperty(messageThreadKey)) {
        refetchMessageThread();
    }
});

watch(searchMessageThreadSuccess, async () => {
    if (
        searchMessageThreadSuccess.value &&
        searchMessageThreadSuccessFlag.value &&
        tabWrapper.value
    ) {
        console.log("nextPageCauseOfSuccess");
        searchMessageThreadSuccessFlag.value = false;
        await nextTick();
        tabWrapper.value.changeTabByTitle("show");
    }
});

watch(replySuccess, () => {
    if (replySuccess.value) {
        refetchMessageThread();
        reply.value = {
            title: "",
            body: "",
        };

        successToast("Reply was added to your message thread successfully!");

        tabWrapper.value.changeTabByTitle("show");
    }
});
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
