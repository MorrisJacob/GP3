<?php
if (isset($_SESSION['UserID'])){
    $userid = $_SESSION['UserID'];
} else {
    $userid = "";
}
if (isset($_SESSION['IsAdmin'])){
    $admin = $_SESSION['IsAdmin'];
} else {
    $admin = "";
}
$event = $_GET["event"];
$city = GetCity($event);

if($userid == ""){
    $userid = 0;
}
if($admin == ""){
    $admin = 0;
}
?>
