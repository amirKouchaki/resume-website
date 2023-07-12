import { useQuery } from "@tanstack/vue-query";
import axiosClient from "../../axios";

export const createMessageThreadReq = (payload) =>
    axiosClient.post("/api/messageThread", payload);

export const showMessageThreadReq = ({ queryKey }) =>
    // console.log(messageThreadId);
    axiosClient.get(`/api/messageThread/${queryKey[1]}`);

export const replyToMessageThreadReq = (payload) =>
    axiosClient.post(`/api/messageThread/${payload.messageThreadId}/reply`, {
        title: payload.reply.title,
        body: payload.reply.body,
    });
