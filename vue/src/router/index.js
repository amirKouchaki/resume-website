import { createRouter, createWebHistory } from "vue-router";
import Resume from "../views/Resume.vue";
import SocialAuthCallback from "../views/SocialAuthCallback.vue";
import Dashboard from "../views/Dashboard.vue";
import middlewares from "./middlewares";
const routes = [
    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
        beforeEnter: middlewares.auth,
    },
    {
        path: "/",
        name: "resume",
        component: Resume,
        meta: {
            title: "resume",
        },
        beforeEnter: middlewares.guest,
    },
    {
        path: "/oauth/:provider/callback",
        name: "oauth.callback",
        component: SocialAuthCallback,
        beforeEnter: middlewares.guest,
    },
    { path: "/:pathMatch(.*)*", redirect: { name: "resume" } },
];

const router = createRouter({
    base: import.meta.env.VITE_BASE_URL,
    history: createWebHistory(import.meta.env.VITE_BASE_URL),
    routes,
});

router.beforeEach((to, from, next) => {
    // Get the page title from the route meta data that we have defined
    // See further down below for how we setup this data
    const title = to.meta.title;

    //Take the title from the parameters
    const titleFromParams = to.params.pageTitle;
    // If the route has a title, set it as the page title of the document/page
    if (title) {
        document.title = title;
    }
    // If we have a title from the params, extend the title with the title
    // from our params
    if (titleFromParams) {
        document.title = `${titleFromParams} - ${document.title}`;
    }
    // Continue resolving the route
    next();
});

export default router;
