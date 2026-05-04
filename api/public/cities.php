<?php
require_once 'config.php';

if (!isset($_GET['country'])) {
    echo json_encode(['error' => 'Parameter "country" is required']);
    exit;
}

$country = $_GET['country'];

$stmt = $pdo->prepare("SELECT city FROM cities WHERE country = ? ORDER BY city");
$stmt->execute([$country]);
$cities = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode([
    'country' => $country,
    'cities' => $cities,
    'count' => count($cities)
]);
