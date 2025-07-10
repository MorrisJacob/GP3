<?php
include("actionbase.php");

//given a type and a city, retrieve all place ids where visible is true
$type = GetSafeString($_GET["type"]);
$city = GetSafeString($_GET["city"]);

$sql = "SELECT placeID FROM Activity WHERE types = '$type' AND city = '$city' AND visible = 1";

$returns = ExecuteSQLArray($sql);

$placeIDs = array_column($returns, 'placeID');
echo json_encode($placeIDs);

?>
