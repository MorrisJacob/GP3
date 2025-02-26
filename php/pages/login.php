<?php

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //let's see if they entered the proper information
    $email = GetSafeString($_POST['email']);
    $pass = GetSafeString($_POST['password']);

    $hashpass = GetSingleValueDB("SELECT HashPass FROM users WHERE EmailAddress = '" . $email . "' limit 1;", "HashPass");

    if($hashpass != ""){
        $salt = substr($hashpass, 0, 6);

        $myPass = HashPass($pass, $salt);

        if($myPass == $hashpass){
            $_SESSION["email"] = $email;
            $_SESSION["UserID"] = GetSingleValueDB("SELECT UserID FROM users WHERE EmailAddress = '" . $email . "' limit 1;", "UserID");
            $_SESSION["IsAdmin"] = GetSingleValueDB("SELECT IsAdmin FROM users WHERE EmailAddress = '" . $email . "' limit 1;", "IsAdmin");
            echo("<script>location.href = 'index.php';</script>");
        }else{
            $error = "Incorrect Password. forgot your password? <a href='forgetpass.php'>Click here</a>";
        }


    }else{
        $error = "No account found for this Email Address. Please <a href='register.php'>register today!</a>";
    }
}
?>
