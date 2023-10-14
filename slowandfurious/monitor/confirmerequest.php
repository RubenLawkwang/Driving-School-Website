<?php
require_once "../db/pdo.php";
require "../db/util.php";
session_start();
//if(!isset($_SESSION['adminid'])){
// header("Location: index.php");
//}
if ( !isset($_GET['ms_id']) ) {
$_SESSION['errormsg'] = "Missing id";
header('Location: viewmessage.php');
return;
}
$sql = "UPDATE message SET status = :pay where ms_id= :tid";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':tid' => $_GET['ms_id'],
':pay' => "1"
)
);
$_SESSION["successmsg"] = "Reservation confirmed";
header( 'Location: viewmessage.php' );
return;
?>