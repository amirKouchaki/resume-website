import { defineStore } from "pinia";

const useModals = defineStore("modals", {
    state: () => {
        return {
            showMessageThreadModal: false,
            showSearchMessageModal: false,
            showAuthModal: false,
        };
    },
    getters: {},
    actions: {
        toggleMessageModal() {
            this.showMessageThreadModal = !this.showMessageThreadModal;
            this.updateScrollStatus(this.showMessageThreadModal);
        },
        toggleSearchMessageModal() {
            this.showSearchMessageModal = !this.showSearchMessageModal;
            this.updateScrollStatus(this.showSearchMessageModal);
        },
        toggleAuthModal() {
            this.showAuthModal = !this.showAuthModal;
            this.updateScrollStatus(this.showAuthModal);
        },
        updateScrollStatus(visibilityStatus) {
            const doc = document.body.classList;
            visibilityStatus === false
                ? doc.remove("ov-hid")
                : doc.add("ov-hid");
        },
    },
});

export default useModals;
