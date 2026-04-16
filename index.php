<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация пользователя</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>📝 Регистрация пользователя</h1>
        
        <form action="action.php" method="POST" class="registration-form">
            <div class="form-group">
                <label for="fullname">Полное имя:</label>
                <input type="text" id="fullname" name="fullname" placeholder="Иванов Иван Иванович" required>
            </div>

            <div class="form-group">
                <label for="email">Email адрес:</label>
                <input type="email" id="email" name="email" placeholder="user@example.com" required>
            </div>

            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" placeholder="Минимум 6 символов" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Подтверждение пароля:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="form-group">
                <label for="gender">Пол:</label>
                <select id="gender" name="gender" required>
                    <option value="">Выберите пол</option>
                    <option value="male">Мужской</option>
                    <option value="female">Женский</option>
                    <option value="other">Другой</option>
                </select>
            </div>

            <div class="form-group">
                <label for="birthdate">Дата рождения:</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>

            <div class="form-group checkbox">
                <label>
                    <input type="checkbox" name="agreement" required>
                    Я согласен с условиями обработки персональных данных
                </label>
            </div>

            <button type="submit" class="submit-btn">Зарегистрироваться</button>
        </form>

        <!-- Калькулятор -->
        <div class="calculator">
            <h2>🧮 Калькулятор</h2>
            <form method="POST" action="">
                <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                    <input type="number" name="num1" placeholder="Число 1" step="any" required style="flex: 1;">
                    <input type="number" name="num2" placeholder="Число 2" step="any" required style="flex: 1;">
                </div>
                
                <div class="calc-buttons">
                    <button type="submit" name="operation" value="add" class="calc-btn">+</button>
                    <button type="submit" name="operation" value="subtract" class="calc-btn">-</button>
                    <button type="submit" name="operation" value="multiply" class="calc-btn">×</button>
                    <button type="submit" name="operation" value="divide" class="calc-btn">÷</button>
                </div>
            </form>
            
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation'])) {
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $operation = $_POST['operation'];
                $result = null;
                $error = null;
                
                if (is_numeric($num1) && is_numeric($num2)) {
                    switch ($operation) {
                        case 'add':
                            $result = $num1 + $num2;
                            $op_symbol = '+';
                            break;
                        case 'subtract':
                            $result = $num1 - $num2;
                            $op_symbol = '-';
                            break;
                        case 'multiply':
                            $result = $num1 * $num2;
                            $op_symbol = '×';
                            break;
                        case 'divide':
                            if ($num2 == 0) {
                                $error = "❌ Ошибка: Деление на ноль невозможно!";
                            } else {
                                $result = $num1 / $num2;
                                $op_symbol = '÷';
                            }
                            break;
                        default:
                            $error = "Неизвестная операция";
                    }
                } else {
                    $error = "Пожалуйста, введите корректные числа";
                }
                
                if ($result !== null) {
                    echo "<div class='result'>📐 Результат: $num1 $op_symbol $num2 = " . round($result, 4) . "</div>";
                } elseif ($error) {
                    echo "<div class='result' style='color: #721c24; background: #f8d7da; border-color: #f5c6cb;'>$error</div>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>