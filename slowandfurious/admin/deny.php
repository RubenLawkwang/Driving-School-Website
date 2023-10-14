<?php
require_once "../db/pdo.php";
require_once "../db/util.php";
session_start();
//if(!isset($_SESSION['adminid'])){
// header("Location: index.php");
//}
if (!isset($_GET['adis'])) {
    $_SESSION['errormsg'] = "Missing id";
    header('Location: apprads.php');
    return;
}
$sql = "UPDATE advertform SET status = :st where ad_id= :uid";
$stmt = $pdo->prepare($sql);
$stmt->execute(
    array(
        ':uid' => $_GET['adis'],
        ':st' => ""
    )
);
$_SESSION["successmsg"] = "Advertisment Block";
header('Location: apprads.php');
return;
