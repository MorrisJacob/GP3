<?php
    $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //let's see if they entered the proper information
    $email = GetSafeString($_POST['Email']);

    $userID = GetSingleValueDB("SELECT UserID FROM users WHERE EmailAddress = '" . $email . "' limit 1;", "UserID");


    if($userID != ""){
        
        //They have an account! Send the mail.

    $msg = "You requested a password reset. If this was not you, please ignore this email.\n\n" .
       "Please click this link to reset your password:\n\n" . 
       "http://grandparkrentals.com/new-site/resetpass.php?email=" . $email . "&uid=" . $userID;

    SendEmail($email, "Grand Park Rentals -- Forgot Password!", $msg);


    $error = "<div style='color:green;'>An email has been sent!</div>";

    }else{
        $error = "No account found for this Email Address. Please <a href='create-account.php'>create an account today!</a>";
    }
}

?>

