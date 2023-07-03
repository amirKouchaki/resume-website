<template>
    {{ $route.query }}
</template>

<script setup>
import { onMounted } from "vue";
import axiosClient from "../../axios";
import { useRoute, useRouter } from "vue-router";
import useAuthentication from "../stores/authentication";
const route = useRoute();
const router = useRouter();
const authentication = useAuthentication();
const getUser = async () => {
    try {
        const response = await axiosClient.get(
            `/oauth/${route.params.provider}/callback`,
            {
                params: route.query,
            }
        );
        if (response.data.success) {
            authentication.setAuthenticated(true);
            router.push({ name: "dashboard" });
        }
    } catch (e) {
        authentication.setAuthenticated(false);
        router.push({ name: "resume" });
    }
};
getUser();
</script>

<style></style>
