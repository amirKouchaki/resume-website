import { createApp } from "vue";
import "./style.scss";
import App from "./App.vue";
import { createPinia } from "pinia";
import router from "./router";

const pinia = createPinia();

const app = createApp(App);

app.directive("modal-click-away", {
    mounted: (el, bindings) => {
        document.addEventListener("click", (e) => {
            const modal =
                document.getElementsByClassName("modal-background")[0];
            if (
                el !== null &&
                el.contains(e.target) === false &&
                e.target === modal
            ) {
                bindings.value();
            }
        });
    },
});

app.use(router).use(pinia).mount("#app");
