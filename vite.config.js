import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin'
 
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
    build: {
        outDir: './public/css/app'
    },
    // build: {
    //     rollupOptions: {
    //       input: {
    //         main: resolve(__dirname, 'resources/css/app.css'),
    //         nested: resolve(__dirname, 'public/css/app.css'),
    //       },
    //     },
    //   },
})