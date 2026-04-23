import { useEffect, useState } from 'react'
import { Link, Outlet } from 'react-router-dom'
import './App.css'
import { countriesEndpoint } from './holidaysApi'
import type { Country } from './types'

function App() {
  const [countries, setCountries] = useState<Country[]>([])

  useEffect(() => {
    void (async () => {
      // TODO: Start `server` (see server/README.md). Fetch countries from the Fastify API:
      // const r = await fetch(countriesEndpoint()); if (!r.ok) throw …; setCountries(await r.json())
      void countriesEndpoint
      setCountries([])
    })()
  }, [])

  return (
    <>
      <div>
        <table>
          <thead>
            <tr>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
            {countries.map((country) => (
              <tr key={country.countryCode}>
                <td>
                  <Link to={country.countryCode}>
                    {country.name} ({country.countryCode})
                  </Link>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      <div>
        <Outlet />
      </div>
    </>
  )
}

export default App
