<?php
require_once "../db/pdo.php";
require_once "../db/util.php";
session_start();
//if(!isset($_SESSION['adminid'])){
// header("Location: index.php");
//}
if ( !isset($_GET['cid']) ) {
$_SESSION['errormsg'] = "Missing id";
header('Location: adviewuser.php');
return;
}
$sql = "UPDATE clients SET c_status = :st where c_id= :uid";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':uid' => $_GET['cid'],
':st' => "0"
)
);
$_SESSION["successmsg"] = "Client Blocked";
header( 'Location: adviewuser.php' );
return;
?>