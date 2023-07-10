<template>
    <h1>dashboard</h1>
    {{ user }}

    <button @click="logout">logout</button>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref, watch } from "vue";
import axiosClient from "../../axios";
import useAuthentication from "../stores/authentication";
import { useMutation } from "@tanstack/vue-query";
import { useRouter } from "vue-router";

const router = useRouter();
const authentication = useAuthentication();
const user = ref({});
const getUser = async () => {
    try {
        const res = await axiosClient.get("api/user");
        user.value = res.data;
    } catch (error) {
        console.log(authentication.authenticated);
        console.log(error.response.data);
    }
};

const { isSuccess, data, mutate } = useMutation({
    mutationFn: () => {
        axiosClient.post("logout");
    },
});

const logout = () => {
    mutate();
};

onMounted(() => {
    getUser();
});

watch(isSuccess, () => {
    if (isSuccess.value) {
        authentication.setAuthenticated(false);
        router.push({ name: "resume" });
    }
});
</script>

<style></style>
