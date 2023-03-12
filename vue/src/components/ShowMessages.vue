<template>
    <article>
        <section class="messages">
            <section class="main-message message">
                <h4 class="main-message-heading">{{ thread.title }}</h4>
                <p class="main-message-body">{{ thread.body }}</p>
                <span></span>
            </section>
            <section
                class="message"
                :class="{ 'from-admin': reply.sender.is_admin }"
                v-for="(reply, index) in thread.replies"
                :key="index"
            >
                <h5>
                    {{ reply.title }}
                </h5>
                <p>{{ reply.body }}</p>
                <div class="message-info">
                    <span class="sender-name">{{ reply.sender.name }}</span>
                    <span class="message-time">{{ reply.created_at }}</span>
                </div>
            </section>
        </section>
    </article>
</template>

<script setup>
import MessageThreadModal from "./modals/MessageThreadModal.vue";

const props = defineProps({
    thread: Object,
});
</script>

<style lang="scss" scoped>
@use "../abstracts" as *;
.messages {
    display: flex;
    flex-direction: column;
    gap: 3em;
    padding-inline: 1.5em;
    height: clamp(10em, 50vh + 10em, 70em);
    overflow: scroll;
}

.message {
    margin-left: auto;
    max-width: 24em;
    padding-inline: 1.3em;
    padding-block: 0.7em 1.2em;
    border-radius: 0.7em;
    background-color: $main-color;
}

.from-admin {
    background-color: $secondary-bg-color;
    margin-right: auto;
    margin-left: 0 !important;
}

.message-info {
    margin-top: 1em;
    font-size: 0.8rem;
    display: flex;
    justify-content: space-between;
    color: $long-text-color;
}
</style>
