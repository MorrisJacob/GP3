<?php

$event = $_GET["event"];
$day = $_GET["day"];

$city = GetCity($event);
$trip = GetTrip($userid, $event);
$lodging = GetLodging($trip);

$eventActive = "";
$itineraryActive = "";
$finDisabled = "disabled";
$eventActive = "active city-" . $city;
if(count($lodging) > 0){
    $itineraryActive = "active city-" . $city;
    $finDisabled = "";
    $activeButton = "background-" . $city;
} else {
    $dayDisabled = "disabled";
}

?>
