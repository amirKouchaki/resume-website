import { defaultConfig } from "@formkit/vue";
import { createFloatingLabelsPlugin } from "@formkit/addons";
import "@formkit/addons/css/floatingLabels";
import { generateClasses } from "@formkit/themes";

const config = defaultConfig({
    plugins: [createFloatingLabelsPlugin({ useAsDefault: true })],
    config: {
        classes: generateClasses({
            global: {
                form: "my-formkit-form",
                outer: "my-formkit-outer",
                wrapper: "my-formkit-wrapper",
                label: "my-formkit-label",
                inner: "my-formkit-inner",
                input: "my-formkit-input",
                message: "my-formkit-message",
            },
        }),
    },
});
export default config;
