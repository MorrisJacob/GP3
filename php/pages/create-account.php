<?php

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstname = GetSafeString($_POST['firstname']);
    $lastname = GetSafeString($_POST['lastname']);
    $phone = GetSafeString($_POST['phone']);
    $email = GetSafeString($_POST['email']);
    $company = GetSafeString($_POST['company']);
    $paswd = GetSafeString($_POST['password']);
    $redirect = GetSafeString($_POST['redirect']);
    $event = GetSafeString($_POST['event']);

    //first, we need to check to ensure this user doesn't already exist
    $sqlstr = "SELECT * FROM users WHERE EmailAddress = '" . $email . "'";
    $sql = ExecuteSQL($sqlstr);

    if($sql != ""){

        $error = "<div style='color:red;'>An account already exists for this email address. Forgot your password? <a href='forgetpass.php'>Let us help!</a></div>";
    }else{
        //we're good!

        //now, let's get a salt for that ol' pass
        $salt = GetSalt();

        //now, hash up that pass! Remember that this returns $salt + $hashpass, which is exactly what we want in our hashpass field
        $hashpass = HashPass($paswd, $salt);


        //lastly, let's insert this user

        $insql = "INSERT INTO users (EmailAddress, HashPass, FirstName, LastName, Company, PhoneNumber) " .
        "VALUES ('" . $email . "','" . $hashpass . "','" . $firstname . "','" . $lastname . "', '" . $company . "','" . $phone . "')";

        ExecuteSQL($insql);

        $error = "<div style='color:green;'>Your account has been created!</div>";
    
        //log them in
        $_SESSION["email"] = $email;
        $_SESSION["UserID"] = GetSingleValueDB("SELECT UserID FROM users WHERE EmailAddress = '" . $email . "' limit 1;", "UserID");

        //If they had filled out any info, make it their current trip
        $trip = GetTrip($userid, $event);   
        
        if($trip == "SessionStart"){
            $userid = $_SESSION["UserID"];
            $trip = CreateTrip($userid, $event);
            ConvertEvents($trip);
            ConvertActivities($trip);
        }

        //If they wanted a redirect, redirect them
        if(!is_null($redirect) && $redirect != ""){
            echo '<script type="text/javascript">window.location = "cart.php?city=' . $event . '";</script>   '; 
        }
        
    }

} else {
    $redirect = GetSafeString($_GET['redirect']);
    $event = GetSafeString($_GET['event']);
}

?>
