import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig(({ command, mode }) => {
  const isProduction = mode === 'production';
  
  return {
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
    build: {
      outDir: 'public/build',
      assetsDir: 'assets',
      // Add source map in development but not in production
      sourcemap: !isProduction,
      // Optimize build in production
      minify: isProduction,
      rollupOptions: {
        output: {
          manualChunks: {
            vendor: ['alpinejs']
          }
        }
      }
    },
    // Handle public directory files properly
    publicDir: 'public',
    // Force HTTPS protocol in production
    server: {
      https: isProduction,
    }
  };
});
