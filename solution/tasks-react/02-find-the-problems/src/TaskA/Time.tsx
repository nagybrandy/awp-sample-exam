type TimeParts = { hour: number; minute: number; second: number }

type Props = {
  showSeconds: boolean
  time: TimeParts
}

export const Time = ({ showSeconds, time: { hour, minute, second } }: Props) => {
  return (
    <>
      {hour}:{minute.toString().padStart(2, '0')}
      {showSeconds && <>:{second.toString().padStart(2, '0')}</>}
    </>
  )
}
