<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    
    $errors = [];
    
    if (empty($fullname)) {
        $errors[] = "Поле 'Полное имя' обязательно для заполнения";
    }
    
    if (empty($email)) {
        $errors[] = "Поле 'Email' обязательно для заполнения";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Введите корректный email адрес";
    }
    
    if (empty($password)) {
        $errors[] = "Поле 'Пароль' обязательно для заполнения";
    } elseif (strlen($password) < 6) {
        $errors[] = "Пароль должен содержать минимум 6 символов";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Пароли не совпадают";
    }
    
    if (empty($gender)) {
        $errors[] = "Выберите пол";
    }
    
    if (empty($birthdate)) {
        $errors[] = "Укажите дату рождения";
    }
    
    if (!empty($errors)) {
        echo "<!DOCTYPE html>";
        echo "<html lang='ru'>";
        echo "<head><meta charset='UTF-8'><title>Ошибка валидации</title>";
        echo "<link rel='stylesheet' href='style.css'></head>";
        echo "<body><div class='container'>";
        echo "<div class='message error'>";
        echo "<h2>❌ Ошибка валидации</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo "<a href='index.php' class='submit-btn' style='display: inline-block; text-align: center; text-decoration: none; margin-top: 20px;'>Вернуться к форме</a>";
        echo "</div></div></body></html>";
        exit;
    }
    
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Регистрация успешна</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <div class="message success">
                <h2>✅ Регистрация успешно завершена!</h2>
                <p>Спасибо за регистрацию, <?php echo htmlspecialchars($fullname); ?>!</p>
                <p>На ваш email <?php echo htmlspecialchars($email); ?> отправлено письмо с подтверждением.</p>
                <hr>
                <h3>Ваши данные:</h3>
                <p><strong>Пол:</strong> <?php 
                    $gender_text = [
                        'male' => 'Мужской',
                        'female' => 'Женский',
                        'other' => 'Другой'
                    ];
                    echo $gender_text[$gender] ?? $gender;
                ?></p>
                <p><strong>Дата рождения:</strong> <?php echo htmlspecialchars($birthdate); ?></p>
                <a href="index.php" class="submit-btn" style="display: inline-block; text-align: center; text-decoration: none; margin-top: 20px;">Вернуться на главную</a>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    header('Location: index.php');
    exit;
}
?>