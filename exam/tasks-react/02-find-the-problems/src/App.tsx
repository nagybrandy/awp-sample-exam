import './App.css'
import { TaskA } from './TaskA/TaskA'
import { TaskB } from './TaskB/TaskB'

function App() {
  return (
    <div className="task-app">
      <TaskA />
      <hr />
      <TaskB />
    </div>
  )
}

export default App
