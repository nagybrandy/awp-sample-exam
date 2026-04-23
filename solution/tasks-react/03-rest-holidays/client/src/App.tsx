import { useEffect, useState } from 'react'
import { Link, Outlet } from 'react-router-dom'
import './App.css'
import { countriesEndpoint } from './holidaysApi'
import type { Country } from './types'

function App() {
  const [countries, setCountries] = useState<Country[]>([])

  useEffect(() => {
    void fetch(countriesEndpoint())
      .then((r) => {
        if (!r.ok) {
          throw new Error(`countries ${r.status}`)
        }
        return r.json() as Promise<Country[]>
      })
      .then(setCountries)
      .catch(() => setCountries([]))
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
