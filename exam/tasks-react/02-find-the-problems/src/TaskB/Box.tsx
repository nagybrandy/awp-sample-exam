import { useState } from 'react'

type Props = {
  color: string
  x: number
  y: number
}

export const Box = (props: Props) => {
  const colorState = useState(props.color)
  const color = colorState[0]
  return (
    <div
      style={{
        position: 'absolute',
        top: `${props.y}px`,
        left: `${props.x}px`,
        backgroundColor: color,
        width: '100px',
        height: '100px',
      }}
    />
  )
}
