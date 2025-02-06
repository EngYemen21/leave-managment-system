import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'], // تأكد من إضافة ملفات CSS وJS هنا
            refresh: true,
        }),
    ],
});
