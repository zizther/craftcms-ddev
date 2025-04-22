import {defineConfig, splitVendorChunkPlugin} from 'vite';
import tailwindcss from "@tailwindcss/vite";
import copy from 'rollup-plugin-copy';
import manifestSRI from 'vite-plugin-manifest-sri';
import path from 'path';
import { nodeResolve } from '@rollup/plugin-node-resolve';
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
        sourcemap: true,
        rollupOptions: {
            input: {
                app: path.resolve(__dirname, 'src/js/app.js'),
                platform: path.resolve(__dirname, 'src/js/platform.js'),
            },
            output: {
                manualChunks: function manualChunks(id) {
                    // console.log('====================');
                    // console.log({id});
                    // console.log('====================');

                    // Dependencies
                    if (id.includes('alpine')) {
                        return 'al';
                    }
                    if (id.includes('gsap')) {
                        return 'gsap';
                    }
                }
            },
            plugins: [
                tailwindcss(),
                // Used to remove comments from JS files
                terser({
                    format: {
                        // Remove all comments
                        comments: false
                    },
                    // Prevent any compression
                    compress: false
                }),
                removeConsole(),
                splitVendorChunkPlugin()
            ],
        },
    },
    esbuild: {
        loader: 'jsx',
        jsxFactory: 'h',
        jsxFragment: 'Fragment',
        include: [
            // Add this for business-as-usual behaviour for .jsx files
            "src/js/**/*.jsx",

            // Add these lines to allow all .js files to contain JSX
            "src/js/**/*.js",
        ],
        //include: /\.[jt]sx?$/, // Treats all combinations of .js, .jsx, .ts, and .tsx files as jsx
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
        nodeResolve(),
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
        allowedHosts: true,
        cors: true,
        fs: {
            strict: false
        },
        headers: {
            "Access-Control-Allow-Private-Network": "true",
        },
        host: '0.0.0.0',
        origin: 'http://localhost:3000',
        port: 3000,
        strictPort: true,
    },
}));
