<?php
require_once "../db/pdo.php";
require_once "../db/util.php";
session_start();
//if(!isset($_SESSION['adminid'])){
// header("Location: index.php");
//}
if ( !isset($_GET['mid']) ) {
$_SESSION['errormsg'] = "Missing id";
header('Location: unblockmonitor.php');
return;
}
$sql = "UPDATE monitors SET m_status = :st where m_id= :mid";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':mid' => $_GET['mid'],
':st' => "1"
)
);
$_SESSION["successmsg"] = "Monitor Unblock";
header( 'Location: unblockmonitor.php' );
return;
?>