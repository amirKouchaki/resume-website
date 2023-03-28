import { defineStore } from "pinia";

const useModals = defineStore("modals", {
    state: () => {
        return {
            showMessageThreadModal: false,
            showTrackMessageModal: false,
        };
    },
    getters: {},
    actions: {
        toggleMessageModal() {
            document.body.classList.toggle("ov-hid");
            this.showMessageThreadModal = !this.showMessageThreadModal;
        },
        toggleTrackMessageModal() {
            document.body.classList.toggle("ov-hid");
            this.showTrackMessageModal = !this.showTrackMessageModal;
        },
    },
});

export default useModals;
