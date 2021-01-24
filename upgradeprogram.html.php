<?php
ob_start();
include_once 'php/includes/connect.php';
include_once 'php/includes/access.php';

if (!userIsLoggedIn())
{
include 'pte-preparation-login.html.php';
exit();
}
if (!userHasRole('Silver') && !userHasRole('Gold') && !userHasRole('Diamond') && !userHasRole('Admin'))
{
$error = 'Only members may access this page.';
include 'accessdenied.html.php';
exit();
}

if (userHasRole('Silver')) {
    header('location: silverupgrade.html.php');
    exit();
}

if (userHasRole('Gold')) {
    header('location: goldupgrade.html.php');
    exit();
}

if (userHasRole('Diamond')) {
    header('location: diamondupgrade.html.php');
    exit();
}
ob_flush();?>


