<?php
//error_reporting(E_ALL);
print_r($_GET);
// Initialize session
/*session_start();


// Check, if username session is NOT set then this page will jump to login page
if ((!isset($_SESSION['username']))||(!isset($_SESSION['password']) )){
    header('Location: ../..');
}
else
{
    echo 'Hi';
}
/*
$mysqli = new mysqli("localhost", "root", "", "placementinformer"); // put "" for the password if you want to run them

$appl=0;
$_SESSION['appl'] = $appl;

/* check connection
if ($mysqli->connect_errno) {
    echo 'Connect failed';
    echo $mysqli->error;
}


//obtaining company name and usn
$nameofcomp = $_GET['cname'];
$usn = $_SESSION['username'];


//checking duplicate entries
$r0 = mysqli_query($mysqli,"SELECT * FROM applied WHERE USN='$usn' and NAME = '$nameofcomp'");
//print_r($r0);
$c0 = mysqli_fetch_array($r0, MYSQLI_ASSOC);
//print_r($c0);

if(mysqli_num_rows($r0) > 0 ) {

    $r1 = mysqli_query($mysqli, "delete from applied WHERE USN='$usn' and NAME = '$nameofcomp'");
    if (isset($r1)) {
        $appl = 3;
        $_SESSION['appl'] = $appl;

//send sms - 2nd phase
    }
    header('Location: ../studentHome.php');
}
else {
        $appl = 0;
        $_SESSION['appl'] = $appl;


        echo 'Action Failed';
        header('Location: ../studentHome.php');
    }

?>