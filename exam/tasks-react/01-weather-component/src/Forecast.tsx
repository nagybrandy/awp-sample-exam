import type { WeatherCity } from './data/weather'

type Props = {
  cityData: WeatherCity | null
}

const Forecast = (props: Props) => {
  void props
  return (
    <div className="mt-20 flex scale-125 items-center justify-center rounded-lg bg-white p-10 shadow-lg">
      <div className="flex flex-col">
        <p className="text-gray-500">TODO: show selected city (name, temp, humidity, wind, condition, icon).</p>
        <p className="text-gray-500">TODO: °C / °F toggle with local state (radio group id tempUnitChanger).</p>
      </div>
    </div>
  )
}

export default Forecast
