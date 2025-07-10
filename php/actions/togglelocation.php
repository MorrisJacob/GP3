<?php
include("actionbase.php");


if($admin == 1){ 
    $placeid = GetSafeString($_GET["placeid"]);
    $type = GetSafeString($_GET["type"]);
    $city = GetSafeString($_GET["city"]);
    $visible = $_GET["visible"];

    $activityID = GetSingleValueDB("SELECT ActivityId FROM Activity WHERE placeID = '" . $placeid . "' AND Types = '" . $type . "' AND city = '" . $city . "' ;","ActivityId");

    if($activityID == null || $activityID == "") {
        $visibleSQL = "INSERT INTO Activity (placeID, types, city, visible) VALUES ('" . $placeid . "', '" . $type . "', '" . $city . "', " . $visible . ");";
    } else{
        //Update Activity visibility by activityID
        $visibleSQL = "UPDATE Activity SET visible = " . $visible . " WHERE ActivityId = '" . $activityID . "';";
    }

    ExecuteSQL($visibleSQL);



}

if (isset($_SERVER["HTTP_REFERER"])) {
    echo "<script>location='" .$_SERVER["HTTP_REFERER"] . "'</script>"; /* Redirect browser */
}else{
    echo "<script>location='index.php'</script>"; /* Redirect browser */
}

?>
