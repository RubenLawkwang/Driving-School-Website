<?php
require_once "../db/pdo.php";
require_once "../db/util.php";
session_start();
//Check if the sid token is in the url
if (isset( $_GET["sid"] )) {
try {
//add the delete statement with a where clause
$sql = " delete from location where loc_id=:typeid";
$stmt = $pdo->prepare($sql);
//retrieve the sid from the url
$stmt->execute(array(':typeid' => $_GET["sid"] ));
$_SESSION['successmsg'] = 'Location deleted';
header('Location: deletelocation.php');
return;
} catch (Exception $e) {
    $_SESSION['errormsg'] = $e->getMessage();
// echo 'Messages: ' . $e->getMessage();
//$_SESSION['errormsg'] = 'Cannot delete this record!';
header('Location: deletelocation.php');
return;
}
}

// delete category
if (isset( $_GET["cid"] )) {
    try {
    //add the delete statement with a where clause
    $sql = " delete from category where cat_id=:catid";
    $stmt = $pdo->prepare($sql);
    //retrieve the sid from the url
    $stmt->execute(array(':catid' => $_GET["cid"] ));
    $_SESSION['successmsg'] = 'Car deleted';
    header('Location: deletetranscategory.php');
    return;
    } catch (Exception $e) {
        $_SESSION['errormsg'] = $e->getMessage();
    // echo 'Messages: ' . $e->getMessage();
    //$_SESSION['errormsg'] = 'Cannot delete this record!';
    header('Location: deletetranscategory.php');
    return;
    }
    }


?>