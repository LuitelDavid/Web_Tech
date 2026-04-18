<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Calculator - Lab 9</title>
    <style>
        :root {
            --primary-bg: #0f172a;
            --calc-bg: #1e293b;
            --card-bg: rgba(30, 41, 59, 0.7);
            --accent: #38bdf8;
            --text: #f1f5f9;
            --button-bg: #334155;
            --button-hover: #475569;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            color: var(--text);
            padding: 20px;
        }

        .main-container {
            display: flex;
            gap: 40px;
            align-items: flex-start;
            justify-content: center;
            width: 100%;
            max-width: 1000px;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        .calculator {
            width: 350px;
            border-radius: 24px;
            padding: 25px;
            background-color: var(--calc-bg);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        #display {
            width: 100%;
            height: 80px;
            background: rgba(15, 23, 42, 0.5);
            border: none;
            border-radius: 12px;
            font-size: 40px;
            text-align: right;
            padding: 10px 15px;
            margin-bottom: 25px;
            color: var(--accent);
            box-sizing: border-box;
            font-weight: 300;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        button {
            height: 70px;
            border-radius: 16px;
            font-size: 22px;
            background: var(--button-bg);
            color: white;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        button:hover {
            background: var(--button-hover);
            transform: scale(1.02);
        }

        button:active {
            transform: scale(0.95);
        }

        .op-button {
            background: #0ea5e9;
            color: white;
        }
        
        .op-button:hover {
            background: #38bdf8;
        }

        .clear-button {
            background: #ef4444;
            grid-column: span 2;
        }
        
        .clear-button:hover {
            background: #f87171;
        }

        .equal-button {
            background: #10b981;
            grid-column: 4;
            grid-row: 5;
            height: 100%;
        }
        
        .equal-button:hover {
            background: #34d399;
        }

        .zero-button {
            grid-column: span 2;
        }

        /* History Card */
        .history-card {
            width: 350px;
            min-height: 520px;
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 25px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
        }

            <h2>
                History
                <div style="display: flex; gap: 10px; align-items: center;">
                    <button onclick="clearHistory()" style="height: 30px; font-size: 12px; padding: 0 10px; background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);">Clear</button>
                    <span id="refresh-indicator" style="font-size: 12px; color: #64748b; font-weight: normal;">updated</span>
                </div>
            </h2>

        #history-list {
            list-style: none;
            padding: 0;
            margin: 0;
            overflow-y: auto;
            max-height: 400px;
        }

        .history-item {
            padding: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: background 0.2s;
        }

        .history-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .history-expr {
            font-size: 14px;
            color: #94a3b8;
            margin-bottom: 4px;
        }

        .history-res {
            font-size: 18px;
            color: var(--text);
            font-weight: 600;
        }

        .back-nav {
            width: 100%;
            margin-bottom: 20px;
        }

        .back-btn {
            background: rgba(255,255,255,0.1);
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.2);
        }

        /* Scrollbar */
        #history-list::-webkit-scrollbar {
            width: 6px;
        }
        #history-list::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="back-nav">
        <a href="../index.html" class="back-btn">← Back to Lab Index</a>
    </div>

    <div class="main-container">
        <!-- Calculator -->
        <div class="calculator">
            <input type="text" id="display" disabled placeholder="0">

            <div class="buttons">
                <button class="clear-button" onclick="clearDisplay()">C</button>
                <button onclick="backspace()">⌫</button>
                <button class="op-button" onclick="setop('/')">/</button>

                <button onclick="setnum(7)">7</button>
                <button onclick="setnum(8)">8</button>
                <button onclick="setnum(9)">9</button>
                <button class="op-button" onclick="setop('*')">*</button>

                <button onclick="setnum(4)">4</button>
                <button onclick="setnum(5)">5</button>
                <button onclick="setnum(6)">6</button>
                <button class="op-button" onclick="setop('-')">-</button>

                <button onclick="setnum(1)">1</button>
                <button onclick="setnum(2)">2</button>
                <button onclick="setnum(3)">3</button>
                <button class="op-button" onclick="setop('+')">+</button>

                <button class="equal-button" onclick="calculate()">=</button>

                <button class="zero-button" onclick="setnum(0)">0</button>
                <button onclick="adddot()">.</button>
            </div>
        </div>

        <!-- History Card -->
        <div class="history-card">
            <h2>
                History
                <span id="refresh-indicator" style="font-size: 12px; color: #64748b; font-weight: normal;">updated</span>
            </h2>
            <ul id="history-list">
                <!-- History items will be loaded here -->
            </ul>
        </div>
    </div>

    <script>
        let num1 = "";
        let num2 = "";
        let operator = "";
        const display = document.getElementById('display');
        const historyList = document.getElementById('history-list');

        function setnum(n) {
            if (operator === "") {
                num1 += n;
                display.value = num1;
            } else {
                num2 += n;
                display.value = num2;
            }
        }

        function setop(op) {
            if (num1 !== "" && num2 === "") {
                operator = op;
                display.value = op;
            }
        }

        function adddot() {
            if (operator === "") {
                if (!num1.includes(".")) {
                    num1 += ".";
                    display.value = num1;
                }
            } else {
                if (!num2.includes(".")) {
                    num2 += ".";
                    display.value = num2;
                }
            }
        }

        function calculate() {
            if (num1 === "" || num2 === "" || operator === "") return;

            let result = 0;
            let n1 = parseFloat(num1);
            let n2 = parseFloat(num2);
            let expression = `${num1} ${operator} ${num2}`;

            switch(operator) {
                case "+": result = n1 + n2; break;
                case "-": result = n1 - n2; break;
                case "*": result = n1 * n2; break;
                case "/": result = n1 / n2; break;
            }

            display.value = result;
            
            // Save to database
            saveHistory(expression, result);

            num1 = result.toString();
            num2 = "";
            operator = "";
        }

        function backspace() {
            if (operator === "") {
                num1 = num1.toString().slice(0, -1);
                display.value = num1;
            } else {
                num2 = num2.toString().slice(0, -1);
                display.value = num2;
            }
        }

        function clearDisplay() {
            display.value = "";
            num1 = "";
            num2 = "";
            operator = "";
        }

        // Backend Integration
        async function saveHistory(expression, result) {
            try {
                const response = await fetch('save_history.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ expression, result: result.toString() })
                });
                const data = await response.json();
                if (data.status === 'success') {
                    loadHistory();
                }
            } catch (error) {
                console.error('Error saving history:', error);
            }
        }

        async function loadHistory() {
            try {
                const response = await fetch('get_history.php');
                const data = await response.json();
                
                historyList.innerHTML = '';
                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(item => {
                        const li = document.createElement('li');
                        li.className = 'history-item';
                        li.innerHTML = `
                            <div class="history-expr">${item.expression}</div>
                            <div class="history-res">= ${item.result}</div>
                        `;
                        historyList.appendChild(li);
                    });
                } else {
                    historyList.innerHTML = '<div style="padding: 20px; text-align: center; color: #64748b; font-size: 14px;">No history yet</div>';
                }
            } catch (error) {
                console.error('Error loading history:', error);
            }
        }

        async function clearHistory() {
            if (!confirm('Are you sure you want to clear all calculation history?')) return;
            try {
                const response = await fetch('clear_history.php', { method: 'POST' });
                const data = await response.json();
                if (data.status === 'success') {
                    loadHistory();
                }
            } catch (error) {
                console.error('Error clearing history:', error);
            }
        }

        // Initial load
        loadHistory();
    </script>
</body>
</html>
