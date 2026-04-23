import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// If the API runs on another port (e.g. PORT=4011), start Vite with:
// HOLIDAYS_API_PROXY_TARGET=http://127.0.0.1:4011 npm run dev
const holidaysApiProxyTarget =
  process.env.HOLIDAYS_API_PROXY_TARGET ?? 'http://127.0.0.1:4010'

// https://vite.dev/config/
export default defineConfig({
  plugins: [react()],
  server: {
    proxy: {
      '/api': {
        target: holidaysApiProxyTarget,
        changeOrigin: true,
      },
    },
  },
})
