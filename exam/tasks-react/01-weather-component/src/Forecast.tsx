import { useState } from 'react'
import type { WeatherCity } from './data/weather'

type Props = {
  cityData: WeatherCity | null
}

const Forecast = ({ cityData }: Props) => {
  void cityData

  const handleUnitChange = (_e: React.ChangeEvent<HTMLInputElement>) => {
    // TODO: set local state from the radio input
  }

  return (
    <div className="mt-20 flex scale-125 items-center justify-center rounded-lg bg-white p-10 shadow-lg">
      <div className="flex flex-col">
        <div className="flex flex-row">
          <h2 className="text-2xl font-medium text-blue-500">
            {'Budapest' /* TODO: show the selected city name */}
          </h2>
          <div id="tempUnitChanger" className="ml-auto">
            <div className="inline-flex">
              <div className="switch-field">
                <input
                  type="radio"
                  id="radio-one"
                  name="tempUnitChanger"
                  value="F"
                  checked={
                    false /* TODO: true when F is the selected unit */
                  }
                  onChange={handleUnitChange}
                />
                <label htmlFor="radio-one">F</label>
                <input
                  type="radio"
                  id="radio-two"
                  name="tempUnitChanger"
                  checked={
                    true /* TODO: true when C is the selected unit */
                  }
                  value="C"
                  onChange={handleUnitChange}
                />
                <label htmlFor="radio-two">C</label>
              </div>
            </div>
          </div>
        </div>
        <div className="flex flex-row justify-center gap-20">
          <div className="flex flex-col">
            <div className="flex flex-row items-center gap-5">
              <img
                src={
                  '/assets/rainy.png' /* TODO: use the selected city's iconURL */
                }
                alt="weathericon"
                className="w-20"
              />
              <span className="text-9xl text-blue-400">
                20
                {/* TODO: show temperature in the selected unit */}
                °
              </span>
            </div>
          </div>
          <table className="w-1/2 text-blue-400">
            <tbody>
              <tr>
                <td>Wind:</td>
                <td className="text-right">
                  {'69' /* TODO: show wind speed */} km/h
                </td>
              </tr>
              <tr>
                <td>Humidity:</td>
                <td className="text-right">
                  {'100' /* TODO: show humidity */}%
                </td>
              </tr>
              <tr>
                <td>Condition:</td>
                <td className="text-right">
                  {'Cloudy' /* TODO: show weather condition */}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  )
}

export default Forecast
