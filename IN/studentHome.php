<?php
error_reporting(0);
require('php/obtainfiles.php');
// Initialize session
session_start();



// Check, if username session is NOT set then this page will jump to login page
if ((!isset($_SESSION['username']))||(!isset($_SESSION['password']) )){
header('Location: ../');
}
if ((isset($_SESSION['appl'])))
{

    $appl=$_SESSION['appl'];
//        echo "$appl";
    if($appl==1)
    {
//        	echo "in";
        echo"<script>";
        echo'$(document).ready(function() {';
        echo'$(function(){';
        echo'$.amaran({content:{bgcolor:"#27ae60", color:"#fff","message":"Applied for the company"}, theme:"colorful", delay:7000 });';
        echo'});';
        echo'});';
        echo "</script>";
    }else if($appl==2){
        echo"<script>";
        echo'$(document).ready(function() {';
        echo'$(function(){';
        echo'$.amaran({content:{{bgcolor:"#ff3333", color:"#fff","message":"U have crossed the deadline!"}, theme:"colorful", delay:7000});';
        echo'});';
        echo'});';
        echo "</script>";
    }else{
        echo"<script>";
        echo'$(document).ready(function() {';
        echo'$(function(){';
        echo'$.amaran({content:{{bgcolor:"#ff3333", color:"#fff","message":"Apply to company failed. Try again!"}, theme:"colorful", delay:7000});';
        echo'});';
        echo'});';
        echo "</script>";
    }
    unset($_SESSION['appl']);


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<style>

	body {
		/*margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	*/}

	

</style>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="SHORTCUT ICON" href="images/rvce.ico">
    <link href='css/fullcalendar.css' rel='stylesheet' />
    <link href="../css/bootstrapValidator.css" rel="stylesheet" />
<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='js/lib/moment.min.js'></script>
<script src='js/lib/jquery.min.js'></script>
<script src='js/fullcalendar.min.js'></script>
    <?php

    echo "<script>";

    echo "$(document).ready(function() {";

    echo "$('#calenderModal').on('shown.bs.modal', function () {";
    echo "$(\"#calendar\").fullCalendar('render');";
    echo "});";

    echo "$('#calendar').fullCalendar({";

    echo "header: {";
    echo "left: 'prev,next today',";
    echo "center: 'title',";
    echo "right: 'month,basicWeek,basicDay'";
    echo "},";

    echo "eventRender: function (event, element) {";
            echo "element.attr('href', 'javascript:void(0);');";
            echo "element.click(function() {";
                //set the modal values and open
                echo "$('#companyHead').html(event.title);";
                echo "$('#package').html(event.package);";
                echo "$('#cgpa').html(event.cgpa);";
                echo "$('#puc').html(event.puc);";
                echo "$('#profile').html(event.profile);";
                echo "$('#tenth').html(event.tenth);";
                echo "$('#diploma').html(event.diploma);";
                echo "$('#deadline').html(event.deadline);";
                echo "$('#branches').html(event.branches);";
              //  $('#modalBody').html(event.description);
               // $('#eventUrl').attr('href',event.url);
                echo "$('#companyModal').modal();";
            echo "});";
        	echo "},";

    $date = date('Y-m-d');
    echo "defaultDate: '" . $date  . "',";
	echo "editable: true,";
    echo "eventLimit: true,"; // allow "more" link when too many events
    $host="localhost"; // Host name or server name
    $username="root"; // Mysql username
    $password=""; // Mysql password
    $db_name="placementinformer"; // Database name
    $tbl_name="student"; // Table name
    $con = mysqli_connect("$host", "$username", "$password","$db_name");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    session_start();
    $uname =  $_SESSION['userNameT'];
    $result = mysqli_query($con,"SELECT c.* , d.DATE , j.PROFILE  FROM dateofvisit as d , company as c , jobprofile as j where c.NAME = d.NAME and c.NAME = j.NAME;");

    //$result1 = mysqli_query($con,"SELECT * FROM company;");
    if(!$result)
    {
        echo "error";
    }

    echo "events: [";
    while($db_field = mysqli_fetch_assoc($result)) {
        echo "{";
        echo "title: '" . $db_field['NAME'] . "',";
        echo "start: '" . $db_field['DATE'] . "',";
        echo "profile:'" . $db_field['PROFILE'] . "',";
        echo "url: '" . "company.php?name=" . $db_field['NAME'] . "',";
        echo "package:'" . $db_field['PACKAGE'] . "',";
        echo "cgpa:'" . $db_field['GPACUTOFF'] . "',";
        echo "tenth:'" . $db_field['TENTHCUTOFF'] . "',";
        echo "puc:'" . $db_field['PUCCUTOFF'] . "',";
        echo "diploma:'" . $db_field['DIPLOMACUTOFF'] . "',";
        echo "deadline:'" . $db_field['lastDateReg'] . "',";
        
        $branchesArray = "";
        $cname1 = $db_field['NAME'];
        $result1 = mysqli_query($con,"select * from brancheseligible where name = '$cname1';");
        while($db_field1 = mysqli_fetch_assoc($result1)) {
        		 $branchesArray .= $db_field1['branch'] . "  ";
        }
        echo "branches: '" . $branchesArray . "'";
        echo "},";
    }
    echo "]";
    echo "});";


    echo "});";

    echo "</script>";
    ?>


    <title>Placement Informer</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	 <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Student Home</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLE CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />    
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	<link href="gener/genericons.css" rel="stylesheet">
	<link href="css/index-css/main.css" rel="stylesheet" />

	<link rel="stylesheet" href="css/amaran.min.css">
    <script src="js/jquery.amaran.min.js"></script>



    <?php
    if ((isset($_SESSION['appl'])))
    {

        $appl=$_SESSION['appl'];
//        echo "$appl";
        if($appl==1)
        {
//        	echo "in";
            echo"<script>";
            echo'$(document).ready(function() {';
            echo'$(function(){';
            echo'$.amaran({content:{bgcolor:"#27ae60", color:"#fff","message":"Applied for the company"}, theme:"colorful", delay:7000 });';
            echo'});';
            echo'});';
            echo "</script>";
        }else if($appl==2){
            echo"<script>";
            echo'$(document).ready(function() {';
            echo'$(function(){';
            echo'$.amaran({content:{{bgcolor:"#ff3333", color:"#fff","message":"U have crossed the deadline!"}, theme:"colorful", delay:7000});';
            echo'});';
            echo'});';
            echo "</script>";
        }
        else if($appl==3){
            echo"<script>";
            echo'$(document).ready(function() {';
            echo'$(function(){';
            echo'$.amaran({content:{{bgcolor:"#ff3333", color:"#fff","message":"You have successfully cancelled your registration"}, theme:"colorful", delay:7000});';
            echo'});';
            echo'});';
            echo "</script>";
        }
        else{
            echo"<script>";
            echo'$(document).ready(function() {';
            echo'$(function(){';
            echo'$.amaran({content:{{bgcolor:"#ff3333", color:"#fff","message":"Apply to company failed. Try again!"}, theme:"colorful", delay:7000});';
            echo'});';
            echo'});';
            echo "</script>";
        }
        unset($_SESSION['appl']);


    }

    ?>
    
    
</head>

<body>


<!--    <div id="wrapper" class="toggled">



        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    Profile
                </li>
                <li>
                    Name -
					<?php
						$host="localhost"; // Host name or server name
						$username="root"; // Mysql username
						$password=""; // Mysql password
						$db_name="placementinformer"; // Database name
						$tbl_name="student"; // Table name
						$con = mysqli_connect("$host", "$username", "$password","$db_name");
						if (mysqli_connect_errno()) {
						  echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
						session_start();
						$uname =  $_SESSION['userNameT'];
						$result = mysqli_query($con,"SELECT name FROM student where USN = '$uname';");
						while($db_field=mysqli_fetch_assoc($result))
						{
							echo $db_field['name'];
						}
					?>
                </li>
				<li>
                    Email -
					<?php
						$result = mysqli_query($con,"SELECT email FROM student where USN = '$uname';");
						while($db_field=mysqli_fetch_assoc($result))
						{
							echo $db_field['email'];
						}
					?>
                </li>
				<li>
                    USN -
					<?php
						$result = mysqli_query($con,"SELECT usn FROM student where USN = '$uname';");
						while($db_field=mysqli_fetch_assoc($result))
						{
							echo $db_field['usn'];
						}
					?>
                </li>
				<li>
                    Branch -
					<?php
						$result = mysqli_query($con,"SELECT branch FROM student where USN = '$uname';");
						while($db_field=mysqli_fetch_assoc($result))
						{
							echo $db_field['branch'];
						}
					?>
                </li>
				<li>
                    CGPA -
					<?php
						$result = mysqli_query($con,"SELECT cgpa FROM student where USN = '$uname';");
						while($db_field=mysqli_fetch_assoc($result))
						{
							echo $db_field['cgpa'];
						}
					?>
                </li>
                <li>
                    10th % -
					<?php

						$result = mysqli_query($con,"SELECT tenthPercent FROM student where USN = '$uname';");
						while($db_field=mysqli_fetch_assoc($result))
						{
							echo $db_field['tenthPercent'];
						}
					?>
                </li>
                <li>
                    12th % -
					<?php
						$result = mysqli_query($con,"SELECT twelthPercent FROM student where USN = '$uname';");
						while($db_field=mysqli_fetch_assoc($result))
						{
							echo $db_field['twelthPercent'];
						}
					?>
                </li>
				<li>
                    Contact -
					<?php
						$result = mysqli_query($con,"SELECT phone FROM student where USN = '$uname';");
						while($db_field=mysqli_fetch_assoc($result))
						{
							echo $db_field['phone'];
						}
					?>
                </li>
                <li>
                    <a href="#">Update?</a>
                </li>

            </ul>
        </div>-->
        <!-- /#sidebar-wrapper
		<div id="page-content-wrapper">
-->





	<div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="companyModal" aria-hidden="true" style="z-index:10000">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#7cc0bf;">
            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
                <h4 class="modal-title head1" id="companyHead"></h4>
            </div>
            <div class="modal-body" style="background-color:#eeeeee;">
                    <fieldset>


                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label in3" for="curpass">Package:</label>
                            <div class="col-md-5">
                                <div id="package" >
                                </div>
                            </div>
                        </div>
                        <br>

						<div class="form-group">
                            <label class="col-md-4 control-label in3" for="curpass">Profile:</label>
                            <div class="col-md-5">
                                <div id="profile" >
                                </div>
                            </div>
                        </div>     
                        <br>

                        <div class="form-group">
                            <label class="col-md-4 control-label in3" for="curpass">CGPA Cutoff:</label>
                            <div class="col-md-5">
                                <div id="cgpa" >
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <label class="col-md-4 control-label in3" for="curpass">PUC Cutoff:</label>
                            <div class="col-md-5">
                                <div id="puc" >
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <label class="col-md-4 control-label in3" for="curpass">Diploma Cutoff:</label>
                            <div class="col-md-5">
                                <div id="diploma" >
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <label class="col-md-4 control-label in3" for="curpass">10th Cutoff:</label>
                            <div class="col-md-5">
                                <div id="tenth" >
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <label class="col-md-4 control-label in3" for="curpass">Deadline:</label>
                            <div class="col-md-5">
                                <div id="deadline" >
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <label class="col-md-4 control-label in3" for="curpass">Branches Eligible:</label>
                            <div class="col-md-8">
                                <div id="branches" >
                                </div>
                            </div>
                        </div>

                        <br>
                        <br>                   <!-- Password input-->


                    </fieldset>


            </div>
            
        </div>
    </div>
</div>
</div>



	



		<div class="navbar navbar-inverse" id="head-nav" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
			<!--	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Profile</a>
                    <span class="genericon genericon-menu"></span>
                </a>-->
			<!--	<div alt="f419" class="genericon genericon-menu"></div>
        -->
                <a class="navbar-brand" href="../" ><img src="images/rvce.jpg" class="img-circle img-responsive" class="img-responsive" id="logo" data-toggle='tooltip' data-placement='bottom' title='RVCE Placement Informer Year:2014-15'></a>

            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right" >
                    <li data-toggle='tooltip' data-placement='bottom' title='Calendar View'><a href="" class="menu" data-toggle="modal" data-target="#calenderModal" ><span class="glyphicon glyphicon-calendar"></span><span class="hidden-md hidden-lg hidden-sm"> &nbsp; Calendar View </span></a></li>
                    <?php
                    $result = mysqli_query($con,"SELECT * FROM spc where USN = '$uname';");
                    if(mysqli_num_rows($result)>0)
                    {
                        echo "<li data-toggle='tooltip' data-placement='bottom' title='Coordinator home page'><a href=\"home-pc.php\" class=\"menu\" ><span class='glyphicon glyphicon-bullhorn'></span><span class='hidden-lg hidden-md hidden-sm hidden-sm'> &nbsp;&nbsp;Coordinator's page</span></a></li>";

                    }
                    ?>
                    <li data-toggle="tooltip" data-placement="bottom" title="Account Information"><a href="edit-profile.php" class="menu" ><span class="glyphicon glyphicon-user"></span><span class="hidden-lg hidden-md hidden-sm"> &nbsp;&nbsp;Account Information</span></a></li>

                    <li data-toggle="tooltip" data-placement="bottom" title="Logout"><a href="php/logout.php" class="menu" ><span class="glyphicon glyphicon-log-out"></span><span class="hidden-lg hidden-md hidden-sm"> &nbsp;&nbsp;Logout</span> </a></li>

                </ul>
            </div>

        </div>
        </div>
	<!--	</div>-->

<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#FF9F85;">
                <h4 class="modal-title head1" id="myModalLabel">Change Password</h4>
            </div>
            <div class="modal-body" style="background-color:#eeeeee;">
                <form class="form-horizontal" method="post" name =  "changePass" action = 'php/changePassword.php' id = "changePass">
                    <fieldset>


                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label in3" for="curpass">Current Password</label>
                            <div class="col-md-5">
                                <input id="curpass" name="curpass" type="password" placeholder="Current Password" class="form-control input-md" data-bv-notempty="true" data-bv-notempty-message="The password is required and cannot be empty" data-bv-stringlength="true" data-bv-stringlength-min="8" data-bv-stringlength-message="The password must have at least 8 characters">

                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label in3" for="newpass">New Password</label>
                            <div class="col-md-5">
                                <input id="newpass" name="newpass" type="password" placeholder="New Password" class="form-control input-md" data-bv-notempty="true" data-bv-notempty-message="The password is required and cannot be empty" data-bv-stringlength="true" data-bv-stringlength-min="8" data-bv-stringlength-message="The password must have at least 8 characters"
                                       data-bv-different="true"
                                       data-bv-different-field="curpass"
                                       data-bv-different-message="The old and new password cannot be the same" >
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label in3" for="connewpass">Confirm New Password</label>
                            <div class="col-md-5">
                                <input id="connewpass" name="connewpass" type="password" placeholder="Confirm New Password" class="form-control input-md"
                                       data-bv-notempty="true" data-bv-notempty-message="The confirm password is required and cannot be empty"
                                       data-bv-identical="true" data-bv-identical-field="newpass" data-bv-identical-message="Passwords do not match"
                                       data-bv-different="true" data-bv-different-field="curpass" data-bv-different-message="The old and password cannot be the same" >
                            </div>
                        </div>

                    </fieldset>


            </div>
            <div class="modal-footer" style="background-color:#eeeeee;" >
                <a href="#" style="position:relative; float:left; color:#558188">Forgot password?</a>
                <input type="reset" class="btn btn-default" data-dismiss="modal" value="Close">
                <input type="submit" name = "submit1" class="btn btn-success" value="Save changes">
            </div>
            </form>
        </div>
    </div>
</div>
</div>
  

    <div class="modal fade" id="calenderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header" style="background-color:#FF9F85;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
            <h4 class="modal-title head1" id="myModalLabel" >Calender View</h4>
            </div>
            <div class="modal-body" style="background-color:#eeeeee;">
                
    			<div id='calendar'></div>
            </div>
          
    </div>
  	</div>
	</div>






        <!-- Page Content
		<div id="page-content-wrapper">-->
		<div id="body-content">
		<h4 class="panel-heading">
        <strong class="head1" data-toggle='tooltip' data-placement='bottom' title='Company Visiting Today'>Today's Company</strong>
        </h4>

		<?php
		$result = mysqli_query($con,"SELECT branch FROM student where USN = '$uname';");
		$date = date('Y-m-d');

		$db_field=mysqli_fetch_assoc($result);
		$branch = $db_field['branch'];
	//	$result = mysqli_query($con,"SELECT * FROM company where name in (select b.name from dateofvisit as d , brancheseligible as b where d.date = '$date' and b.branch = '$branch' )");
        $date = date('Y-m-d');
		$result = mysqli_query($con,"SELECT distinct c.* FROM company as c,dateofvisit as d, brancheseligible as b where c.NAME = d.name and c.name = b.name and d.date = '$date' and b.branch = '$branch';");

		if(mysqli_num_rows($result)==0)
		{
			echo "<div class=\"container-fluid col in1\" >";
			echo "No company today";
			echo "</div>";

		}
		else
		{

		while($db_field=mysqli_fetch_assoc($result))
		{
			//print_r($db_field);
			echo "<div class=\"container-fluid\" >";
			echo "<div class=\"col-md-4 col-sm-6 col-lg-4 col-xs-12 each in1\">Name:";
			$companyName = $db_field['NAME'];

			echo "<span class='in2' style='margin-left:10px;'>".$companyName."</span>";
			echo "</div>";



			echo "<div class=\"col-md-4 col-sm-6 col-lg-4 col-xs-12 each in1\">Profile:";
			$resultProfile = mysqli_query($con,"SELECT * FROM jobprofile where NAME = '".$companyName."'");
			while($db_field_profile=mysqli_fetch_assoc($resultProfile))
			{
				echo "<span class='in2' style='margin-left:10px;'>".$db_field_profile['PROFILE'].", "."</span>";
			}
			echo "</div>";


			echo "<div class=\"col-md-2 col-sm-6 col-lg-2 col-xs-12 each in1\">Package:";
			echo "<span class='in2' style='margin-left:10px;'>".$db_field['PACKAGE']."LPA"."</span>";
			echo "</div>";
?><div class="col-md-2 col-sm-3 col-lg-2 col-xs-6 each1">

        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            Attachments <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php obtainfiles($companyName);?>
            </ul>
        </div>
</div>
<?php
			//$resultEligibility = mysqli_query($con,"SELECT * FROM student where NAME = '".$uname."' and branch in (select branch	from brancheseligible where NAME = '".$companyName."'");
			$resultEligibility = mysqli_query($con,"SELECT * FROM student where (USN = '".$uname."' and CGPA > ".$db_field['GPACUTOFF']." and tenthPercent > ".$db_field['TENTHCUTOFF']." and	twelthPercent > ".$db_field['PUCCUTOFF']." and diplomapercent > ".$db_field['DIPLOMACUTOFF'].") ");
			$numRows = mysqli_num_rows($resultEligibility);
			if($numRows!=0)
			{
				echo "<div class=\"col-md-2 col-sm-3 col-lg-2 col-xs-6 each1\"> <button type=\"button\" class=\"btn btn-success\">Registered</button></div>";
			}
			else
			{
				echo "<div class=\"col-md-2 col-sm-3 col-lg-2 col-xs-6 each1\"> <button type=\"button\" class=\"btn btn-danger\"> Not Eligible</button></div>";
			}
		echo "</div>";


		// if($numRows!=0)
		// {
			// echo "<div class=\"col-md-2 col-sm-6 col-lg-2 col-xs-12 each1\"> <button type=\"button\" class=\"btn btn-success\">Register</button></div>";
		// }
		// else
		// {
			// echo "<div class=\"col-md-1 col-sm-6 col-lg-1 col-xs-12 each1\"> <button type=\"button\" class=\"btn btn-danger\">Not eligible</button></div>";
		// }



		}
		}
		?>


		<h4 class="panel-heading">
        <strong class="head1" data-toggle='tooltip' data-placement='bottom' title='Companies yet to visit the campus'>Upcoming Companies</strong>
        </h4>
		<?php

		$result = mysqli_query($con,"SELECT branch FROM student where USN = '$uname';");
		$db_field=mysqli_fetch_assoc($result);
		$branch = $db_field['branch'];
        $date = date('Y-m-d');
        $result = mysqli_query($con,"SELECT distinct c.* FROM company as c,dateofvisit as d, brancheseligible as b where c.NAME = d.name and c.name = b.name and d.date > '$date' and b.branch = '$branch' order by c.lastDateReg;");

        //$result = mysqli_query($con,"SELECT * FROM company where name in (select b.name from dateofvisit as d , brancheseligible as b where d.date > curdate() and b.branch = '$branch' )");

        if(mysqli_num_rows($result)==0)
        {
            echo "<div class=\"container-fluid col in1\" >";
            echo "No Upcoming Companies";
            echo "</div>";

        }


        while($db_field=mysqli_fetch_assoc($result))
		{
			//print_r($db_field);
			echo "<div class=\"container-fluid\" >";


			echo "<div class=\"col-md-4 col-sm-6 col-lg-4 col-xs-12 each in1\">Name:";
			$companyName = $db_field['NAME'];
			echo "<span class='in2' style='margin-left:10px;'>".$companyName."</span>";
			echo "</div>";


			echo "<div class=\"col-md-4 col-sm-6 col-lg-4 col-xs-12 each in1\" >Date:"."</span>";
			$resultDates = mysqli_query($con,"SELECT * FROM dateofvisit where NAME = '".$companyName."'");
			while($db_field_dates=mysqli_fetch_assoc($resultDates))
			{
				echo "<span class='in2' style='margin-left:10px;'>".$db_field_dates['DATE']." "."</span>";
			}
			echo "</div>";


			echo "<div class=\"col-md-4 col-sm-6 col-lg-4 col-xs-12 each in1\">Profile:";
			$resultProfile = mysqli_query($con,"SELECT * FROM jobprofile where NAME = '".$companyName."'");
			while($db_field_profile=mysqli_fetch_assoc($resultProfile))
			{
				echo "<span class='in2' style='margin-left:10px;'>".$db_field_profile['PROFILE'].", "."</span>";
			}
			echo "</div>";


			

			echo "<div class=\"col-md-4 col-sm-6 col-lg-4 col-xs-12 each in1\">Package:";
			echo "<span class='in2' style='margin-left:10px;'>".$db_field['PACKAGE']."</span>";
			echo "</div>";


			echo "<div class=\"col-md-4 col-sm-6 col-lg-4 col-xs-12 each in1\">Register Before:";
			echo "<span class='in2' style='margin-left:10px;'>".$db_field['lastDateReg']."</span>";
			echo "</div>";?>
            <div class="col-md-2 col-sm-3 col-lg-2 col-xs-6 each1">

        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                Attachments <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php obtainfiles($companyName);?>
            </ul>
            </div>
</div>

            <?php
			//$resultEligibility = mysqli_query($con,"SELECT * FROM student where NAME = '".$uname."' and branch in (select branch	from brancheseligible where NAME = '".$companyName."'");
			$resultEligibility = mysqli_query($con,"SELECT * FROM student where (USN = '".$uname."' and CGPA > ".$db_field['GPACUTOFF']." and tenthPercent > ".$db_field['TENTHCUTOFF']." and	(twelthPercent > ".$db_field['PUCCUTOFF']." or diplomapercent > ".$db_field['DIPLOMACUTOFF'].")) ");
			$numRows = mysqli_num_rows($resultEligibility);
			if($numRows!=0)
			{
                $resultRegistered = mysqli_query($con,"SELECT * FROM applied as a where a.USN = '$uname' and a.NAME = '$companyName';");
                $numRows1 = mysqli_num_rows($resultRegistered);
                $deadline = $db_field['lastDateReg'];
                $timestampp = new DateTime();
                $datetime= $timestampp->format('Y-m-d H:i:s');
                if($deadline>$datetime) {
                    if ($numRows1 != 0) {
                        $url = "php/unapplycompany.php?cname=" . $companyName;
                        echo "<div class=\"col-md-2 col-sm-3 col-lg-2 col-xs-6 each1\"> <a type=\"button\"  class=\"btn btn-warning\" href='" . $url . "'>Cancel</a></div>";
                    } else {
                        $url = "php/applytocompany.php?cname=" . $companyName;
                        echo "<div class=\"col-md-2 col-sm-3 col-lg-2 col-xs-6 each1\"> <a type=\"button\" class=\"btn btn-success\" href='" . $url . "'>Register</a></div>";
                    }
                }
                else
                {
                    if ($numRows1 != 0) {

                        echo "<div class=\"col-md-2 col-sm-3 col-lg-2 col-xs-6 each1\"> <a type=\"button\"  class=\"btn btn-success disabled\" href='" . $url . "'>Registered</a></div>";
                    } else {

                        echo "<div class=\"col-md-2 col-sm-3 col-lg-2 col-xs-6 each1\"> <a type=\"button\" class=\"btn btn-success disabled\" href='" . $url . "'>Not Registered</a></div>";
                    }
                }}
            else
			{
				echo "<div class=\"col-md-2 col-sm-6 col-lg-2 col-xs-12 each1 pull-right\"> <button type=\"button\" class=\"btn btn-danger\">Not eligible</button></div>";
			}

			echo "</div>";
		}
		?>

	</div>
        <!--</div>
         /#page-content-wrapper -->

   <!-- </div>-->
	
    <!-- /#wrapper
<script type="text/javascript" src="./jquery1/jquery-1.8.3.min.js" charset="UTF-8"></script>
    <!-- jQuery Version 1.11.0 
    <script src="js/jquery-1.11.0.js"></script>-->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Attachments</h4>
      </div>
      <div class="modal-body"><?php

          obtainfiles($companyName);
          ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
<script src="../js/bootstrapValidator.min.js"></script>
<script>
$(document).ready(function() {
$('#changePass').bootstrapValidator({feedbackIcons: {
valid: 'glyphicon glyphicon-ok',
invalid: 'glyphicon glyphicon-remove',
validating: 'glyphicon glyphicon-refresh'
        }
    });
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
    <!-- Menu Toggle Script -->
    

</body>

</html>
