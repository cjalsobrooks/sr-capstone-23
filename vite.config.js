import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    server: {        
        host: 'site.test',
        https: { 
            key: '../../apache/ssl/site.test/server.key',
            cert: '../../apache/ssl/site.test/server.crt',
        }},

    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
