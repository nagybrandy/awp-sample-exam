import type { WeatherCity } from './data/weather'

type Props = {
  weatherList: WeatherCity[]
  handleCityChange: (id: number) => void
}

const CitiesList = (props: Props) => {
  void props
  return (
    <ul className="mt-20 flex flex-row gap-5" id="citiesList">
      {/* TODO: render city names from `weatherList` (click → handleCityChange(id)) */}
    </ul>
  )
}

export default CitiesList
