import { createRouter, createWebHistory } from "vue-router";
import Resume from "../views/Resume.vue";
import SocialAuthCallback from "../views/SocialAuthCallback.vue";
import ResetPassword from "../views/ResetPassword.vue";
import Dashboard from "../views/Dashboard.vue";
import DefaultFavIcon from "../assets/favicons/default-logo.png";
import middlewares from "./middlewares";
const routes = [
    // {
    //     path: "/dashboard",
    //     name: "dashboard",
    //     component: Dashboard,
    //     beforeEnter: middlewares.auth,
    // },
    {
        path: "/",
        name: "resume",
        component: Resume,
        meta: {
            title: "resume",
            favIcon: DefaultFavIcon,
        },
        beforeEnter: middlewares.guest,
    },
    // {
    //     path: "/oauth/:provider/callback",
    //     name: "oauth.callback",
    //     component: SocialAuthCallback,
    //     beforeEnter: middlewares.guest,
    // },
    // {
    //     path: "/reset-password",
    //     name: "password.reset",
    //     component: ResetPassword,
    //     beforeEnter: middlewares.guest,
    // },
    { path: "/:pathMatch(.*)*", redirect: { name: "resume" } },
];

const router = createRouter({
    base: import.meta.env.VITE_BASE_URL,
    history: createWebHistory(import.meta.env.VITE_BASE_URL),
    routes,
});

router.beforeEach((to, from, next) => {
    const title = to.meta.title;
    if (title) {
        document.title = title;
    }

    const link =
        document.querySelector("link[rel*='icon']") ||
        document.createElement("link");
    link.type = "image/x-icon";
    link.rel = "shortcut icon";
    link.href = to.meta.favIcon;
    document.getElementsByTagName("head")[0].appendChild(link);
    next();
});

export default router;
