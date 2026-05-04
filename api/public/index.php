<?php
require_once 'config.php';

$action = $_GET['action'] ?? '';
$response = [];

switch ($action) {
    case 'all':
        // Получить все записи
        $stmt = $pdo->query("SELECT * FROM cities ORDER BY country, city");
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
        break;
        
    case 'get':
        // Получить одну запись по id
        $id = $_GET['id'] ?? 0;
        $stmt = $pdo->prepare("SELECT * FROM cities WHERE id = ?");
        $stmt->execute([$id]);
        $response = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$response) {
            $response = ['error' => 'Record not found'];
        }
        break;
        
    case 'del':
        // Удалить запись по id
        $id = $_GET['id'] ?? 0;
        $stmt = $pdo->prepare("DELETE FROM cities WHERE id = ?");
        $stmt->execute([$id]);
        $response = ['success' => true, 'deleted_id' => $id];
        break;
        
    case 'edit':
        // Изменить запись (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'] ?? 0;
            $input = json_decode(file_get_contents('php://input'), true);
            $country = $input['country'] ?? '';
            $city = $input['city'] ?? '';
            
            $stmt = $pdo->prepare("UPDATE cities SET country = ?, city = ? WHERE id = ?");
            $stmt->execute([$country, $city, $id]);
            $response = ['success' => true, 'updated' => ['id' => $id, 'country' => $country, 'city' => $city]];
        } else {
            $response = ['error' => 'Method not allowed. Use POST'];
        }
        break;
        
    default:
        $response = [
            'available_actions' => [
                'all' => 'GET /index.php?action=all',
                'get' => 'GET /index.php?action=get&id=1',
                'del' => 'GET /index.php?action=del&id=1',
                'edit' => 'POST /index.php?action=edit&id=1'
            ]
        ];
}

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
