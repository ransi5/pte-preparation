<?php
include_once 'includes/connect.php';


session_start();
unset($_SESSION['loggedin']);
unset($_SESSION['email']);
unset($_SESSION['password']);
unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['testid']);
session_destroy();
header('location: ../pte-preparation-login.html.php');
exit();
    

?>
