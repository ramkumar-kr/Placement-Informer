<?php
error_reporting(0);

session_start();
if ((!isset($_SESSION['username']))||(!isset($_SESSION['password'])))
{
    header('Location: ../');
}

$uname = $_SESSION['usernameT'];
$host="localhost"; // Host name or server name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="placementinformer"; // Database name
$tbl_name="student"; // Table name
$con = mysqli_connect("$host", "$username", "$password","$db_name");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$uname =  $_SESSION['userNameT'];
$result = mysqli_query($con,"SELECT * FROM spc where USN = '$uname';");
if(mysqli_num_rows($result)==0)
{
    header('Location: ../');
}

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>

    <link href='css/fullcalendar.css' rel='stylesheet' />
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


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Placement Informer</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="SHORTCUT ICON" href="images/rvce.ico">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLE CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="gener/genericons.css" rel="stylesheet">
    <link href="css/register-new-css/main.css" rel="stylesheet" />
    <link href="../css/bootstrapValidator.css" rel="stylesheet" />

    <link rel="stylesheet" href="css/amaran.min.css">
    <script src="js/jquery.amaran.min.js"></script>

    <?php
    if ((isset($_SESSION['reex'])))
    {

        $reex=$_SESSION['reex'];
//        echo "$appl";
        if($reex==1)
        {
//          echo "in";
            echo"<script>";
            echo'$(document).ready(function() {';
            echo'$(function(){';
            echo'$.amaran({content:{bgcolor:"#27ae60", color:"#fff","message":"Registration mails sent"}, theme:"colorful", delay:7000 });';
            echo'});';
            echo'});';
            echo "</script>";
        }else{
            echo"<script>";
            echo'$(document).ready(function() {';
            echo'$(function(){';
            echo'$.amaran({content:{{bgcolor:"#ff3333", color:"#fff","message":"Failed. Try again!"}, theme:"colorful", delay:7000});';
            echo'});';
            echo'});';
            echo "</script>";
        }
        unset($_SESSION['reex']);


    }

    if ((isset($_SESSION['retf'])))
    {

        $retf=$_SESSION['retf'];
//        echo "$appl";
        if($retf==1)
        {
//          echo "in";
            echo"<script>";
            echo'$(document).ready(function() {';
            echo'$(function(){';
            echo'$.amaran({content:{bgcolor:"#27ae60", color:"#fff","message":"Registration mail sent"}, theme:"colorful", delay:7000 });';
            echo'});';
            echo'});';
            echo "</script>";
        }else{
            echo"<script>";
            echo'$(document).ready(function() {';
            echo'$(function(){';
            echo'$.amaran({content:{{bgcolor:"#ff3333", color:"#fff","message":"Failed. Try again!"}, theme:"colorful", delay:7000});';
            echo'});';
            echo'});';
            echo "</script>";
        }
        unset($_SESSION['retf']);


    }

    ?>
    

</head>

<body>


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












    <div class="navbar navbar-inverse" id="head-nav">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
      <!--  <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Profile</a>
                    <span class="genericon genericon-menu"></span>
                </a>-->
      <!--  <div alt="f419" class="genericon genericon-menu"></div>
        -->
                <a class="navbar-brand" href="../" ><img src="images/rvce.jpg" class="img-circle img-responsive" class="img-responsive" id="logo" data-toggle='tooltip' data-placement='bottom' title='RVCE Placement Informer Year:2014-15'></a>

            </div>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li data-toggle='tooltip' data-placement='bottom' title='Calendar View'><a href="" class="menu" data-toggle="modal" data-target="#calenderModal" ><span class="glyphicon glyphicon-calendar"></span><span class="hidden-md hidden-lg hidden-sm"> &nbsp; Calendar View </span></a></li>
                    <li data-toggle='tooltip' data-placement='bottom' title='Send Notifications'><a href="notification.php" class="menu"  ><span class="glyphicon glyphicon-send"></span><span class="hidden-lg hidden-md hidden-sm"> &nbsp;&nbsp;Send Notifications</span></a></li>
                    <?php
                    //$result = mysqli_query($con,"SELECT * FROM SPC where USN = '$uname';");

                        echo "<li data-toggle='tooltip' data-placement='bottom' title='Student home page'><a href=\"studentHome.php\" class=\"menu\" ><span class='glyphicon glyphicon-inbox'></span><span class='hidden-lg hidden-md hidden-sm'> &nbsp;&nbsp;Student Page</span></a></li>";


                    ?>
                    <?php
                    echo "<li data-toggle='tooltip' data-placement='bottom' title='Coordinator home page'><a href=\"home-pc.php\" class=\"menu\" ><span class='glyphicon glyphicon-bullhorn'></span><span class='hidden-lg hidden-md hidden-sm'> &nbsp;&nbsp;Coordinator's page</span></a></li>";

                    ?>

                    <li data-toggle="tooltip" data-placement="bottom" title="Account Information"><a href="edit-profile.php" class="menu" ><span class="glyphicon glyphicon-user"></span><span class="hidden-lg hidden-md hidden-sm"> &nbsp;&nbsp;Account Information</span></a></li>

                    <li data-toggle="tooltip" data-placement="bottom" title="Logout"><a href="php/logout.php" class="menu" ><span class="glyphicon glyphicon-log-out"></span><span class="hidden-lg hidden-md hidden-sm"> &nbsp;&nbsp;Logout</span> </a></li>

                </ul>
            </div>

        </div>
        </div>

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


    <div class="row">

