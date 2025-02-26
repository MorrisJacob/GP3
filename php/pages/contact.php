<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$fname = GetValidString($_POST['fname']);
	$lname = GetValidString($_POST['lname']);
	$email = GetValidString($_POST['email']);
	$subject = GetValidString($_POST['subject']);
	$message = GetValidString($_POST['message']);

	$msg = "Someone tried to contact you!\n" .
	       "Name: " . $fname . " " . $lname . "\n" .
	       "Email: " . $email . "\n" . 
	       "Subject: " . $subject . "\n" . 
	       "Message: " . $message . "\n";

	SendEmail("jacob@morrisprogramming.com", "Contact us Email", $msg);
}

?>
