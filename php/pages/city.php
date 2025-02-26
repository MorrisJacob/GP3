<?php

$event = $_GET["city"];

$trip = GetTrip($userid, $event);

$eventActive = "";
$itineraryActive = "";
$finDisabled = "disabled";
$eventActive = "active";
if($trip != ""){
	$itineraryActive = "active";
    $finDisabled = "";
}

?>
