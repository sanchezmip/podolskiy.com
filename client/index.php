<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Клиент - Лабораторная работа №19</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { color: white; text-align: center; margin-bottom: 30px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 20px; }
        .card { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .card h2 { color: #667eea; margin-bottom: 15px; border-bottom: 2px solid #667eea; padding-bottom: 10px; }
        .card button { background: #667eea; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin: 5px; }
        .card button:hover { background: #764ba2; }
        .card input, .card select { width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ddd; border-radius: 4px; }
        .result { background: #f4f4f4; padding: 10px; border-radius: 5px; margin-top: 10px; max-height: 200px; overflow: auto; font-family: monospace; font-size: 12px; }
        pre { white-space: pre-wrap; word-wrap: break-word; }
    </style>
</head>
<body>
    <div class="container">
        <h1>API Клиент - Лабораторная работа №19</h1>
        <div class="grid">
            <div class="card">
                <h2>Текущая дата</h2>
                <button onclick="callAPI('/day.php', 'result-date')">Текущий день</button>
                <button onclick="callAPI('/month.php', 'result-date')">Текущий месяц</button>
                <button onclick="callAPI('/year.php', 'result-date')">Текущий год</button>
                <div class="result" id="result-date">
                    <pre>Нажмите на кнопку</pre>
                </div>
            </div>
            
            <div class="card">
                <h2>День недели по дате</h2>
                <input type="date" id="weekdayDate" value="2024-12-25">
                <button onclick="callAPI('/weekday.php?date=' + document.getElementById('weekdayDate').value, 'result-weekday')">Определить день недели</button>
                <div class="result" id="result-weekday">
                    <pre>Нажмите на кнопку</pre>
                </div>
            </div>
            
            <div class="card">
                <h2>Разница между датами</h2>
                <input type="date" id="date1" value="2024-01-01">
                <input type="date" id="date2" value="2024-12-31">
                <button onclick="calculateDiff()">Рассчитать разницу</button>
                <div class="result" id="result-diff">
                    <pre>Нажмите на кнопку</pre>
                </div>
            </div>
            
            <div class="card">
                <h2>Города по стране</h2>
                <select id="country">
                    <option value="Russia">Россия</option>
                    <option value="USA">США</option>
                    <option value="Germany">Германия</option>
                    <option value="France">Франция</option>
                </select>
                <button onclick="callAPI('/cities.php?country=' + document.getElementById('country').value, 'result-cities')">Показать города</button>
                <div class="result" id="result-cities">
                    <pre>Нажмите на кнопку</pre>
                </div>
            </div>
            
            <div class="card">
                <h2>CRUD операции</h2>
                <button onclick="callAPI('/index.php?action=all', 'result-crud')">Все записи</button>
                <input type="number" id="recordId" placeholder="ID" value="1">
                <button onclick="callAPI('/index.php?action=get&id=' + document.getElementById('recordId').value, 'result-crud')">Найти по ID</button>
                <button onclick="deleteRecord()">Удалить по ID</button>
                <div class="result" id="result-crud">
                    <pre>Нажмите на кнопку</pre>
                </div>
            </div>
            
            <div class="card">
                <h2>Погода</h2>
                <button onclick="getWeather()">Погода в Санкт-Петербурге</button>
                <div class="result" id="result-weather">
                    <pre>Нажмите на кнопку</pre>
                </div>
            </div>
            
            <div class="card">
                <h2>Случайные советы</h2>
                <button onclick="getAdvice()">Получить совет</button>
                <button onclick="saveAdvice()">Сохранить совет</button>
                <button onclick="loadAdvice()">Показать сохранённые</button>
                <div class="result" id="result-advice">
                    <pre>Нажмите на кнопку</pre>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const API_BASE = '/api/public';
        
        async function callAPI(endpoint, resultId) {
            const resultDiv = document.getElementById(resultId);
            resultDiv.innerHTML = '<pre>Загрузка...</pre>';
            
            try {
                const response = await fetch(API_BASE + endpoint);
                const data = await response.json();
                resultDiv.innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
            } catch (error) {
                resultDiv.innerHTML = '<pre>Ошибка: ' + error.message + '</pre>';
            }
        }
        
        async function calculateDiff() {
            const date1 = document.getElementById('date1').value;
            const date2 = document.getElementById('date2').value;
            const resultDiv = document.getElementById('result-diff');
            
            resultDiv.innerHTML = '<pre>Загрузка...</pre>';
            
            try {
                const response = await fetch(API_BASE + '/diff.php?date1=' + date1 + '&date2=' + date2);
                const data = await response.json();
                resultDiv.innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
            } catch (error) {
                resultDiv.innerHTML = '<pre>Ошибка: ' + error.message + '</pre>';
            }
        }
        
        async function deleteRecord() {
            const id = document.getElementById('recordId').value;
            const resultDiv = document.getElementById('result-crud');
            
            if (!confirm('Удалить запись ID ' + id + '?')) return;
            
            resultDiv.innerHTML = '<pre>Загрузка...</pre>';
            
            try {
                const response = await fetch(API_BASE + '/index.php?action=del&id=' + id);
                const data = await response.json();
                resultDiv.innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
            } catch (error) {
                resultDiv.innerHTML = '<pre>Ошибка: ' + error.message + '</pre>';
            }
        }
        
        async function getWeather() {
            const resultDiv = document.getElementById('result-weather');
            resultDiv.innerHTML = '<pre>Загрузка...</pre>';
            
            try {
                const response = await fetch('https://api.open-meteo.com/v1/forecast?latitude=59.9386&longitude=30.2141&current_weather=true');
                const data = await response.json();
                const weather = data.current_weather;
                resultDiv.innerHTML = '<pre>Санкт-Петербург\nТемпература: ' + weather.temperature + '°C\nВетер: ' + weather.windspeed + ' км/ч\nВремя: ' + weather.time + '</pre>';
            } catch (error) {
                resultDiv.innerHTML = '<pre>Ошибка: ' + error.message + '</pre>';
            }
        }
        
        let currentAdvice = '';
        
        async function getAdvice() {
            const resultDiv = document.getElementById('result-advice');
            resultDiv.innerHTML = '<pre>Загрузка...</pre>';
            
            try {
                const response = await fetch('https://api.adviceslip.com/advice');
                const data = await response.json();
                currentAdvice = data.slip.advice;
                resultDiv.innerHTML = '<pre>' + currentAdvice + '</pre>';
            } catch (error) {
                resultDiv.innerHTML = '<pre>Ошибка: ' + error.message + '</pre>';
            }
        }
        
        function saveAdvice() {
            if (currentAdvice) {
                let saved = localStorage.getItem('savedAdvice');
                if (saved) {
                    saved = JSON.parse(saved);
                } else {
                    saved = [];
                }
                saved.push({ advice: currentAdvice, date: new Date().toLocaleString() });
                localStorage.setItem('savedAdvice', JSON.stringify(saved));
                document.getElementById('result-advice').innerHTML = '<pre>Совет сохранён</pre>';
            } else {
                document.getElementById('result-advice').innerHTML = '<pre>Сначала получите совет</pre>';
            }
        }
        
        function loadAdvice() {
            const saved = localStorage.getItem('savedAdvice');
            if (saved) {
                const adviceList = JSON.parse(saved);
                let output = 'Сохранённые советы:\n\n';
                adviceList.forEach((item, index) => {
                    output += (index + 1) + '. [' + item.date + '] ' + item.advice + '\n';
                });
                document.getElementById('result-advice').innerHTML = '<pre>' + output + '</pre>';
            } else {
                document.getElementById('result-advice').innerHTML = '<pre>Нет сохранённых советов</pre>';
            }
        }
    </script>
</body>
</html>
