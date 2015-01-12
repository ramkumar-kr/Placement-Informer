<?php
error_reporting(0);


session_start();

if ((!isset($_SESSION['username']))||(!isset($_SESSION['password'])))
{
    header('Location: ../');
}


$host="localhost"; // Host name or server name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="placementinformer"; // Database name
$tbl_name="student"; // Table name
$con = mysqli_connect("$host", "$username", "$password","$db_name");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//session_start();
$uname =  $_SESSION['userNameT'];
$result = mysqli_query($con,"SELECT name FROM student where USN = '$uname';");

?>

<!DOCTYPE html>
<html lang="en">

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
    <link href="../css/bootstrapValidator.css" rel="stylesheet" />
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


    <link href="css/edit-profile-css/main.css" rel="stylesheet" />

    <?php
    require_once('php/dbconnector.php');
    session_start();
    $uname =  $_SESSION['userNameT'];

    ?>
    <link rel="stylesheet" href="css/amaran.min.css">
    <script src="js/jquery.amaran.min.js"></script>



    <?php
    if ((isset($_SESSION['edit_profile'])))
    {

        $edit_profile=$_SESSION['edit_profile'];
        if($edit_profile==1)
        {
            echo"<script>";
            echo'$(document).ready(function() {';
            echo'$(function(){';
            echo'$.amaran({content:{bgcolor:"#27ae60", color:"#fff","message":"Profile edit sucess"}, theme:"colorful", delay:7000 });';
            echo'});';
            echo'});';
            echo "</script>";
        }else{
            echo "inside";
            echo"<script>";
            echo'$(document).ready(function() {';
            echo'$(function(){';
            echo'$.amaran({content:{{bgcolor:"#ff3333", color:"#fff","message":"Profile Edit Failed. Try again!"}, theme:"colorful", delay:7000});';
            echo'});';
            echo'});';
            echo "</script>";
        }
        unset($_SESSION['edit_profile']);


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

                <?php
                $result = mysqli_query($con,"SELECT * FROM spc where USN = '$uname';");
                if(mysqli_num_rows($result)>0)
                {
                    echo "<li data-toggle='tooltip' data-placement='bottom' title='Send Notifications'><a href=\"notification.php\" class='menu'  ><span class='glyphicon glyphicon-send'></span><span class='hidden-lg hidden-md hidden-sm'> &nbsp;&nbsp;Send Notifications</span></a></li>";


                }
                ?>
                <?php
                $result = mysqli_query($con,"SELECT * FROM spc where USN = '$uname';");
                if(mysqli_num_rows($result)>0)
                {
                    echo "<li data-toggle='tooltip' data-placement='bottom' title='Student home page'><a href=\"studentHome.php\" class=\"menu\" ><span class='glyphicon glyphicon-inbox'></span><span class='hidden-lg hidden-md hidden-sm'> &nbsp;&nbsp;Student Page</span></a></li>";
                    echo "<li data-toggle='tooltip' data-placement='bottom' title='Coordinator home page'><a href=\"home-pc.php\" class=\"menu\" ><span class='glyphicon glyphicon-bullhorn'></span><span class='hidden-lg hidden-md hidden-sm'> &nbsp;&nbsp;Coordinator's page</span></a></li>";
                    echo "<li data-toggle='tooltip' data-placement='bottom' title='Add Students'><a href=\"register-new.php\" class=\"menu\" ><span class='glyphicon glyphicon-plus'></span><span class='hidden-lg hidden-md hidden-sm'> &nbsp;&nbsp;Add Students</span></a></li>";
                }
                else
                {
                    echo "<li data-toggle='tooltip' data-placement='bottom' title='Student home page'><a href=\"studentHome.php\" class=\"menu\" ><span class='glyphicon glyphicon-inbox'></span><span class='hidden-lg hidden-md hidden-sm'> &nbsp;&nbsp;Student Page</span></a></li>";
                }
                ?>

                <li data-toggle="tooltip" data-placement="bottom" title="Change Password"><a href="" class="menu" data-toggle="modal" data-target="#basicModal" ><span class="glyphicon glyphicon-lock"></span><span class="hidden-lg hidden-md hidden-sm"> &nbsp;&nbsp;Change Password</span></a></li>
                <li data-toggle="tooltip" data-placement="bottom" title="Logout"><a href="php/logout.php" class="menu" ><span class="glyphicon glyphicon-log-out"></span><span class="hidden-lg hidden-md hidden-sm"> &nbsp;&nbsp;Logout</span> </a></li>
            </ul>
        </div>

    </div>
</div>

<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog ">
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
                            <div class="col-md-5 ">
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
                            <label class="col-md-4  control-label in3" for="connewpass">Confirm New Password</label>
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

                <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                <button type="submit" name = "submit" class="btn btn-success" action = "<?php echo htmlspecialchars('php/changePassword.php');?>" id = "submit">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="calenderModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog" >
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









<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 vcentre">



    <form class="form-horizontal" name = "edit-profile" method = "post"  id = "edit-profile" action = "php/edit-profile-insert.php">
        <fieldset>
            <!-- Form Name -->
            <legend class="head1"> My Account Information</legend>

            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 in1 control-label" for="usn">USN</label>
                <div class="col-md-5">
                    <?php
                    $result = mysqli_query($con,"SELECT usn FROM student where USN = '$uname';");
                    while($db_field=mysqli_fetch_assoc($result))
                    {
                        echo "<input id=\"usn\" name=\"usn\" type=\"text\"  value = " . $db_field['usn']  . "  class=\"form-control input-md in4\" readonly>";
                    }

                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4  in1 control-label" for="name">Name</label>
                <div class="col-md-5">
                    <?php
                    $result = mysqli_query($con,"SELECT name FROM student where USN = '$uname';");
                    while($db_field=mysqli_fetch_assoc($result)) {
                        echo "<input id=\"name\" name=\"name\" type=\"text\" value = " . $db_field['name'] . " class=\"form-control input-md in4\" data-bv-notempty=\"true\" data-bv-notempty-message=\"What's your Name?\">";
                    }
                    ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4  in1 control-label" for="email">Email id</label>
                <div class="col-md-5">
                    <?php
                    $result = mysqli_query($con,"SELECT email FROM student where USN = '$uname';");
                    while($db_field=mysqli_fetch_assoc($result))
                    {
                        echo "<input id=\"email\" name=\"email\" type=\"email\" value = " . $db_field['email'] . " class=\"form-control input-md in4\" data-bv-notempty=\"true\" data-bv-notempty-message=\"What's your Email ID?\" data-bv-emailaddress-message=\"The input is not a valid email address\">";
                    }
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4  in1 control-label" for="branch">Branch</label>
                <div class="col-md-5">
                    <?php
                    $result = mysqli_query($con,"SELECT branch FROM student where USN = '$uname';");
                    while($db_field=mysqli_fetch_assoc($result))
                    {

                        echo "<input id=\"branch\" name=\"branch\" type=\"text\" value = ". $db_field['branch'] . " class=\"form-control input-md in4\" data-bv-notempty=\"true\" data-bv-notempty-message=\"What's your Branch?\" readonly>";
                    }
                    ?>
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-4  in1 control-label" for="phone">Phone No</label>
                <div class="col-md-5">
                    <?php
                    $result = mysqli_query($con,"SELECT phone FROM student where USN = '$uname';");
                    while($db_field=mysqli_fetch_assoc($result))
                    {
                        echo "<input id=\"phone\" name=\"phone\" type=\"text\" value = " . $db_field['phone'] . " class=\"form-control input-md in4\" data-bv-notempty=\"true\" data-bv-notempty-message=\"What's your Phone number?\" data-bv-phone=\"true\" data-bv-phone-country=\"US\" data-bv-phone-message=\"Enter valid phone number\">";
                    }
                    ?>


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4  in1 control-label" for="tenth">10th %</label>
                <div class="col-md-3">
                    <?php
                    $result = mysqli_query($con,"SELECT tenthPercent FROM student where USN = '$uname';");
                    while($db_field=mysqli_fetch_assoc($result))
                    {
                        echo "<input id=\"tenth\" name=\"tenth\" type=\"text\" value = ". $db_field['tenthPercent'] . " class=\"form-control input-md in4\"

                 data-bv-greaterthan=\"true\"
                  data-bv-greaterthan-value=\"0\"
                  data-bv-lessthan=\"true\"

                  data-bv-lessthan-value=\"100\" data-bv-notempty=\"true\" data-bv-notempty-message=\"Field cannot be empty\" readonly>";
                    }
                    ?>

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group" id="t1">
                <label class="col-md-4  in1 control-label" for="twelfth">12th % (N/A)</label>
                <div class="col-md-3">
                    <?php
                    $result = mysqli_query($con,"SELECT twelthPercent FROM student where USN = '$uname';");
                    while($db_field=mysqli_fetch_assoc($result))
                    {
                        echo "<input id=\"twelfth\" name=\"twelfth\" type=\"text\" value = ". $db_field['twelthPercent'] . " class=\"form-control input-md in4\"
                  data-bv-greaterthan=\"true\"
                  data-bv-greaterthan-value=\"0\"
                  data-bv-lessthan=\"true\"
                  data-bv-lessthan-value=\"100\" data-bv-notempty=\"true\" data-bv-notempty-message=\"Field cannot be empty\" readonly>";
                    }
                    ?>


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group" id ="t2">
                <label class="col-md-4  in1 control-label" for="diploma">Diploma % (N/A)</label>
                <div class="col-md-3">
                    <?php
                    $result = mysqli_query($con,"SELECT diplomapercent FROM student where USN = '$uname';");
                    while($db_field=mysqli_fetch_assoc($result))
                    {
                        echo "<input id=\"diploma\" name=\"diploma\" type=\"text\" value = ". $db_field['diplomapercent'] . " class=\"form-control input-md in4\"
                  data-bv-greaterthan=\"true\"
                  data-bv-greaterthan-value=\"0\"
                  data-bv-lessthan=\"true\"
                  data-bv-lessthan-value=\"100\" data-bv-notempty=\"true\" data-bv-notempty-message=\"Field cannot be empty\" readonly>";
                    }
                    ?>


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 in1  control-label" for="cgpa">CGPA</label>
                <div class="col-md-3">
                    <?php
                    $result = mysqli_query($con,"SELECT cgpa FROM student where USN = '$uname';");
                    while($db_field=mysqli_fetch_assoc($result))
                    {
                        echo "<input id=\"cgpa\" name=\"cgpa\" type=\"text\" value = ". $db_field['cgpa'] . " class=\"form-control input-md in4\"

                  data-bv-greaterthan=\"true\"
                  data-bv-greaterthan-value=\"0\"
                  data-bv-lessthan=\"true\"
                  data-bv-lessthan-value=\"10\" data-bv-notempty=\"true\" data-bv-notempty-message=\"Field cannot be empty\" readonly>";;

                    }
                    ?>


                </div>
            </div>

            <!-- Password input-->

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4  in1 control-label" for="submit"></label>
                <div class="col-md-4">
                    <input type="submit"  class="btn btn-success" value="Update Account Information" />
                </div>
            </div>

        </fieldset>
    </form>

</div>









<!-- jQuery Version 1.11.0
<script src="js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="./jquery1/jquery-1.8.3.min.js" charset="UTF-8"></script>
 Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="../js/bootstrapValidator.min.js"></script>
<script>

    $(document).ready(function() {
        $('#edit-profile').bootstrapValidator({
            container: 'tooltip',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            }});

        var dipval= 0,pucval=0;
        pucval=$('#twelfth').val();
        dipval=$('#diploma').val();
        if(dipval == 100)
        {
            $('#t1').hide();
        }
        else
        {
            $('#t2').hide();
        }
        $('[data-toggle="tooltip"]').tooltip();
    });

    var dipval= 0,pucval=0;
    pucval=$('#twelfth').val();
    dipval=$('#diploma').val();
    function hidedata() {

        var selected = $("input[name=pucdip]:checked").val();

        if(selected==1)
        {
            $('#diploma').val(100);
            $('#t2').hide();
            $('#twelfth').val(pucval);
            $('#t1').show();
        }
        else if(selected==2)
        {
            $('#twelfth').val(100);
            $('#t1').hide();
            $('#diploma').val(dipval);
            $('#t2').show();
        }
    }
</script>
</body>

</html>
