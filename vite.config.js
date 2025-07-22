import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources/js'),
            '~': resolve(__dirname, 'resources'),
        },
    },
    server: {
        host: 'localhost',
        port: 5174,
        strictPort: true,
        hmr: {
            host: 'localhost',
            overlay: false, // Disable the HMR error overlay
        },
    },
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    'vendor': ['vue', 'pinia', 'vue-router'],
                    'primevue': ['primevue', '@primeuix/themes'],
                    'utils': ['axios']
                },
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name.endsWith('.css')) {
                        return 'css/[name]-[hash][extname]';
                    }
                    return 'assets/[name]-[hash][extname]';
                }
            }
        },
        chunkSizeWarningLimit: 1000
    }
});
