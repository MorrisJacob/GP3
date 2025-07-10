<?php
include("actionbase.php");


if($userid == 0){
    //not a logged in user
    $_SESSION["eventTimes"] = [];
    $_SESSION["itineraryTimes"] = [];
}else {
    $event = $_GET["event"];

    $tripID = GetSingleValueDB("SELECT TripId FROM Trip WHERE UserId = " . $userid . " AND Event = '" . $event . "';","TripId");

    $eventSQL = "DELETE FROM TripEvent Where TripId = " . $tripID . ";";
    ExecuteSQL($eventSQL);
    $itinerarySQL = "DELETE FROM TripItinerary Where TripId = " . $tripID . ";";
    ExecuteSQL($itinerarySQL);
}

if (isset($_SERVER["HTTP_REFERER"])) {
    echo "<script>location='" .$_SERVER["HTTP_REFERER"] . "'</script>"; /* Redirect browser */
}else{
    echo "<script>location='index.php'</script>"; /* Redirect browser */
}

?>
