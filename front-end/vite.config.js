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
        mainjs: resolve(__dirname, 'main.js')
        
      },
    },
  },
})