<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 vcentre">

    <br/>
        <div class="col-lg-offset-3 col-md-offset-3 head1"><h3 data-toggle='tooltip' data-placement='bottom' title='Create new accounts and invite students to use the website'>New student registrations</h3></div>

</div>
</div>

<br/>
<br/>
        <div class="row">

            <div id="body-content">
            <div class="a col-xs-10 col-sm-6 col-xs-offset-1 col-sm-offset-2 col-lg-offset-1 col-md-offset-1 col-md-4 col-lg-4 ">
<form class="form-horizontal"  name ="register-thro-excel" enctype="multipart/form-data" method ="post" id ="register-thro-excel" action = "<?php echo htmlspecialchars('php/register-thro-excel.php');?>">
<fieldset>

<!-- Form Name -->
<legend class="head1"data-toggle='tooltip' data-placement='bottom' title='Upload an excel file matching the template containing list of all students to be registered'>Register Students by uploading excel file</legend>

<div class="form-group">
    <a href="other/template.xls" class="col-md-12 in1 btn bg-info">Download Template excel file</a>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 in1 control-label" for="file">Excel File </label>
  <div class="col-md-4">
    <input id="file" name="file" class="input-file in4" type="file" required>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-success">Submit</button>
  </div>
</div>

</fieldset>
</form>
</div>
</div>



            <div id="body-content">
            <div class="a col-xs-10 col-sm-6 col-xs-offset-1 col-sm-offset-2 col-lg-offset-1 col-md-offset-1 col-md-4 col-lg-4 ">
<form class="form-horizontal" name ="register-thro-form" enctype="multipart/form-data" method ="post" id ="register-thro-form" action = "<?php echo htmlspecialchars('php/register-thro-form.php');?>">
<fieldset>

<!-- Form Name -->
<legend class="head1" data-toggle='tooltip' data-placement='left' title='Enter details of a student to register him/her for the website'>Register through single entry</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 in1 control-label" for="name">Name</label>  
  <div class="col-md-6">
  <input id="name" name="name" type="text" placeholder="Name" class="form-control in4 input-md" data-bv-notempty="true" data-bv-notempty-message=" Enter Student Name" >
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 in1 control-label" for="usn">USN</label>
  <div class="col-md-6">
  <input id="usn" name="usn" type="text" placeholder="USN" class="form-control in4 input-md"
         data-bv-notempty="true"
         data-bv-notempty-message="Enter valid USN"

         data-bv-regexp-regexp="^1RV[0-9]{2}[A-Z]{2}[0-9]{3}$"
         data-bv-regexp-message="Enter Valid USN"
         data-bv-stringlength="true"
         data-bv-stringlength-max="10"
         data-bv-stringlength-min="10"
         data-bv-stringlength-message="Enter Valid USN"
         data-bv-regexp="true">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 in1 control-label" for="email">Email id</label>
  <div class="col-md-6">
  <input id="email" name="email" type="email" placeholder="Email id" class="in4 form-control input-md"
         data-bv-emailaddress-message="The value is not a valid email address">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 in1 control-label" for="submit2"></label>
  <div class="col-md-4">
    <button id="submit2" name="submit2" type = "submit" class="btn btn-success">Submit</button>
  </div>
</div>

</fieldset>
</form>
</div>
</div>
</div>


<!-- <script type="text/javascript" src="./jquery1/jquery-1.8.3.min.js" charset="UTF-8"></script>

<!-- jQuery Version 1.11.0 
<script src="js/jquery-1.11.0.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#register-thro-form').bootstrapValidator({
            container:'tooltip',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            }});
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script src="../js/bootstrapValidator.min.js"></script>
</body>

</html>
