import { defineStore } from "pinia";

const useModals = defineStore("modals", {
    state: () => {
        return {
            showMessageThreadModal: false,
            showTrackMessageModal: false,
            showAuthModal: false,
        };
    },
    getters: {},
    actions: {
        toggleMessageModal() {
            this.showMessageThreadModal = !this.showMessageThreadModal;
            this.updateScrollStatus(this.showMessageThreadModal);
        },
        toggleTrackMessageModal() {
            this.showTrackMessageModal = !this.showTrackMessageModal;
            this.updateScrollStatus(this.showTrackMessageModal);
        },
        toggleAuthModal() {
            this.showAuthModal = !this.showAuthModal;
            this.updateScrollStatus(this.showAuthMessageModal);
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
