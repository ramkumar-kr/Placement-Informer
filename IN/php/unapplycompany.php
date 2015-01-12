<?php
/**
 * Created by PhpStorm.
 * User: ramu
 * Date: 25/11/14
 * Time: 4:45 PM
 */

// Initialize session
require_once('sendmail2people.php');
session_start();

// Check, if username session is NOT set then this page will jump to login page
if ((!isset($_SESSION['username']))||(!isset($_SESSION['password']) )){
    header('Location: ../..');
}
else
{
    $uname = $_SESSION['usernameT'];
    $host="localhost"; // Host name or server name
    $username="root"; // Mysql username
    $password=""; // Mysql password
    $db_name="placementinformer"; // Database name
    $tbl_name="applied"; // Table name
    $con = mysqli_connect("$host", "$username", "$password","$db_name");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        $cname= $_GET['cname'];
        echo $cname;
        $usn = $_SESSION['username'];
        echo $usn;
        if($r1 = mysqli_query($con,"delete from $tbl_name where USN='$usn' and NAME = '$cname'")) {

            $_SESSION['appl'] = 3;
        }else
        {
            $_SESSION['appl']=0;
        }
        echo $_SESSION['appl'];
        header('Location: ../studentHome.php');
    }
}