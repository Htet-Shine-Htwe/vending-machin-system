import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'public/js/user/cart.js',
                'public/js/user/cart-ui.js',
            ],
            refresh: true,
        }),
    ],
});
