<!DOCTYPE html>
<html>

<link rel="stylesheet" href="IN/css/amaran.min.css">


<!-- FONTAWESOME STYLE CSS -->

<!-- CUSTOM STYLE CSS -->


<?php
session_start();
if (isset($_SESSION['username']))
{
    header('Location: IN/studentHome.php');
}


?>
<head>
      <link rel="SHORTCUT ICON" href="images/rvce.ico">

  <meta charset="UTF-8">

  <title>Placement Informer</title>

  <link rel='stylesheet prefetch' href='css/animate.min.css'>
<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,400italic,700italic,700'>

    <link rel="stylesheet" href="css/style1.css" media="screen" type="text/css" />
<style>


.logo{
width:20%;
position:absolute;
left:46%;
top:10%;

}
.proj-name{
width:30%;
position:absolute;
left:39.5%;
top:70%;


}

</style>

    <link rel="stylesheet" type="text/css" href="lib/sweet-alert.css">
</head>

<body style="background-color:#fff">


  <div class="logo">
  <img src="images/logo.png">
</div>


  <div class='form animated flipInX'>
  <h2>Login</h2>
  <form method="POST" action="IN/php/loginCheck.php">
    <input placeholder='USN' type='text' name="username" id="username" required >
    <input placeholder='Password' type='password' name="password"  id="password" required >
    <button class='animated infinite pulse'>Login</button>
  </form>
</div>
<div class="proj-name">
  <h1 id="proj-head">Placement Informer</h1>
</div>



  <link rel="stylesheet" href="jquery/jquery-ui.css">
  <script src="jquery/external/jquery/jquery.js"></script>
  <script src="jquery/jquery-ui.js"></script>

<?php
if ((isset($_SESSION['insert'])))
{
    $insert=$_SESSION['insert'];
    if($insert==1)
    {
        echo"<script>";
        echo'$(function() {
    $( "#dialog-message" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    $(".ui-dialog-titlebar").hide();
  });';
        echo "</script>";
    }
    unset($_SESSION['insert']);

}
?>
<div id="dialog-message" title="Invalid Login" hidden class="ui-dialog-content ui-state-error">
    <p class="ui-state-error-text">Invalid Username or Password. Please Try again</p>
</div>
</body>
</html>