<?php
ob_start();
include_once 'php/includes/connect.php';
include 'php/includes/tutoraccess.php';

if (!userIsLoggedIn())
{
include 'ptetutorlogin.html.php';
exit();
}
if (!userHasRole('Admin') && !userHasRole('Tutor'))
{
$error = 'Only Admin may access this page.';
include 'tutoraccessdenied.html.php';
exit();
}

try {
    $sql = "select * from lwwritefromdictationques where lwwmid = :mid";
        $s = $conn->prepare($sql);
        $s->bindValue(':mid', $_SESSION['moctestid']);
        $s->execute();
        $result = $s->fetchAll();        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

try {
    $sql = "select * from lwwritefromdictationanswers where lwwstudid = :studid and lwwtestid = :testid";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_SESSION['mocstudid']);
        $s->bindValue(':testid', $_SESSION['moctestid']);
        $s->execute();
        $results = $s->fetchAll();        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if (isset($_POST['content1'])){
    $listen = valid($_POST['content1']);
    $write = $listen;
    $lwwques = $listen + $write;
    try {
        $sql = 'update mocktestscores set lwwlisten = lwwlisten + :listen, lwwwrite = lwwwrite + :write, lwwquesscore = lwwquesscore + :ques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':write', $write);
        $s->bindValue(':ques', $lwwques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scorelwwritedictation.html.php?x=1');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content2'])){
    $listen = valid($_POST['content2']);
    $write = $listen;
    $lwwques = $listen + $write;
    try {
        $sql = 'update mocktestscores set lwwlisten = lwwlisten + :listen, lwwwrite = lwwwrite + :write, lwwquesscore = lwwquesscore + :ques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':write', $write);
        $s->bindValue(':ques', $lwwques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scorelwwritedictation.html.php?x=2');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content3'])){
    $listen = valid($_POST['content3']);
    $write = $listen;
    $lwwques = $listen + $write;
    try {
        $sql = 'update mocktestscores set lwwlisten = lwwlisten + :listen, lwwwrite = lwwwrite + :write, lwwquesscore = lwwquesscore + :ques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':write', $write);
        $s->bindValue(':ques', $lwwques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scorelwwritedictation.html.php?x=3');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'Finish') {
    try {
        $sql = 'update mocktestscores set mocstatus = "checked" where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: mocktestattempted.html.php');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

try {
    $sql = 'select lwwquesscore from mocktestscores where mocid = :id';
    $s = $conn->prepare($sql);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        $col = $s->fetch();
        $lwwscore = $col['lwwquesscore'];
} catch (PDOException $e) {
            echo '<br> error updating database: ' . $e->getMessage();
            exit();
}
ob_flush();?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Write from Dictation Check</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/scorestyle.css" rel="stylesheet" type="text/css" />
    <style>
        table, th, td{border: 1px solid black; border-collapse: collapse;}
        th{text-align: center;}
        th{color: white; background-color: #f55959;}
        table.quest tr:nth-child(even) {background-color: #eee;}
        table.quest tr:nth-child(odd) {background-color: #fff;}
        table.quest{margin-bottom: 20px;}
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
</head>
<body>
    <div class="container-fluid">
        <div class="gill">
            <div class="container">
                <p>Student Id: <?php echo $_SESSION['mocstudid']; ?></p>
                <table class="quest" style="width: 100%">
                    <tr>
                        <th>Mock Test Id</th>
                        <th>Item No</th>
                        <th>Write from Dictation Question</th>
                    </tr>
                    <?php foreach ($result as $row) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['lwwmid']; ?></td>
                        <td style="text-align: center"><?php echo $row['lwwqno']; ?></td>
                        <td><?php echo $row['lwwqanswer']; ?></td>
                    </tr>
                    <?php }?>
                </table>   
                
                <h3>Answers by student</h3>
                <table class="quest" style="width: 100%">
                    <tr>
                        <th>Mock Test Id</th>
                        <th>Item No</th>
                        <th>Answer</th>
                        <th>Score</th>
                    </tr>
                    
                    <?php foreach ($results as $row) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['lwwtestid']; ?></td>
                        <td style="text-align: center"><?php echo $row['lwwquesno']; ?></td>
                        <td><?php echo $row['lwwanswer']; ?></td>                        
                        <td>
                            <form action="" method="post" name="MyForm<?php echo $row['lwwquesno'];?>">
                            Correct/Incorrect: <select name="content<?php echo $row['lwwquesno'];?>">
                                    <option>Choose Marks</option>
                                    <option value="1">correct</option>
                                    <option value="0">Incorrect</option>
                                </select><br>
                                <input type="submit" name="score" value="submit" id="score<?php echo $row['lwwquesno'];?>">
                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </table>
                <h3>Score: <?php echo $lwwscore; ?>/6</h3>                                 
            </div>
            <div id="footer" class="bottom1">
                <form action="" method="post">
                    <button type="submit" name="action" value="Finish" class="btn btn-default btn-md" id="next">Finish</button>
                </form>
            </div>
        </div>
    </div>
  <script>
$(document).ready(function() {
    $('#score<?php echo $_GET['x']; ?>').attr('disabled', 'disabled');        
});
    
//$(document).ready(function() {
//   $('#next').click(function(){
//       window.location = 'scorermcqsingleanswer.html.php?x=';
//   });
//});

function counters() {
    var value = $('#text1').text();

    if (value.length == 0) {
        $('#words1').html(0);
        return;
    }
    var regex = /\s+/gi;
    var wordCount = value.trim().replace(regex, ' ').split(' ').length;
    console.log(wordCount);
    $('#words1').html(wordCount);
}

function counters2() {
    var value = $('#text2').text();

    if (value.length == 0) {
        $('#words2').html(0);
        return;
    }
    var regex = /\s+/gi;
    var wordCount = value.trim().replace(regex, ' ').split(' ').length;
    console.log(wordCount);
    $('#words2').html(wordCount);
}

$(window).load(function() {
    counters();
    counters2();
});
  
$(document).ready(function() {
   
   var docHeight = $(window).height();
   var footerHeight = $('#footer').height();
   var footerTop = $('.gill').height();
   
   if (footerTop < docHeight) {
        $('#footer').removeClass('bottom1');
        $('#footer').addClass('bottom');
   }
   if ((footerTop) >= docHeight) {
        $('#footer').removeClass('bottom');
        $('#footer').addClass('bottom1');
   }
});

</script>

</body>
</html>