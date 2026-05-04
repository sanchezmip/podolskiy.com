<?php
require_once 'config.php';

$month = date('m');
$month_name = date('F');
echo json_encode(['month' => $month, 'month_name' => $month_name, 'date' => date('Y-m-d')]);
