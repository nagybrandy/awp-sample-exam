import { useEffect, useState } from 'react'
import { Link, useParams } from 'react-router-dom'
import { holidaysEndpoint } from './holidaysApi'
import type { HolidayRow } from './types'

export function Holidays() {
  const { countryCode } = useParams()
  const [holidays, setHolidays] = useState<HolidayRow[]>([])
  const [year, setYear] = useState(2023)

  useEffect(() => {
    if (!countryCode) {
      setHolidays([])
      return
    }
    void (async () => {
      // TODO: Fetch holidays from the Fastify API (same server as countries). Use holidaysEndpoint(countryCode, year).
      void holidaysEndpoint
      void year
      setHolidays([])
    })()
  }, [year, countryCode])

  return (
    <>
      <Link to="/">Back</Link>
      <table>
        <thead>
          <tr>
            <th>Holidays</th>
            <th>
              <input
                type="number"
                value={year}
                onChange={(e) => setYear(Number(e.target.value) || year)}
              />
            </th>
          </tr>
        </thead>
        <tbody>
          {holidays.map((holiday, i) => (
            <tr key={`${holiday.date}-${i}`}>
              <td>{holiday.date}</td>
              <td>{holiday.name}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </>
  )
}
