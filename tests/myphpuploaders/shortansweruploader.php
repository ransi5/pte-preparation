<?php
$uname="demo";

if(!is_dir("clientuploads/shortanswer"))
{
	$res = mkdir("clientuploads/shortanswer",0777); 
}

// pull the raw binary data from the POST array
$data = substr($_POST['data'], strpos($_POST['data'], ",") + 1);
// decode it
$decodedData = base64_decode($data);
// print out the raw data, 
//echo ($decodedData);
$filename = $uname."-" . date( 'Y-m-d-H-i-s' ) .'.wav';

// write the data out to the file
$fp = fopen('clientuploads/shortanswer/'.$filename, 'wb');
fwrite($fp, $decodedData);
fclose($fp);
?>