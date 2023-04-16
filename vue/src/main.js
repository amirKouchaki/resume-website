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

app.use(router).use(plugin, config).use(pinia).use(Particles).mount("#app");
