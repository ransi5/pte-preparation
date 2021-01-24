<?php
session_start();
include_once 'connect.php';

foreach(array('audio') as $type) {
    if (isset($_FILES["${type}-blob"])) {

        $filename = $_POST["${type}-filename"];
        $uploadDirectory = 'clientuploads/imagespeak/'.$filename;

        if (!move_uploaded_file($_FILES["${type}-blob"]["tmp_name"], $uploadDirectory)) {
            echo(" problem moving uploaded file");
        }
    }
}

try {
    $sql = 'insert into describeimageanswers (destestid, desquesno, desstudid, desfile) values (:test, :quesno, :studid, :file)';
    $s = $conn->prepare($sql);
    $s->bindValue(':test', $_SESSION['testid']);
    $s->bindValue(':quesno', '4');
    $s->bindValue(':studid', $_SESSION['id']);
    $s->bindValue(':file', $filename);
    $s->execute();
} catch (PDOException $e) {
    echo '<br> error updating database: ' . $e->getMessage();
    exit();
}
?>
