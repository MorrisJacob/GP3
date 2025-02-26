<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = GetSafeString($_POST['id']);
    $latitude = GetSafeString($_POST['Latitude']);
    $longitude = GetSafeString($_POST['Longitude']);
    $phone = GetSafeString($_POST['phone']);
    $name = GetSafeString($_POST['name']);
    $address = GetSafeString($_POST['address']);
    $url = GetSafeString($_POST['url']);

    if(is_null($id) || $id == "" || $id <= 0){
        //new Short-Term Rental

        ExecuteSQL("INSERT INTO ShortTermRentals (latitude, longitude, phone, name, address, url) " . 
        "VALUES (" .
        $latitude . ", " .
        $longitude . ", " .
        "'" . $phone . "', " .
        "'" . $name . "', " .
        "'" . $address . "', " .
        "'" . $url . "');");

    }else{
        //update existing

        ExecuteSQL("UPDATE ShortTermRentals SET latitude = '" . $latitude . "'," . 
        "longitude = '" . $longitude . "', " .
        "phone = '" . $phone . "', " .
        "name = '" . $name . "', " .
        "address = '" . $address . "', " .
        "url = '" . $url . "' " .
        "WHERE id = " . $id . ";");
    }

    echo "<script>location='short-term-rentals.php'</script>"; /* Redirect browser */

}else{
        if($userid == 0){
            echo "<script>location='login.php'</script>"; /* Redirect browser */
            exit();
        }
        $id = GetSafeString($_GET['id']);
        if(!is_null($id) && $id != "" && $id > 0){
            $strInfo = ExecuteSQL("SELECT latitude, longitude, phone, name, address, url FROM ShortTermRentals WHERE id = " . $id . ";");


            if ($strInfo->num_rows > 0) {
                // output data of each row
                while($row = $strInfo->fetch_assoc()) {

                $latitude = $row["latitude"];
                $longitude = $row["longitude"];
                $phone = $row["phone"];
                $name = $row["name"];
                $address = $row["address"];
                $url = $row["url"];

                }
            }

        }
}
?>
