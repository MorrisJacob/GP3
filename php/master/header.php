<?php
$userid = GetSafeString($_SESSION["UserID"]);
$admin = GetSafeString($_SESSION["IsAdmin"]);

if($userid == ""){
    $userid = 0;
}
if($admin == ""){
    $admin = 0;
}
?>
