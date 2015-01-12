<?php

// Initialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if ((!isset($_SESSION['username']))||(!isset($_SESSION['password']) )){
    header('Location: ../');
}

header('Content-Type: text/csv; charset=utf-8');
$company = $_GET['cname'] . '.csv';

header('Content-Disposition: attachment; filename= '.$company);
$output = fopen('php://output', 'w');
fputcsv($output,array('R V College of Engineering',' ','List of Registered Applicants'));
fputcsv($output,array('Company Name ',$_GET['cname']));
fputcsv($output, array('USN', 'Name', 'Branch' , 'Email-ID' , 'Phone' , 'CGPA' , 'Tenth Percentage' , 'Twelfth Percentage' , 'Diploma Percentage'));

$host="localhost"; // Host name or server name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="placementinformer"; // Database name
//echo "assddsfghj";
$con = mysqli_connect("$host", "$username", "$password","$db_name");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$uname=$_SESSION['username'];

/*$fname = 'I:\temp\\'.$uname.time().'.csv';
//this works perfectly in ubuntu ... for windows change path where file permissions are present
unlink($fname);
$cname=$_POST['companyname'];*/

/*$q="SELECT 'USN','NAME','BRANCH','EMAIL','PHONE','CGPA','tenth percent','twelthpercent' UNION ALL SELECT s.USN, s.NAME, s.BRANCH, s.EMAIL, s.PHONE,s.CGPA, s.tenthPercent, s.twelthpercent INTO OUTFILE  '$fname' FIELDS TERMINATED BY  ',' OPTIONALLY ENCLOSED BY  '\"'  LINES TERMINATED BY  '\\n' FROM student as s , applied as a WHERE a.USN=s.USN and a.NAME = '$cname';";
$res = mysqli_query($con,$q);*/
$cname = $_GET['cname'];
$q = "select s.* from student as s , applied as a where s.USN = a.USN and a.NAME = '$cname'";
$result = mysqli_query($con,$q);
if($result) {

    while (($row = mysqli_fetch_assoc($result))) {
//        $row = array('asd','1234','qwerr');
        if($row['twelthPercent']==100)
        {   fputcsv($output, array($row['USN'],$row['NAME'],$row['BRANCH'],$row['EMAIL'],$row['PHONE'],$row['CGPA'],$row['tenthPercent'],'N/A',$row['diplomapercent']));}
        else if($row['diplomapercent']==100)
        {
            fputcsv($output,array( $row['USN'],$row['NAME'],$row['BRANCH'],$row['EMAIL'],$row['PHONE'],$row['CGPA'],$row['tenthPercent'],$row['twelthPercent'],'N/A'));
        }
        else
        {
            fputcsv($output,$row);
        }
    }
    }
else
{
    echo "error in query";
}
//print_r($con);
/*$download_file = $cname.time().'.csv';
// set the download rate limit (=> 20,5 kb/s)
$download_rate=20.5;

if(file_exists($fname) && is_file($fname))
{
    header('Cache-control: private');
    header('Content-Type: text/csv');
    header('Content-Length: '.filesize($fname));
    header('Content-Disposition: filename='.$download_file);
    flush();
    $file = fopen($fname, "r");
    while(!feof($file))
    {
        // send the current file part to the browser
        print fread($file, round($download_rate * 1024));
        // flush the content to the browser
        flush();
        // sleep one second
        sleep(4);
    }
    fclose($file);
}
else {
    die('Error: The file '.$fname.' does not exist!');
}*/



?>

