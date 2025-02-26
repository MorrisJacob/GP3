<?php

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $newPass = GetSafeString($_POST['pass']);
    $uid = GetSafeString($_POST['hdnUID']);


    if($uid != "" && $newPass != ""){

        //reset pass
        //let's get a salt for that ol' pass
        $salt = GetSalt();

        //now, hash up that pass! Remember that this returns $salt + $hashpass, which is exactly what we want in our hashpass field
        $hashpass = HashPass($newPass, $salt);


                //lastly, let's update this user

                $insql = "UPDATE users SET HashPass = '" . $hashpass . "' " .
                "WHERE UserID = " . $uid . ";";

                ExecuteSQL($insql);

                $error = "<h2 style='color:green;'>Your password was changed successfully!</h2>";

    }else{
        $error = "No account found for this Email Address. Please <a href='create-account.php'>create an account today!</a>";
    }
}
else{
    //let's see if we got the correct info
    $email = GetSafeString($_GET['email']);

    $UserID = GetSafeString($_GET['uid']);

    $email = GetSingleValueDB("SELECT EmailAddress FROM users WHERE EmailAddress = '" . $email . "' AND UserID = " . $UserID . " limit 1;", "EmailAddress");


    if($email == ""){
        //fiend! redirect them
        echo "<script>location='login.php'</script>";
    }

}

?>
