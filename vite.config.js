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
    rollupOptions: {
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
      ],
    },
  },
  // This line helps Vite generate correct base paths
  base: '/build/',
});
