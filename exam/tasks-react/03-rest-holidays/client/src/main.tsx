import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import App from './App.tsx'
// TODO (R3.e): import react-router-dom, the Holidays component, and set up nested routes
// (parent layout = App with country table + <Outlet />, child = :countryCode → Holidays).

createRoot(document.getElementById('root')!).render(
  <StrictMode>
    <App />
  </StrictMode>,
)
