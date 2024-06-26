import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import DefineOptions from 'unplugin-vue-define-options/vite';
import { defineConfig } from 'vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    build: {
        chunkSizeWarningLimit: 5000,
    },
    plugins: [
        viteStaticCopy({
            targets: [
                {
                    dest: 'assets',
                    src: 'resources/images',
                },
            ],
        }),
        laravel({
            input: 'resources/js/app.ts',
            refresh: true,
            ssr: 'resources/js/ssr.ts',
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        DefineOptions(),
    ],
    ssr: {
        noExternal: ['primevue'],
    },
});
