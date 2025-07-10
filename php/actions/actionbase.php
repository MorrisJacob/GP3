<?php
error_reporting(E_ALL ^ E_NOTICE);  
session_start();
include('../plumbing/sqlconn.php');
include('../plumbing/generalfunctions.php');

$userid = GetSafeString($_SESSION["UserID"]);
$admin = GetSafeString($_SESSION["IsAdmin"]);
if($userid == ""){
	$userid = 0;
}

?>
