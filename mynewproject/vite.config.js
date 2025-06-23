import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/auth.css',
                'resources/css/forgot.css',
                'resources/css/dashboard.css',
                'resources/css/diplomes-section.css',
                'resources/css/competences-section.css',
                'resources/css/shared.css',
                'resources/css/profile-shared.css',
                'resources/js/app.js',
                'resources/js/profile.js',
                'resources/css/axes-section.css',
                'resources/css/domaines-section.css',
                'resources/css/sous-domaines-section.css',
                'resources/css/roles-section.css',
                'resources/css/questions-section.css',
                'resources/css/theme-formations-section.css',
                'resources/js/axes-section.js',
                'resources/js/domaines-section.js',
                'resources/js/sous-domaines-section.js',
                'resources/js/roles-section.js',
                'resources/js/questions-section.js',
                'resources/js/theme-formations-section.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
