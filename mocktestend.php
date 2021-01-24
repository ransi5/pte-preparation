<?php
ob_start();
include_once 'php/includes/connect.php';
include 'php/includes/access.php';

if (!userIsLoggedIn())
{
include 'pte-preparation-login.html.php';
exit();
}
if (!userHasRole('Silver') && !userHasRole('Gold') && !userHasRole('Diamond') && !userHasRole('Admin'))
{
$error = 'Only members may access this page.';
include 'accessdenied.html.php';
exit();
}

if (isset($_POST['content'])) {
    try {
        $content = valid($_POST['content']);
        $sql = 'insert into lwwritefromdictationanswers (lwwtestid,  lwwquesno,  lwwstudid, lwwanswer) values (:test, :quesno, :studid, :content)';
        $s = $conn->prepare($sql);
        $s->bindValue(':test', $_SESSION['testid']);
        $s->bindValue(':quesno', '3');
        $s->bindValue(':studid', $_SESSION['id']);
        $s->bindValue(':content', $content);
        $s->execute();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
     
}

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Prepartion - Practice Test End</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link href="css/teststyle.css" rel="stylesheet" type="text/css" />
    <style type='text/css'>
      .options{margin: 170px auto;}
      .btns{margin: 10px auto;}
      #exit{padding: 8px 55px;}
      #submit{padding: 8px 48px;}
    </style>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-96161773-1', 'auto');
      ga('send', 'pageview');

    </script>
    <script type = "text/javascript" >
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    </script>
    <script>
        <?php
        if (isset($_POST['action']) && $_POST['action'] == 'Exit') {
            try {
                $sql = "select * from introanswers where inttestid = :testid and intstudid = :studid";
                $s = $conn->prepare("$sql");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $result = $s->fetchAll();
                foreach ($result as $row) {
                    unlink('myphpuploaders/clientuploads/intro/'.$row['intfile']);
                }
                $sql = "select * from readaloudanswers where reatestid = :testid and reastudid = :studid";
                $s = $conn->prepare("$sql");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $result = $s->fetchAll();
                foreach ($result as $row) {
                    unlink('myphpuploaders/clientuploads/readaloud/'.$row['reafile']);
                }
                $sql = "select * from repeatsentenceanswers where reptestid = :testid and repstudid = :studid";
                $s = $conn->prepare("$sql");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $result1 = $s->fetchAll();
                foreach ($result1 as $row) {
                    unlink('myphpuploaders/clientuploads/repeatsentence/'.$row['repfile']);
                }
                $sql = "select * from describeimageanswers where destestid = :testid and desstudid = :studid";
                $s = $conn->prepare("$sql");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $result2 = $s->fetchAll();
                foreach ($result2 as $row) {
                    unlink('myphpuploaders/clientuploads/imagespeak/'.$row['desfile']);
                }
                $sql = "select * from retelllectureanswers where rettestid = :testid and retstudid = :studid";
                $s = $conn->prepare("$sql");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $result3 = $s->fetchAll();
                foreach ($result3 as $row) {
                    unlink('myphpuploaders/clientuploads/retelllecture/'.$row['retfile']);
                }
                $sql = "select * from shortquestionanswers where shotestid = :testid and shostudid = :studid";
                $s = $conn->prepare("$sql");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $result4 = $s->fetchAll();
                foreach ($result4 as $row) {
                    unlink('myphpuploaders/clientuploads/shortanswer/'.$row['shofile']);
                }
                $s = $conn->prepare("delete from introanswers where inttestid = :testid and intstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from readaloudanswers where reatestid = :testid and reastudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from repeatsentenceanswers where reptestid = :testid and repstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from describeimageanswers where destestid = :testid and desstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from retelllectureanswers where rettestid = :testid and retstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from shortquestionanswers where shotestid = :testid and shostudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from summarisetextanswers where sumtestid = :testid and sumstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from essayanswers where esstestid = :testid and essstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from smcreadinganswers where smctestid = :testid and smcstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from mmcreadinganswers where mmctestid = :testid and mmcstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from reorderparagraphanswers where reotestid = :testid and reostudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from rfillblankanswers where rfitestid = :testid and rfistudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from rwfillblankanswers where rwftestid = :testid and rwfstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from lwsummarizespokentextanswers where lwstestid = :testid and lwsstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from lmcqmultipleansweranswers where lmctestid = :testid and lmcstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from lwfillblankanswers where lwftestid = :testid and lwfstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from lrhighlightsummaryanswers where lrhtestid = :testid and lrhstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from lsmultiplechoiceanswers where lsmtestid = :testid and lsmstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from lselectmissingwordanswers where lsetestid = :testid and lsestudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from lhighlightincorrectwordanswers where lhitestid = :testid and lhistudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from lwwritefromdictationanswers where lwwtestid = :testid and lwwstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                $s = $conn->prepare("delete from mocktestscores where moctestid = :testid and mocstudid = :studid");
                $s->bindValue(':testid', $_SESSION['testid']);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->execute();
                echo 'window.close();';
                exit();
            } catch (PDOException $e) {
                echo '<br>Error fetching question: ' . $e->getMessage();
                exit();
            }
        }        
        ?>
        <?php
        if (isset($_POST['action']) && $_POST['action'] == 'Submit') {
            try {
                $sql = 'insert into mocktestscores (mocstudid, moctestid, mocuniqid, mocstatus, mocdate) values (:studid, :test, :uniq, :status, NOW())';
                $s = $conn->prepare($sql);
                $s->bindValue(':studid', $_SESSION['id']);
                $s->bindValue(':test', $_SESSION['testid']);
                $s->bindValue(':uniq', $_SESSION['id'] . $_SESSION['testid']);
                $s->bindValue(':status', 'unchecked');
                $s->execute();
                header('location: mocktestsaved.php');
                exit();
            } catch (PDOException $e) {
                echo '<br> error updating database: ' . $e->getMessage();
                exit();
            }   
        }
        ob_flush();?>
    </script>

</head>
<body>
    <div class="container">
        <div class="options text-center">
            <h4>To save this mock test for scoring press "Submit".</h4>
            <h4>To attempt this mock test later, press "Exit".</h4>
            <div class="btns text-center">
                <form action="" method="post">
                    <button type="submit" class="btn btn-danger btn-large" name="action" id="exit" value="Exit">Exit</button>
                    <button type="submit" class="btn btn-success btn-large" name="action" id="submit" value="Submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
   
  <script>
      
    document.oncontextmenu = document.body.oncontextmenu = function() {return false;} //disables right click on mouse
    document.body.oncopy = function() { return false; }  //disables copy
    document.body.oncut = function() { return false; }   //disables cut
    
      
  </script>
    
</body>
</html>