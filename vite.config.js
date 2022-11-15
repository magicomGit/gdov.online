import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/custom.css',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/trix.css',
                'resources/js/trix.js',
            ],
            refresh: true,
        }),
    ],
});
