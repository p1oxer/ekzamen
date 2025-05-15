import { useState } from "react";

function App() {
    const [count, setCount] = useState(0);

    return (
        <div style={{ textAlign: "center", marginTop: "100px" }}>
            <h1>Счётчик</h1>
            <button
                onClick={() => setCount(count - 1)}
                style={{ fontSize: "24px", margin: "0 10px" }}
            >
                -1
            </button>
            <span style={{ fontSize: "24px", margin: "0 20px" }}>{count}</span>
            <button
                onClick={() => setCount(count + 1)}
                style={{ fontSize: "24px", margin: "0 10px" }}
            >
                +1
            </button>
        </div>
    );
}

export default App;
