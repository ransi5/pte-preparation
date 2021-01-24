<?php

try
{
$db= new PDO('mysql:host=localhost;dbname=ninja;charset=utf8','root','');
//var_dump($db);

}

catch(Exception $e)
{
	echo "Db connection exception";
}

?>