import { useState } from "react";
import "./App.css";

function App() {
    const [tasks, setTasks] = useState([]);
    const [inputValue, setInputValue] = useState("");

    function addTask() {
        if (inputValue.trim() == "") return;

        const task = {
            id: Date.now(),
            name: inputValue,
            isCompleted: false,
        };

        setTasks([...tasks, task]);
        setInputValue("");
    }

    function deleteTask(id) {
        setTasks(tasks.filter((task) => task.id !== id));
    }

    function toggleComplete(id) {
        setTasks(
            tasks.map((task) => {
                return task.id == id ? { ...task, isCompleted: !task.isCompleted } : task;
            })
        );
    }
    return (
        <>
            <input
                type="text"
                value={inputValue}
                onChange={(e => setInputValue(e.target.value))}
            />
            <button type="button" onClick={addTask}>
                Добавить
            </button>
            <ul>
                {tasks.map((task) => {
                    return (
                        <li className={task.isCompleted ? "completed" : ""} key={task.id}>
                            <p>{task.name}</p>
                            <button type="button" onClick={() => deleteTask(task.id)}>
                                Удалить
                            </button>
                            <button type="button" onClick={() => toggleComplete(task.id)}>
                                Завершить
                            </button>
                        </li>
                    );
                })}
            </ul>
        </>
    );
}

export default App;
