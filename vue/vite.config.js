import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import svgLoader from "vite-svg-loader";
import { fileURLToPath } from "url";
import path from "path";
// https://vitejs.dev/config/
export default defineConfig({
    base: process.env.NODE_ENV === "production" ? "/" : "/",
    plugins: [
        vue({
            script: {
                defineModel: true,
            },
        }),
        svgLoader(),
    ],

    resolve: {
        alias: {
            "@/": `${path.resolve(__dirname, "src")}/`,
        },
    },
});
