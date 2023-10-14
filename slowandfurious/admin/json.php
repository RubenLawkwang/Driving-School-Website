<?php
require_once '../db/pdo.php';
$stmt = $pdo->query("select * from clients");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//encode the data into json format
echo json_encode($rows);