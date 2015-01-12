<?php
/**
 * Created by PhpStorm.
 * User: ramu
 * Date: 22/11/14
 * Time: 10:27 PM
 */

$host="localhost"; // Host name or server name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="placementinformer"; // Database name
$tbl_name="student"; // Table name
$con = mysqli_connect("$host", "$username", "$password","$db_name");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
require_once('sendmail2people.php');
require_once('dbconnector.php');
$comp = $_POST['Compnay'];
$msg = $_POST['message'];
$sub = "Notification by Placement Department, Company :".$comp;

$result4=mysqli_query($con,"select * from company where NAME ='$comp'");
$r1 = mysqli_fetch_array($result4);
$cgpa=$r1['GPACUTOFF'];
$ctenth = $r1['TENTHCUTOFF'];
$ctwelth= $r1['PUCCUTOFF'];
$cdiploma= $r1['DIPLOMACUTOFF'];

$result5=mysqli_query($con,"select * from student where CGPA >= '$ccgpa' and tenthPercent >='$ctenth' and (twelthPercent >='$ctwelth' or diplomaPercent >= '$cdiploma' and BRANCH IN (select branch from brancheseligible where name='$comp'))");
while($ar=mysqli_fetch_assoc($result5))
{
    $stu = $ar['EMAIL'];
    sendmail($stu,'Student',$sub,$msg);
    $insert=1;
}
$_SESSION['insert'] = $insert;
header('Location: ../notification.php');


?>