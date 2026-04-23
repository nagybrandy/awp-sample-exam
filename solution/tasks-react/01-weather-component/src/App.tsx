import { useState } from 'react'
import CitiesList from './CitiesList'
import Forecast from './Forecast'
import { weatherList, type WeatherCity } from './data/weather'

function App() {
  const [selectedCity, setSelectedCity] = useState<WeatherCity>(weatherList[0])

  const handleCityChange = (id: number) => {
    const next = weatherList.find((city) => city.id === id)
    if (next) {
      setSelectedCity(next)
    }
  }

  return (
    <div className="flex w-full flex-col items-center">
      <h1 className="text-5xl text-blue-700">Weather</h1>
      <CitiesList weatherList={weatherList} handleCityChange={handleCityChange} />
      <Forecast cityData={selectedCity} />
    </div>
  )
}

export default App
