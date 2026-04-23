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
    void fetch(holidaysEndpoint(countryCode, year))
      .then((r) => {
        if (!r.ok) {
          throw new Error(`holidays ${r.status}`)
        }
        return r.json() as Promise<HolidayRow[]>
      })
      .then(setHolidays)
      .catch(() => setHolidays([]))
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
