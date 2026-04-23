import type { WeatherCity } from './data/weather'

type Props = {
  weatherList: WeatherCity[]
  handleCityChange: (id: number) => void
}

const CitiesList = ({ weatherList, handleCityChange }: Props) => {
  return (
    <ul className="mt-20 flex flex-row gap-5" id="citiesList">
      {weatherList.map((weather) => (
        <li
          key={weather.id}
          onClick={() => handleCityChange(weather.id)}
          className="cursor-pointer select-none rounded-lg bg-blue-500 p-2 text-lg text-white shadow-lg transition-transform hover:scale-105"
        >
          {weather.name}
        </li>
      ))}
    </ul>
  )
}

export default CitiesList
