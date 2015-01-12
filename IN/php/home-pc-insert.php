<?php
error_reporting(0);

$insert=0;


require_once('dbconnector.php');
require('uploadfiles.php');
require('sendmail2people.php');
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
$cname = $_POST['cname'];
$cdate = $_POST['cdate'];
$cpackage = $_POST['cpackage'];
$cjob = $_POST['cjob'];
$ccgpa = $_POST['ccgpa'];
$ctenth = $_POST['ctenth'];
$ctwelth = $_POST['ctwelth'];
$cdiploma= $_POST['cdiploma'];
$cdeadline= $_POST['cdeadline'];
//echo $cdeadline;
$r = uploadfiles($cname);

if($r == 1) {


    $result1 = $mysqli->query("INSERT INTO `company` (`NAME`, `PACKAGE`, `GPACUTOFF`, `TENTHCUTOFF`, `PUCCUTOFF`, `DIPLOMACUTOFF`, `lastDateReg`) VALUES ('$cname', '$cpackage', '$ccgpa', '$ctenth', '$ctwelth', '$cdiploma','$cdeadline');");
    $result2 = $mysqli->query("INSERT INTO jobprofile (`NAME`, `PROFILE`) VALUES ('$cname', '$cjob');");
    $result3 = $mysqli->query("INSERT INTO `dateofvisit` (`NAME`, `DATE`) VALUES ('$cname', '$cdate');");

    foreach ($_POST['cbranches'] as $selected) {
        $result4 = $mysqli->query("INSERT INTO `brancheseligible` (`NAME`, `BRANCH`) VALUES ('$cname', '$selected');");
    }

    $result5=$mysqli->query("select * from student where CGPA >= '$ccgpa' and tenthPercent >='$ctenth' and (twelthPercent >='$ctwelth' or diplomaPercent >= '$cdiploma')");
    $body = '<!DOCTYPE HTML>
    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
<head></head>
<body>
<style type="text/css">
tr:hover { color: black !important; }
></style>
<br><table style="border-collapse: collapse; margin-left: auto; margin-right: auto; width: 90%; padding: 4px; border: 1px solid black;">
<caption style="color: e24739; font-size: 20pt;">Incoming Company</caption>

<tr style="color: grey; transition: color 0.1s; border-collapse: collapse; margin-left: auto; margin-right: auto; width: 90%; padding: 4px; border: 1px solid black;">
<td style="text-align: center; padding: 4px;" align="center">Name </td>
<td style="text-align: center; padding: 4px;" align="center">'.$cname.'</td>
</tr>
<tr style="color: grey; transition: color 0.1s; border-collapse: collapse; margin-left: auto; margin-right: auto; width: 90%; padding: 4px; border: 1px solid black;">
<td style="text-align: center; padding: 4px;" align="center">Profile</td>
<td style="text-align: center; padding: 4px;" align="center">'.$cjob.'</td>
</tr>
<tr style="color: grey; transition: color 0.1s; border-collapse: collapse; margin-left: auto; margin-right: auto; width: 90%; padding: 4px; border: 1px solid black;">
<td style="text-align: center; padding: 4px;" align="center">Package</td>
<td style="text-align: center; padding: 4px;" align="center">'.$cpackage.'</td>
</tr>
<tr style="color: grey; transition: color 0.1s; border-collapse: collapse; margin-left: auto; margin-right: auto; width: 90%; padding: 4px; border: 1px solid black;">
<td style="text-align: center; padding: 4px;" align="center">Date of Visit</td>
<td style="text-align: center; padding: 4px;" align="center">'.$cdate.'</td>
</tr>
</table>
<p>For more details and to register, Please visit our website.<br>This is a computer generated mail. Please do not reply to this mail.</p>
</body>
</html>

';
    $insert=1;

    //echo "string";
    //echo "";
    while($ar=mysqli_fetch_assoc($result5))
    {
        $em = $ar['EMAIL'];
        $sub='Incoming Company : '.$cname;
        sendmail($em,'Student', $sub,$body);
        $insert=1;
    }

}
$_SESSION['insert'] = $insert;
header('Location: ../home-pc.php');

?>

</body></html>
