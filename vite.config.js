import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
    build: {
        // Specify the output directory for the built files
        outDir: 'public/styles',
        assetsDir: 'css',
        // Specify fixed filenames for the output JavaScript and CSS files
        rollupOptions: {
            output: {
                entryFileNames: 'js/app.js',
                chunkFileNames: 'js/[name].js',
                assetFileNames: 'css/app.css',
            },
        },
        cssCodeSplit: false,
        minify: 'esbuild',
    },
});
