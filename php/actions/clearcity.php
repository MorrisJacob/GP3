<?php
include("actionbase.php");

$event = $_GET["city"];

$tripID = GetSingleValueDB("SELECT TripId FROM Trip WHERE UserId = " . $userid . " AND Event = '" . $event . "';","TripId");

$eventSQL = "DELETE FROM TripEvent Where TripId = " . $tripID . ";";
ExecuteSQL($eventSQL);
$itinerarySQL = "DELETE FROM TripItinerary Where TripId = " . $tripID . ";";
ExecuteSQL($itinerarySQL);


if (isset($_SERVER["HTTP_REFERER"])) {
    echo "<script>location='" .$_SERVER["HTTP_REFERER"] . "'</script>"; /* Redirect browser */
}

?>
