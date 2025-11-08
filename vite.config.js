import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// Removed tailwindcss import - application uses Bootstrap 5 via CDN

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        // Removed tailwindcss() plugin - not used in this application
    ],
});
