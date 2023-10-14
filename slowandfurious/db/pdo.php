<?php
try {
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=drivingcourse','ruben', 'test');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

} catch (PDOException $e) {
$error_message = $e->getMessage();
include('database_errors.php');
exit();
}

?>