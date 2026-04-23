import CitiesList from './CitiesList'
import Forecast from './Forecast'
import type { WeatherCity } from './data/weather'

function App() {
  // TODO: import `weatherList` from ./data/weather and pass it to CitiesList
  const weatherList: WeatherCity[] = []
  // TODO: keep selected city in state; default to first city in the list
  const selectedCity = null
  const handleCityChange = (_id: number) => {
    // TODO: update selected city by id
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
