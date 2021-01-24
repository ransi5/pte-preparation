<?php
session_start();
include 'connect.php';
$uname=$_SESSION['CurrentUser'];
$_SESSION['CurrentUser']="demo";
$_SESSION['globalcounter'] = $_SESSION['globalcounter'] + 1;
$questionid=$_SESSION['questionids'] [$_SESSION['globalcounter']];
$type="retelllecture";
if(!is_dir("clientuploads/retelllecture"))
{
	$res = mkdir("clientuploads/retelllecture",0777); 
}

// pull the raw binary data from the POST array
$data = substr($_POST['data'], strpos($_POST['data'], ",") + 1);
// decode it
$decodedData = base64_decode($data);
// print out the raw data, 
//echo ($decodedData);
$filename = $uname ."-". date( 'Y-m-d-H-i-s' ) .'.wav';
$answer="myphpuploaders/clientuploads/retelllecture/".$filename;
// write the data out to the file
$fp = fopen('clientuploads/retelllecture/'.$filename, 'wb');
fwrite($fp, $decodedData);
fclose($fp);
?>
<?php
	$stmt=$db->prepare("INSERT INTO retelllectureanswer (username,type,questionid,answer) VALUES (?,?,?,?)");
	$stmt->bindValue(1,$uname);
	$stmt->bindValue(2,$type);
	$stmt->bindValue(3,$questionid);
	$stmt->bindValue(4,$answer);
	$stmt->execute();
?>
