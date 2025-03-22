import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/dark-mode.js',
        'resources/js/showcase.js'
      ],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      '~fonts': path.resolve(__dirname, 'resources/assets/fonts'),
    },
  },
});
