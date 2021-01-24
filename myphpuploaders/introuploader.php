<?php
session_start();
include_once 'connect.php';

$uname="demo";

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
$filename = $_SESSION['id'] . $_SESSION['testid'] . $_SESSION['name'] ."-". date( 'd-m-Y H-i' ) .'.mp3';

// write the data out to the file
$fp = fopen('clientuploads/intro/'.$filename, 'wb');
fwrite($fp, $decodedData);
fclose($fp);

?>
<?php 
try {
    $sql = 'insert into introanswers (inttestid, intstudid, intfile) values (:test, :studid, :file)';
    $s = $conn->prepare($sql);
    $s->bindValue(':test', $_SESSION['testid']);
    $s->bindValue(':studid', $_SESSION['id']);
    $s->bindValue(':file', $filename);
    $s->execute();
} catch (PDOException $e) {
    echo '<br> error updating database: ' . $e->getMessage();
    exit();
}
?>
