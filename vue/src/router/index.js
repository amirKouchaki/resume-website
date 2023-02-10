import { createRouter, createWebHistory } from "vue-router";
import Resume from "../views/Resume.vue";
const routes = [
    {
        name: "/",
        redirect: { name: "resume" },
    },
    {
        path: "/resume",
        name: "resume",
        component: Resume,
        meta: {
            title: "resume",
        },
    },
];

const router = createRouter({
    base: "/resume-website/",
    history: createWebHistory(),
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
