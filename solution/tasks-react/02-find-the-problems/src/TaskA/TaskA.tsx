import { useState } from 'react'
import { Time } from './Time'

const initialTime = {
  hour: 15,
  minute: 0,
  second: 0,
}

export const TaskA = () => {
  const [clock, setClock] = useState({
    showSeconds: true,
    time: { ...initialTime },
  })

  const handleToggleShowSecond = () => {
    setClock((prev) => ({
      ...prev,
      showSeconds: !prev.showSeconds,
    }))
  }

  const handleAddFiveMinutes = () => {
    setClock((prev) => {
      const increasedMinute = prev.time.minute + 5
      const newMinute = increasedMinute % 60
      const extraHour = Math.floor(increasedMinute / 60)
      return {
        ...prev,
        time: {
          hour: prev.time.hour + extraHour,
          minute: newMinute,
          second: prev.time.second,
        },
      }
    })
  }

  return (
    <div>
      <h1>Task A</h1>

      <h2>Initial time</h2>
      <p>
        <Time showSeconds={true} time={initialTime} />
      </p>

      <h2>Modified time</h2>
      <p>
        <Time showSeconds={clock.showSeconds} time={clock.time} />
        <br />
        <button type="button" onClick={handleToggleShowSecond}>
          Toggle show seconds
        </button>
        <button type="button" onClick={handleAddFiveMinutes}>
          +5 minutes
        </button>
      </p>
    </div>
  )
}
