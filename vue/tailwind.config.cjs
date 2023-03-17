/** @type {import('tailwindcss').Config} */
const formKitTailwind = require("@formkit/themes/tailwindcss");
module.exports = {
    important: true,
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
        "./formkit.config.js",
    ],
    theme: {
        extend: {
            colors: {
                "main-color": "var(--main-color)",
                "main-bg-color": "var(--main-bg-color)",
                "main-modal-bg-color": "var(--main-modal-bg-color)",
                "main-modal-border-color": "var(--main-modal-border-color)",
                "main-text-color": "var(--main-text-color)",
                "secondary-bg-color": "var(--secondary-bg-color)",
                "fact-border-color": "var(--fact-border-color)",
                "o-main-text-color": "var(--o-main-text-color)",
                "secondary-text-color": "var(--secondary-text-color)",
                "long-text-color": "var(--long-text-color)",
                "link-color": "var(--link-color)",
                "active-link-color": "var(--active-link-color)",
                "hero-border-color": "var(--hero-border-color)",
                "main-button-border-color": "var(--main-button-border-color)",
                "secondary-button-border-color":
                    "var(--secondary-button-border-color)",
                "heading-underline-bg-color":
                    "var(--heading-underline-bg-color)",
                "heading-underline-main-color":
                    "var(--heading-underline-main-color)",
                "footer-bg-color": "var(--footer-bg-color)",
                "footer-border-color": "var(--footer-border-color)",
            },
        },
    },
    plugins: [formKitTailwind],
};
