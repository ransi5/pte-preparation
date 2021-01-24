<?php
include 'connect.php';

$stmt=$db->prepare("INSERT INTO introanswer (username,type,answer) VALUES (?,?,?)");
	$stmt->bindValue(1,"demo");
	$stmt->bindValue(2,"intro");
	$stmt->bindValue(3,"answer");
	$stmt->execute();
?>