import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import { BrowserRouter, Route, Routes } from 'react-router-dom'
import './index.css'
import App from './App.tsx'
// TODO (R3.e): import the Holidays component and add a nested route below.
// import { Holidays } from './Holidays.tsx'

createRoot(document.getElementById('root')!).render(
  <StrictMode>
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<App />}>
          {/* TODO (R3.e): Add a nested child route at path=":countryCode" rendering <Holidays />.
              The parent <App /> already renders an <Outlet /> for the child. */}
        </Route>
      </Routes>
    </BrowserRouter>
  </StrictMode>,
)
