import {defineConfig} from 'vite';
import copy from 'rollup-plugin-copy';
import manifestSRI from 'vite-plugin-manifest-sri';
import path from 'path';
import terser from '@rollup/plugin-terser';
import viteCompression from 'vite-plugin-compression';
import ViteRestart from 'vite-plugin-restart';
import removeConsole from 'vite-plugin-remove-console';

// https://vitejs.dev/config/
export default defineConfig(({command}) => ({
    base: command === 'serve' ? '' : '/dist/',
    build: {
        commonjsOptions: {
            transformMixedEsModules: true,
        },
        manifest: true,
        outDir: path.resolve(__dirname, 'web/dist/'),
        rollupOptions: {
            input: {
                platform: path.resolve(__dirname, 'src/js/platform.js'),
                app: path.resolve(__dirname, 'src/js/app.js'),
            },
            output: {
                sourcemap: true
            },
            plugins: [
                // Used to remove comments from JS files
                terser({
                    format: {
                        // Remove all comments
                        comments: false
                    },
                    // Prevent any compression
                    compress: false
                }),
                removeConsole()
            ],
        },
    },
    plugins: [
        copy({
            targets: [
                {
                    src: 'web/assets/graphics/**/*',
                    dest: 'web/dist/graphics'
                }
            ],
            hook: 'writeBundle'
        }),
        manifestSRI(),
        viteCompression({
            filter: /\.(js|mjs|json|css|map)$/i
        }),
        ViteRestart({
            reload: [
                'templates/**/*',
            ],
        }),
    ],
    publicDir: path.resolve(__dirname, 'src/public'),
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'src'),
            '@css': path.resolve(__dirname, 'src/pcss'),
            '@js': path.resolve(__dirname, 'src/js'),
        },
    },
    server: {
        fs: {
            strict: false
        },
        host: '0.0.0.0',
        origin: 'http://localhost:3000',
        port: 3000,
        strictPort: true,
    },
}));
