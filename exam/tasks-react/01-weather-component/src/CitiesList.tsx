import type { WeatherCity } from './data/weather'

type Props = {
  weatherList: WeatherCity[]
  handleCityChange: (id: number) => void
}

const CitiesList = ({ weatherList, handleCityChange }: Props) => {
  void weatherList
  void handleCityChange
  // TODO: render cities from `weatherList`
  // TODO: on city click, call `handleCityChange(id)`
  return (
    <ul className="mt-20 flex flex-row gap-5" id="citiesList">
      <li className="cursor-pointer select-none rounded-lg bg-blue-500 p-2 text-lg text-white shadow-lg transition-transform hover:scale-105">
        Budapest
      </li>
    </ul>
  )
}

export default CitiesList
