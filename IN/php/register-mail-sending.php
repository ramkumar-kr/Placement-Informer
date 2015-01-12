<?php
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.
function sendvmail($usn,$name,$email,$code)
{
	require_once('sendmail2people.php');
echo 'here';
$to=$email;

// Your subject
$subject="Activation of Account for Placements in RVCE";

// From
//$header="Verification of your account at Placement Informer";

// Your message
$message="<html><head></head><body>Dear Student,<br>Welcome to the Placement Department of RVCE. As a part of the process, every student is required to register for an account in our Placement Informer website with a One-Time-Registration link sent to your mail. ";
$message.="A One-Time-Registration Link is as below.<br>";
$message.="<a href='http://localhost/test/IN/signup.php?passkey=$code'>Click on this link to activate your account </a>\r\n";
$message.="Or copy and paste the follwing URL to your browser http://localhost/test/IN/signup.php?passkey=$code";


    echo sendmail($email,'Placement Informer',$subject,$message);

// send email
//$sentmail = mail($to,$subject,$message,$header);
}

?>