import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [vue()],
  server: {
    host: true,  // Enables access from outside the container
    watch: {
      usePolling: true, // Ensures file changes are detected inside Docker
    },
  },
});
