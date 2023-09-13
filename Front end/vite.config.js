// vite.config.js
import { resolve } from 'path'
import { defineConfig } from 'vite'

export default defineConfig({
  build: {
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'index.html'),
        contacts: resolve(__dirname, 'contacts.html'),
        register: resolve(__dirname, 'register.html'),
        colormodes: resolve(__dirname, 'color-modes.js'),
        // bootstrap: path.resolve(__dirname, 'assets')
        // '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),

      },
    },
  },
})