import { createApp } from "vue";
import "./style.scss";
import "./formkit-style.scss";
import "@formkit/themes/genesis";
import App from "./App.vue";
import { createPinia } from "pinia";
import router from "./router";
import Particles from "vue3-particles";
import { plugin } from "@formkit/vue";
import config from "../formkit.config";
import Toast from "vue-toastification";
import { VueQueryPlugin } from "@tanstack/vue-query";
import "vue-toastification/dist/index.css";
import { register } from "swiper/element/bundle";
import { Quasar } from "quasar";
import "@quasar/extras/material-icons/material-icons.css";
import "quasar/src/css/index.sass";
register();

const toastificationOptions = {
    transition: "Vue-Toastification__fade",
    maxToasts: 4,
    newestOnTop: true,
};

const pinia = createPinia();

const app = createApp(App);
app.directive("modal-click-away", {
    mounted: (el, bindings) => {
        document.addEventListener("click", (e) => {
            if (
                el !== null &&
                el.contains(e.target) === false &&
                e.target === el.parentNode
            ) {
                bindings.value();
            }
        });
    },
});

app.use(plugin, config)
    .use(pinia)
    .use(router)
    .use(Particles)
    .use(VueQueryPlugin)
    .use(Toast, toastificationOptions)
    .use(Quasar, {
        plugins: {},
    })
    .mount("#app");

export default { pinia, router, app };
