import { defineStore } from "pinia";

const useAuthentication = defineStore("authentication", {
    state: () => {
        return {
            authenticated:
                sessionStorage.getItem("AUTHENTICATION_STATUS") ?? false,
        };
    },
    getters: {
        isAuthenticated() {
            return this.authenticated;
        },
    },
    actions: {
        setAuthenticated(authStatus) {
            this.authenticated = authStatus;
            if (authStatus == true)
                sessionStorage.setItem("AUTHENTICATION_STATUS", authStatus);
            else sessionStorage.removeItem("AUTHENTICATION_STATUS");
        },
    },
});

export default useAuthentication;
