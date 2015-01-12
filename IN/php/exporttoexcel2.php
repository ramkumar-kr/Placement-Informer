<?php

// Initialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if ((!isset($_SESSION['username']))||(!isset($_SESSION['password']) )){
    header('Location: ../');
}


$host="localhost"; // Host name or server name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="placementinformer"; // Database name
//echo "assddsfghj";
$con = mysqli_connect("$host", "$username", "$password","$db_name");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$data=array(
    array('R V College of Engineering',' ','List of Registered Applicants'),
    array('Company Name ',$_GET['cname']),
    array(''),
    array('USN', 'Name', 'Branch' , 'Email-ID' , 'Phone' , 'CGPA' , 'Tenth Percentage' , 'Twelfth Percentage' , 'Diploma Percentage')
);
$uname=$_SESSION['username'];
$cname = $_GET['cname'];

/** Error reporting */
error_reporting(E_ALL);

/** Include path **/
ini_set('include_path', ini_get('include_path').';../Classes/');

/** PHPExcel */
include 'excel/PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'excel/PHPExcel/Writer/Excel2007.php';

// Create new PHPExcel object
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=\"".$cname.".xlsx\"");
header("Cache-Control: max-age=0");

$objPHPExcel = new PHPExcel();

// Set properties

$objPHPExcel->getProperties()->setCreator("Placement Informer - RVCE");
$objPHPExcel->getProperties()->setLastModifiedBy("Placement Informer - RVCE");
$objPHPExcel->getProperties()->setTitle("List of Registered Applicants");
$objPHPExcel->getProperties()->setSubject("List of Registered Applicants");
$objPHPExcel->getProperties()->setDescription("Generated file containing list of registered applicants");


// Add some data

$objPHPExcel->setActiveSheetIndex(0);
/*$data = array(
    array ('Name', 'Surname'),
    array('Schwarz', 'Oliver'),
    array('Test', 'Peter')
);

*/

$q = "select s.* from student as s , applied as a where s.USN = a.USN and a.NAME = '$cname'";
$result = mysqli_query($con,$q);


if($result) {

    while (($row = mysqli_fetch_assoc($result))) {
        //print_r($row);
        if($row['twelthPercent']==100){
        array_push($data, array($row['USN'],$row['NAME'],$row['BRANCH'],$row['EMAIL'],$row['PHONE'],$row['CGPA'],$row['tenthPercent'],'N/A',$row['diplomapercent']));}
        else if($row['diplomapercent']==100)
        {
            array_push($data,array( $row['USN'],$row['NAME'],$row['BRANCH'],$row['EMAIL'],$row['PHONE'],$row['CGPA'],$row['tenthPercent'],$row['twelthPercent'],'N/A'));
        }
        else
        {
            array_push($data,$row);
        }
    }
}
else
{
    echo "error in executing query. Please Try Again";
}

$objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1');// Rename sheet

$objPHPExcel->getActiveSheet()->setTitle($_GET['cname']);


// Save Excel 2007 file

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

$file = $_GET['cname'] . '.xlsx';
$objWriter->save("php://output");

?>
// Echo done
