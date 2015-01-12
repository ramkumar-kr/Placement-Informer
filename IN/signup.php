<?php
error_reporting(0);

session_start();
if ((isset($_SESSION['username']))||(isset($_SESSION['password'])))
{
    header('Location: ../');
}

$mysqli = new mysqli("localhost", "root", "", "placementinformer"); // put "" for the password if you want to run them
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
    $passkey = $_GET['passkey'];


if(isset($passkey)) {

    $tbl_name = "temp";

// Retrieve data from table where row that match this passkey 
    $sql = "SELECT * FROM $tbl_name WHERE code ='$passkey'";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {

// Count how many row has this passkey
        $count = mysqli_num_rows($result);

// if found this passkey in our database, retrieve data from table "temp_members_db"
        if ($count == 1) {

            $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $name = $rows['name'];
            $email = $rows['email'];
            $usn = $rows['usn'];
//$tbl_name2="";

// Insert data that retrieves from "temp_members_db" into table "registered_members" 
//$sql2="INSERT INTO $tbl_name2(name, email, password, country)VALUES('$name', '$email', '$password', '$country')";
//$result2=mysql_query($sql2);
            /*
            // if successfully moved data from table"temp_members_db" to table "registered_members" displays message "Your account has been activated" and don't forget to delete confirmation code from table "temp_members_db"
            if($result2){

            echo "Your account has been activated";

            // Delete information of this user from table "temp_members_db" that has this passkey
            $sql3="DELETE FROM $tbl_name1 WHERE confirm_code = '$passkey'";
            $result3=mysql_query($sql3);

            }
            */
            ?>

            <!DOCTYPE html>
            <html lang="en" xmlns="http://www.w3.org/1999/html">

            <head>

                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="description" content="">
                <meta name="author" content="">

                <title>Placement Informer</title>

                <!-- Bootstrap Core CSS -->
                <link href="css/bootstrap.min.css" rel="stylesheet">
                <link rel="SHORTCUT ICON" href="images/rvce.ico">
                <link href="../css/bootstrapValidator.css" rel="stylesheet" />

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
                <link href="assets/css/bootstrap.css" rel="stylesheet"/>
                <!-- FONTAWESOME STYLE CSS -->
                <link href="assets/css/font-awesome.min.css" rel="stylesheet"/>
                <!-- CUSTOM STYLE CSS -->
                <link href="assets/css/style.css" rel="stylesheet"/>
                <!-- GOOGLE FONT -->
                <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
                <link href="gener/genericons.css" rel="stylesheet">
                <link href="css/signup-css/main.css" rel="stylesheet"/>


            </head>

            <body>
            <?php
            /*if($_SESSION['err']=="USN already exists")
            {
                echo '<div class="alert alert-danger text-center" role="alert"><strong>Error! </strong> USN already exists.</div>';
            }
            if($_SESSION['err']=="Email ID already exists")
            {
                echo '<div class="alert alert-danger text-center" role="alert"><strong>Error! </strong> Email ID already exists.</div>';
            }
            if($_SESSION['err']=="Passwords donot match")
            {
                echo '<div class="alert alert-danger text-center" role="alert"><strong>Error! </strong> Passwords do not match.</div>';
            }
            if($_SESSION['err']=="Done")
            {
                echo '<div class="alert alert-success text-center" role="alert"><strong>Success! </strong></div>';
            }
                unset($_SESSION['err']);*/
            ?>
            <div
                class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 vcentre">

                <br/>

                <div class="col-lg-offset-5 col-md-offset-5 logo">
                    <img src="images/logo.png">
                </div>

                <form class="form-horizontal" name="signup" method="post" id="signup"
                      action="<?php echo htmlspecialchars('php/signup-insert.php'); ?>">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Sign up</legend>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="usn">USN</label>

                            <div class="col-md-5">
                                <input readonly id="usn" name="usn" type="text" placeholder="USN"
                                       class="form-control input-md"
                                       value='<?php echo "{$usn}" ?>'>

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">Name</label>

                            <div class="col-md-5">
                                <input id="name" name="name" type="text" placeholder="Name"
                                       class="form-control input-md" data-bv-notempty="true" data-bv-notempty-message="What's your Name?"
                                       value='<?php echo "{$name}" ?>'>

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">Email id</label>

                            <div class="col-md-5">
                                <input id="email" name="email" type="email" placeholder="Email id" data-bv-emailaddress-message="The value is not a valid email address"
                                       class="form-control input-md"
                                       value='<?php echo "{$email}" ?>'>

                            </div>
                        </div>

                        <!-- Password input-->
                        < <div class="form-group">
                            <label class="col-md-4 control-label in3" for="password">New Password</label>
                            <div class="col-md-5">
                                <input id="password" name="password" type="password" placeholder="New Password" class="form-control input-md" data-bv-notempty="true" data-bv-notempty-message="The password is required and cannot be empty" data-bv-stringlength="true" data-bv-stringlength-min="8" data-bv-stringlength-message="The password must have at least 8 characters"
                                       data-bv-different="true"
                                       data-bv-different-field="curpass"
                                       data-bv-different-message="The old and new password cannot be the same" >
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label in3" for="confirmpass">Confirm New Password</label>
                            <div class="col-md-5">
                                <input id="confirmpass" name="confirmpass" type="password" placeholder="Confirm New Password" class="form-control input-md"
                                       data-bv-notempty="true" data-bv-notempty-message="The confirm password is required and cannot be empty"
                                       data-bv-identical="true" data-bv-identical-field="password" data-bv-identical-message="Passwords do not match"

                            </div>
                        </div>
                        <br>
                        <br>
                        <br>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="branch">Branch</label>
                            <!-- -->
                            <?php
                            $brc = $usn[5].$usn[6];
                            switch($brc){
                                case 'IS' : $br = 'ISE';break;
                                case 'CS' : $br = 'CSE';break;
                                case 'EC' : $br = 'ECE';break;
                                case 'EE' : $br = 'EEE';break;
                                case 'IT' : $br = 'IT';break;
                                case 'IM' : $br = 'IEM';break;
                                case 'ME' : $br = 'ME';break;
                                case 'CV' : $br = 'CE';break;
                                case 'CH' : $br = 'CH';break;
                                case 'BT' : $br = 'BT';break;
                                case 'TE' : $br = 'TC';break;
                                default:echo 'error';break;
                            }
                            ?>

                            <div class="col-md-5">
                                <input type="text" id="branch" name="branch" class="form-control" readonly
                                    value="<?php echo $br?>">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="phone">Phone No</label>

                            <div class="col-md-5">
                                <input id="phone" name="phone" type="text" placeholder="Phone No"
                                       class="form-control input-md" data-bv-notempty="true" data-bv-notempty-message="What's your Phone number?" data-bv-phone="true" data-bv-phone-country="US" data-bv-phone-message="Enter valid phone number">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tenth">10th %</label>

                            <div class="col-md-3">
                                <input id="tenth" name="tenth" type="text" placeholder="" class="form-control input-md" data-bv-greaterthan="true"
                                       data-bv-greaterthan-value="0"
                                       data-bv-lessthan="true"
                                       data-bv-lessthan-value="100" data-bv-notempty="true" data-bv-notempty-message="Field cannot be empty">
                                

                            </div>
                        </div>

                        <!-- Text input-->

                        <div class="form-group">

                            <label class="col-md-4 in1 control-label" for="radiocheck">Select an option</label>
                            <div class="col-md-5">
                                <label class="radio-inline">
                                    <input type="radio" id="pucrb" name="pucdip" value="1" onclick="hidedata();">12th Standard</label>
                                <label class="radio-inline"><input type="radio" id="diprb" name="pucdip" value="2" onclick="hidedata();">Diploma</label>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group" id="t1">
                            <label class="col-md-4  in1 control-label" for="twelfth">12th % (N/A)</label>
                            <div class="col-md-3">
                                <input id="twelfth" name="twelfth" type="text"  class="form-control input-md in4"
                  data-bv-greaterthan="true"
                  data-bv-greaterthan-value="0"
                  data-bv-lessthan="true"
                  data-bv-lessthan-value="100" data-bv-notempty="true" data-bv-notempty-message="Field cannot be empty">
                                


                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group" id ="t2">
                            <label class="col-md-4  in1 control-label" for="diploma">Diploma % (N/A)</label>
                            <div class="col-md-3">
                                <input id="diploma" name="diploma" type="text"  class="form-control input-md in4"
                  data-bv-greaterthan="true"
                  data-bv-greaterthan-value="0"
                  data-bv-lessthan="true"
                  data-bv-lessthan-value="100" data-bv-notempty="true" data-bv-notempty-message="Field cannot be empty">
                                

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 in1  control-label" for="cgpa">CGPA</label>
                            <div class="col-md-3">
                                <input id="cgpa" name="cgpa" type="text"  class="form-control input-md in4"

                  data-bv-greaterthan="true"
                  data-bv-greaterthan-value="0"
                  data-bv-lessthan="true"
                  data-bv-lessthan-value="10" data-bv-notempty="true" data-bv-notempty-message="Field cannot be empty">



                            </div>
                        </div>
                        
                        
                        
                        
                        

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="submit"></label>

                            <div class="col-md-4">
                                <button id="submit1" value="submit" type = "submit" name="submit1" class="btn btn-success" action="<?php echo htmlspecialchars('php/signup-insert.php'); ?>">Submit</button>
                            </div>
                        </div>

                    </fieldset>
                </form>

            </div>


            <!-- jQuery Version 1.11.0 -->
            <script src="js/jquery-1.11.0.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="js/bootstrap.min.js"></script>

            <script src="../js/bootstrapValidator.min.js"></script>
            <script>
            $(document).ready(function() {
                $('#signup').bootstrapValidator({
                container:'tooltip',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                }});});
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
        <?php
        }
        else {
            echo "Wrong Confirmation code";

        }
    }
    else {
        echo "Wrong Confirmation code";

    }
}
else {
    echo "Error...This person has already Registered";

}





?>
