import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';          // ← add this import

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/scss/index.scss',
                'resources/scss/home.scss',
                'resources/scss/about_us.scss',
                'resources/scss/contact.scss',
            ],
            buildDirectory: 'dist',  // Tell Laravel plugin the build directory
            refresh: true,
        }),
    ],

    build: {
        outDir: resolve(__dirname, 'public/dist'),   // forces output to public/dist
        emptyOutDir: true,
        manifest: true,       // Laravel needs this
        rollupOptions: {
            output: {
                // optional: nicer file names
                assetFileNames: 'assets/[name].[hash][extname]',
                chunkFileNames: 'assets/[name].[hash].js',
                entryFileNames: 'assets/[name].[hash].js',
            },
        },
    },
});