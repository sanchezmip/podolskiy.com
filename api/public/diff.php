<?php
require_once 'config.php';

if (!isset($_GET['date1']) || !isset($_GET['date2'])) {
    echo json_encode(['error' => 'Parameters "date1" and "date2" are required (format: Y-m-d)']);
    exit;
}

$date1 = $_GET['date1'];
$date2 = $_GET['date2'];

$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);

if (!$timestamp1 || !$timestamp2) {
    echo json_encode(['error' => 'Invalid date format. Use Y-m-d']);
    exit;
}

$diff_seconds = abs($timestamp2 - $timestamp1);
$diff_days = floor($diff_seconds / (60 * 60 * 24));

echo json_encode([
    'date1' => $date1,
    'date2' => $date2,
    'days' => $diff_days,
    'hours' => floor($diff_seconds / 3600),
    'minutes' => floor($diff_seconds / 60)
]);
