<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Подключение к PostgreSQL
$host = '127.0.0.1';
$port = '5432';
$dbname = 'php_site';
$user = 'postgres';
$password = 'password';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]));
}

// Создаём таблицу городов если не существует
$pdo->exec("
    CREATE TABLE IF NOT EXISTS cities (
        id SERIAL PRIMARY KEY,
        country VARCHAR(100) NOT NULL,
        city VARCHAR(100) NOT NULL
    )
");

// Добавляем тестовые данные если таблица пуста
$stmt = $pdo->query("SELECT COUNT(*) FROM cities");
$count = $stmt->fetchColumn();

if ($count == 0) {
    $cities = [
        ['Russia', 'Moscow'], ['Russia', 'Saint Petersburg'], ['Russia', 'Novosibirsk'],
        ['USA', 'New York'], ['USA', 'Los Angeles'], ['USA', 'Chicago'],
        ['Germany', 'Berlin'], ['Germany', 'Munich'], ['Germany', 'Hamburg'],
        ['France', 'Paris'], ['France', 'Lyon'], ['France', 'Marseille']
    ];
    
    $stmt = $pdo->prepare("INSERT INTO cities (country, city) VALUES (?, ?)");
    foreach ($cities as $city) {
        $stmt->execute($city);
    }
}
