<?php
session_start();
//delete the two session variables “fn” and “cid”
//unset($_SESSION["fn"]);
unset($_SESSION["clientid"]);
unset($_SESSION["monitorid"]);
//destroy the session variable
session_destroy();
//redirect to home page
header("Location: client/index.php");
