<?php
session_start();
include 'connect.php';
$uname=$_SESSION['CurrentUser'];
$type="intro";


if(!is_dir("clientuploads/intro"))
{
	$res = mkdir("clientuploads/intro",0777); 
}

// pull the raw binary data from the POST array
$data = substr($_POST['data'], strpos($_POST['data'], ",") + 1);
// decode it
$decodedData = base64_decode($data);
// print out the raw data, 
//echo ($decodedData);
$filename = $uname ."-". date( 'Y-m-d-H-i-s' ) .'.wav';

$answer="myphpuploaders/clientuploads/intro/".$filename;

// write the data out to the file
$fp = fopen('clientuploads/intro/'.$filename, 'wb');
fwrite($fp, $decodedData);
fclose($fp);

	
?>
<?php
	$stmt=$db->prepare("INSERT INTO introanswer (username,type,answer) VALUES (?,?,?)");
	$stmt->bindValue(1,$uname);
	$stmt->bindValue(2,$type);
	$stmt->bindValue(3,$answer);
	$stmt->execute();
?>
