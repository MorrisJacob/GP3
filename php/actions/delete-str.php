<?php
include("actionbase.php");

$id = $_GET["id"];

$shortTermSQL = "DELETE FROM ShortTermRentals Where id = " . $id . ";";
ExecuteSQL($shortTermSQL);

if (isset($_SERVER["HTTP_REFERER"])) {
    echo "<script>location='" .$_SERVER["HTTP_REFERER"] . "'</script>"; /* Redirect browser */
}

?>
