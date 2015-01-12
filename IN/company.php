<?php
error_reporting(0);
require('php/obtainfiles.php');
// Initialize session
session_start();



// Check, if username session is NOT set then this page will jump to login page
if ((!isset($_SESSION['username']))||(!isset($_SESSION['password']) )){
header('Location: ../');
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
<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='js/lib/moment.min.js'></script>
<script src='js/lib/jquery.min.js'></script>
<script src='js/fullcalendar.min.js'></script>
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
    $result = mysqli_query($con,"SELECT * FROM dateofvisit;");
    if(!$result)
    {
        echo "error";
    }
    while($db_field = mysqli_fetch_assoc($result))
    {
        echo "title: '" . $db_field['NAME'] . "'";
        echo "start: '" . $db_field['DATE'] . "'";
    }echo ",";

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
    echo "defaultDate: '2014-09-12',";
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
    $result = mysqli_query($con,"SELECT * FROM dateofvisit;");
    if(!$result)
    {
        echo "error";
    }

    echo "events: [";
    while($db_field = mysqli_fetch_assoc($result)) {
        echo "{";
        echo "title: '" . $db_field['NAME'] . "',";
        echo "start: '" . $db_field['DATE'] . "',";
        echo "url: '" . "company.php?name=" . $db_field['NAME'] . "'";
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
    
</head>

<body>
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
						
					?>
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
           <a class="navbar-brand" href="#"><img src="images/rvce.jpg" class="img-circle" class="img-responsive" id="logo"></a>

            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right" >
                	<li><a href="" class="menu" data-toggle="modal" data-target="#calenderModal" >Calender View</a></li>
                    <?php
                    $result = mysqli_query($con,"SELECT * FROM SPC where USN = '$uname';");
                    if(mysqli_num_rows($result)>0)
                    {
                        echo "<li ><a class=\"menu\" href=\"home-pc.php\"  >PC View</a></li>";
                        echo "<li ><a class=\"menu\" href=\"register-new.php\" >Add students</a></li>";
                    }
                    ?>
                    <li><a href="edit-profile.php" class="menu" >Edit Profile</a></li>
                    <li><a href="" class="menu" data-toggle="modal" data-target="#basicModal" >Change Password?</a></li>
                    <li><a href="php/logout.php" class="menu" >Logout</a></li>

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
                    <form class="form-horizontal" method="post" name =  "changePass" action = "<?php echo htmlspecialchars('php/changePassword.php');?>" id = "changePass">
                        <fieldset>


                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label in3" for="curpass">Current Password</label>
                                <div class="col-md-5">
                                    <input id="curpass" name="curpass" type="password" placeholder="Current Password" class="form-control input-md">
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label in3" for="newpass">New Password</label>
                                <div class="col-md-5">
                                    <input id="newpass" name="newpass" type="password" placeholder="New Password" class="form-control input-md">
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label in3" for="connewpass">Confirm New Password</label>
                                <div class="col-md-5">
                                    <input id="connewpass" name="connewpass" type="password" placeholder="Confirm New Password" class="form-control input-md">
                                </div>
                            </div>

                        </fieldset>


                </div>
                <div class="modal-footer" style="background-color:#eeeeee;" >
                    <a href="#" style="position:relative; float:left; color:#558188">Forgot password?</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name = "submit" class="btn btn-success" action = "<?php echo htmlspecialchars('php/changePassword.php');?>" id = "submit">Save changes</button>
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




    <h2 id="co">MicroSoft</h2>
    




<script src="js/bootstrap.min.js"></script>
</body>
</html>
