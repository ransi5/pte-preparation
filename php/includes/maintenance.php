<?php

function checkaccountvalidity($x) {
    include 'connect.php';
    try {
        $sql = 'select * from members where id = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':id', $x);
        $result = $s->execute();
        $row = $s->fetch();
        $expdate = $row['expdate'];
        $id = $row['id'];
    } catch (PDOException $e) {
        $errors[] = '<br>Error adding member: ' . $e->getMessage();
        exit();
    }

    if ($expdate < Date('Y-m-d H:i:s')) {
        try {
            $sql = "select * from introanswers where intstudid = :studid";
            $s = $conn->prepare("$sql");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $result = $s->fetchAll();
            foreach ($result as $row) {
                unlink('myphpuploaders/clientuploads/intro/'.$row['intfile']);
            }
            $sql = "select * from readaloudanswers where reastudid = :studid";
            $s = $conn->prepare("$sql");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $result = $s->fetchAll();
            foreach ($result as $row) {
                unlink('myphpuploaders/clientuploads/readaloud/'.$row['reafile']);
            }
            $sql = "select * from repeatsentenceanswers where repstudid = :studid";
            $s = $conn->prepare("$sql");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $result1 = $s->fetchAll();
            foreach ($result1 as $row) {
                unlink('myphpuploaders/clientuploads/repeatsentence/'.$row['repfile']);
            }
            $sql = "select * from describeimageanswers where desstudid = :studid";
            $s = $conn->prepare("$sql");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $result2 = $s->fetchAll();
            foreach ($result2 as $row) {
                unlink('myphpuploaders/clientuploads/imagespeak/'.$row['desfile']);
            }
            $sql = "select * from retelllectureanswers where retstudid = :studid";
            $s = $conn->prepare("$sql");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $result3 = $s->fetchAll();
            foreach ($result3 as $row) {
                unlink('myphpuploaders/clientuploads/retelllecture/'.$row['retfile']);
            }
            $sql = "select * from shortquestionanswers where shostudid = :studid";
            $s = $conn->prepare("$sql");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $result4 = $s->fetchAll();
            foreach ($result4 as $row) {
                unlink('myphpuploaders/clientuploads/shortanswer/'.$row['shofile']);
            }
            $s = $conn->prepare("delete from introanswers where intstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from readaloudanswers where reastudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from repeatsentenceanswers where repstudid = :studid");

            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from describeimageanswers where desstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from retelllectureanswers where retstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from shortquestionanswers where shostudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from summarisetextanswers where sumstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from essayanswers where essstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from smcreadinganswers where smcstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from mmcreadinganswers where mmcstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from reorderparagraphanswers where reostudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from rfillblankanswers where rfistudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from rwfillblankanswers where rwfstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from lwsummarizespokentextanswers where lwsstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from lmcqmultipleansweranswers where lmcstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from lwfillblankanswers where lwfstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from lrhighlightsummaryanswers where lrhstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from lsmultiplechoiceanswers where lsmstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from lselectmissingwordanswers where lsestudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from lhighlightincorrectwordanswers where lhistudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from lwwritefromdictationanswers where lwwstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from mocktestscores where mocstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from feedbackappt where feestudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from feedbackapptapproved where appstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $s = $conn->prepare("delete from feedbackappttime where timstudid = :studid");    
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $sql1 = "delete from members where id = :id";
            $s = $conn->prepare($sql1);
            $s->bindValue(':id', $x);
            $s->execute();
            $sql1 = "delete from memberrole where memberid = :id";
            $s = $conn->prepare($sql1);
            $s->bindValue(':id', $x);
            $s->execute();
            $error = "Your account has expired";
            include 'accessdenied.html.php';
            Exit();
        } catch (PDOException $e) {
            echo '<br>Error fetching question: ' . $e->getMessage();
            exit();
        }
    }
}
    
   
?>


