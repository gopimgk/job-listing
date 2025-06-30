import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  build: {
    manifest: true,
    outDir: 'public/build',
    emptyOutDir: true,
    rollupOptions: {
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
      ],
      output: {
        entryFileNames: 'assets/[name]-[hash].js',
        chunkFileNames: 'assets/[name]-[hash].js',
        assetFileNames: 'assets/[name]-[hash][extname]',
      },
    },
  },
  // 🔥 This is crucial for Vite 6: disable experimental features
  experimental: {
    renderBuiltUrl(filename, { hostType }) {
      return `/build/assets/${filename}`;
    }
  },
  base: '/build/',
});
