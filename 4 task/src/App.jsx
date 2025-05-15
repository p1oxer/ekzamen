import { useState, useEffect } from "react";
import axios from "axios";
import "./App.css";

function App() {
    const [fromCurrency, setFromCurrency] = useState("USD");
    const [toCurrency, setToCurrency] = useState("RUB");
    const [amount, setAmount] = useState(1);
    const [convertedAmount, setConvertedAmount] = useState(0);
    const [rates, setRates] = useState({});

    // Получаем курсы валют
    useEffect(() => {
        async function fetchRates() {
            try {
                const response = await axios.get(
                    "https://api.exchangerate-api.com/v4/latest/USD "
                );
                setRates(response.data.rates);
            } catch (error) {
                console.error("Ошибка загрузки курсов:", error);
            }
        }

        fetchRates();
    }, []);

    // Конвертируем валюты
    useEffect(() => {
        if (!rates[toCurrency]) return;

        const rate = rates[toCurrency];
        setConvertedAmount(amount * rate);
    }, [amount, fromCurrency, toCurrency, rates]);

    return (
        <div className="App">
            <h1>Конвертер валют</h1>
            <div
                style={{
                    display: "flex",
                    flexDirection: "column",
                    maxWidth: "300px",
                    margin: "auto",
                }}
            >
                <input
                    type="number"
                    value={amount}
                    onChange={(e) => setAmount(Number(e.target.value))}
                    style={{ marginBottom: "10px", padding: "8px" }}
                />

                <select
                    value={toCurrency}
                    onChange={(e) => setToCurrency(e.target.value)}
                    style={{ marginBottom: "10px", padding: "8px" }}
                >
                    <option value="RUB">RUB</option>
                    <option value="USD">USD</option>
                </select>

                <h2>
                    {convertedAmount.toFixed(2)} {toCurrency}
                </h2>
            </div>
        </div>
    );
}

export default App;
