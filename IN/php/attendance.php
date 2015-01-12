<?php
/**
 * Created by PhpStorm.
 * User: ramu
 * Date: 20/11/14
 * Time: 8:53 AM
 */
// Initialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if ((!isset($_SESSION['username']))||(!isset($_SESSION['password']) )){
    header('Location: ../');
}

?>
<!DOCTYPE HTML>
    <html>
        <head>
            <title>Attendance MAnagement</title>
        </head>
        <body>
<?php


?>
        </body>
    </html>