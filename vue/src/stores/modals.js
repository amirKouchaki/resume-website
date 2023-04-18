import { defineStore } from "pinia";

const useModals = defineStore("modals", {
    state: () => {
        return {
            showMessageThreadModal: false,
            showTrackMessageModal: false,
            showMobileSidebar: false,
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
        toggleSidebar() {
            this.showMobileSidebar = !this.showMobileSidebar;
            this.updateScrollStatus(this.showMobileSidebar);
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
