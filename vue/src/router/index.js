import { createRouter, createWebHistory } from "vue-router";
import Resume from "../views/Resume.vue";
const routes = [
    {
        path: "/resume",
        name: "resume",
        component: Resume,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
