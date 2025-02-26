<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstName = GetSafeString($_POST['FirstName']);
    $lastName = GetSafeString($_POST['LastName']);
    $phone = GetSafeString($_POST['PhoneNumber']);
    $company = GetSafeString($_POST['Company']);

    ExecuteSQL("UPDATE users SET FirstName = '" . $firstName . "'," . 
    "LastName = '" . $lastName . "', " .
    "PhoneNumber = '" . $phone . "', " .
    "Company = '" . $company . "' " .
    "WHERE UserID = " . $userid . ";");

}else{
        if($userid == 0){
            echo "<script>location='login.php'</script>"; /* Redirect browser */
            exit();
        }
        $accountInfo = ExecuteSQL("SELECT FirstName, LastName, Company, PhoneNumber FROM users WHERE UserID = " . $userid . ";");


    if ($accountInfo->num_rows > 0) {
	    // output data of each row
	    while($row = $accountInfo->fetch_assoc()) {

		$firstName = $row["FirstName"];
		$lastName = $row["LastName"];
		$company = $row["Company"];
		$phone = $row["PhoneNumber"];

	    }

    }
}
?>
