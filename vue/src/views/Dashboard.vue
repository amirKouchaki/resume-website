<template>
    <h1>dashboard</h1>
    {{ user }}
</template>

<script setup>
import axios from "axios";
import { ref } from "vue";
import axiosClient from "../../axios";
import useAuthentication from "../stores/authentication";
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

getUser();
</script>

<style></style>
