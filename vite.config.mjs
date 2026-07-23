import { defineConfig } from 'vite';
import tailwindcss from "@tailwindcss/vite";
import copy from 'rollup-plugin-copy';
import manifestSRI from 'vite-plugin-manifest-sri';
import path from 'path';
import viteCompression from 'vite-plugin-compression';
import fullReload from 'vite-plugin-full-reload';
import removeConsole from 'vite-plugin-remove-console';


// https://vite.dev/config/
export default defineConfig(({command}) => ({
    base: command === 'serve' ? '' : '/dist/',
    build: {
        manifest: true,
        outDir: path.resolve(__dirname, 'web/dist/'),
        sourcemap: true,
        // Vite 8 uses Rolldown
        rolldownOptions: {
            input: {
                app: path.resolve(__dirname, 'src/js/app.js'),
                platform: path.resolve(__dirname, 'src/js/platform.js'),
            },
            output: {
                // The `manualChunks` function form is deprecated in Rolldown.
                // Use `advancedChunks.groups` with a regex `test` per chunk.
                advancedChunks: {
                    groups: [
                        { name: 'al', test: /alpine/ },
                        { name: 'gsap', test: /gsap/ },
                    ],
                },
            },
            // Build-only plugins. Comment stripping and JS compression are
            // now handled by Rolldown's built-in Oxc minifier (was terser),
            // so only console removal remains here.
            plugins: [
                removeConsole(),
            ],
        },
    },
    oxc: {
        jsx: {
            runtime: 'classic',
            pragma: 'h',
            pragmaFrag: 'Fragment',
        },
        include: [
            // Business-as-usual behaviour for .jsx files
            "src/js/**/*.jsx",

            // Allow all .js files to contain JSX
            "src/js/**/*.js",
        ],
        exclude: [],
    },
    plugins: [
        copy({
            targets: [
                {
                    src: 'src/static/*',
                    dest: 'web/dist'
                },
                {
                    src: 'web/assets/graphics/**/*',
                    dest: 'web/dist/graphics'
                }
            ],
            hook: 'writeBundle'
        }),
        manifestSRI(),
        tailwindcss(),
        viteCompression({
            filter: /\.(js|mjs|json|css|map)$/i
        }),
        // Full page reload when server-rendered Twig templates change
        // (they are not part of Vite's module graph).
        fullReload([
            'templates/**/*',
        ]),
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
        allowedHosts: true,
        cors: true,
        fs: {
            strict: false,
        },
        headers: {
            "Access-Control-Allow-Private-Network": "true",
        },
        host: "0.0.0.0",
        origin: "http://localhost:3000",
        port: 3000,
        strictPort: true,
    },
}));
