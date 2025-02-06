import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js', 
                'resources/js/dark-mode.js',
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/css/dark-mode.css'
            ],
            refresh: true,
        }),
    ],
});
