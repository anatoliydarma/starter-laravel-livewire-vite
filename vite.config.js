import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    build: {
        sourcemap: true,
    },
    plugins: [
        laravel({
            input: [
                "resources/css/web.css",
                "resources/js/web.js",
                "resources/css/dashboard.css",
                "resources/js/dashboard.js",
            ],
            refresh: true,
        }),
    ],
});
