import { defineConfig } from 'vite';
import php from 'vite-plugin-php';
import sass from 'sass';

export default defineConfig({
  plugins: [php()],
  base: "/haie-vigne",
  css: {
    preprocessorOptions: {
      scss: {
        implementation: sass,
      },
    },
  },
  build: {
    manifest: true,
    outDir: "dist",
    rollupOptions: {
      input: ["./src/main.js", "./js/burger.js", "./js/activity.js", "./js/slider.js"],
      plugins: [php()],
    },
  },server: {
    port: 8080,
    host: '127.0.0.1'
},
  
  logLevel: 'info', 
  
});

