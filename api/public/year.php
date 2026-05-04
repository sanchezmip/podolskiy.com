<?php
require_once 'config.php';

$year = date('Y');
echo json_encode(['year' => $year, 'date' => date('Y-m-d')]);
