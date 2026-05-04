<?php
require_once 'config.php';

if (!isset($_GET['date'])) {
    echo json_encode(['error' => 'Parameter "date" is required (format: Y-m-d)']);
    exit;
}

$date = $_GET['date'];
$timestamp = strtotime($date);

if (!$timestamp) {
    echo json_encode(['error' => 'Invalid date format. Use Y-m-d']);
    exit;
}

$weekdays = [
    'Sunday', 'Monday', 'Tuesday', 'Wednesday', 
    'Thursday', 'Friday', 'Saturday'
];

$weekday_number = date('w', $timestamp);
$weekday_name = $weekdays[$weekday_number];

// Русские названия
$weekdays_ru = [
    'Воскресенье', 'Понедельник', 'Вторник', 'Среда',
    'Четверг', 'Пятница', 'Суббота'
];

echo json_encode([
    'date' => $date,
    'weekday_en' => $weekday_name,
    'weekday_ru' => $weekdays_ru[$weekday_number],
    'day_number' => $weekday_number
]);
