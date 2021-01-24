<?php

try
{
$host = 'localhost';
$db = 'pte';
$username = 'root';
$pass = '';
    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);
}
 catch (PDOException $e)
 {
    echo 'unable to connect: '.$e->getmessage();
    exit();
 }

 $_SESSION['loggedin'] = '';
