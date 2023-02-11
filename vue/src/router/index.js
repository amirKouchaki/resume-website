import { createRouter, createWebHistory } from "vue-router";
import Resume from "../views/Resume.vue";
const routes = [
    {
        path: "/",
        name: "resume",
        component: Resume,
        meta: {
            title: "resume",
        },
    },
    { path: "/:pathMatch(.*)*", redirect: { name: "resume" } },
];

const router = createRouter({
    history: createWebHistory("resume-website"),
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
