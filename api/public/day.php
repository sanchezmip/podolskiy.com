<?php
require_once 'config.php';

$day = date('d');
echo json_encode(['day' => $day, 'date' => date('Y-m-d')]);
