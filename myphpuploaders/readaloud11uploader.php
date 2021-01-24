<?php
session_start();
include_once 'connect.php';

foreach(array('audio') as $type) {
    if (isset($_FILES["${type}-blob"])) {

        $filename = $_POST["${type}-filename"];
        $uploadDirectory = 'clientuploads/readaloud/'.$filename;

        if (!move_uploaded_file($_FILES["${type}-blob"]["tmp_name"], $uploadDirectory)) {
            echo(" problem moving uploaded file");
        }
    }
}

try {
    $sql = 'insert into readaloudanswers (reatestid, reaquesno, reastudid, reafile) values (:test, :quesno, :studid, :file)';
    $s = $conn->prepare($sql);
    $s->bindValue(':test', $_SESSION['testid']);
    $s->bindValue(':quesno', $_SESSION['quesno']);
    $s->bindValue(':studid', $_SESSION['id']);
    $s->bindValue(':file', $filename);
    if($s->execute()) {?>
    <script>
        var fd = new FormData();        
        fd.append('fname', '1');
        $.ajax({
                type: 'POST',
                url: 'http://localhost/PTE%20web/PTE/practiceReadAloud.html.php',
                data: fd, 
                processData: false,
                contentType: false,
        })
    </script><?php
    }    
} catch (PDOException $e) {
    echo '<br> error updating database: ' . $e->getMessage();
    exit();
}

?>



