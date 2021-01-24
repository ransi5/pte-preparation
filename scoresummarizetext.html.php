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
    $sql = "select * from summarisewrittenques where summid = :mid";
        $s = $conn->prepare($sql);
        $s->bindValue(':mid', $_SESSION['moctestid']);
        $s->execute();
        $result = $s->fetchAll();        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

try {
    $sql = "select * from summarisetextanswers where sumstudid = :studid and sumtestid = :testid";
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
    $cont = valid($_POST['content1']);
    $form = valid($_POST['form1']);
    $gram = valid($_POST['grammar1']);
    $vocab = valid($_POST['vocab1']);
    $read = $cont;
    $write = $form + $gram + $vocab;
    $sumques = $cont + $form + $gram + $vocab + $read + $write;
    try {
        $sql = 'update mocktestscores set sumcontent = sumcontent + :content, sumgrammar = sumgrammar + :gram, sumvocab = sumvocab + :vocab, sumwritdisc = sumwritdisc + :writdisc,  sumread = sumread + :read, sumwrite = sumwrite + :write, sumquesscore = sumquesscore + :sumques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':content', $cont);
        $s->bindValue(':gram', $gram);
        $s->bindValue(':vocab', $vocab);
        $s->bindValue(':writdisc', $form);
        $s->bindValue(':read', $read);
        $s->bindValue(':write', $write);
        $s->bindValue(':sumques', $sumques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoresummarizetext.html.php?x=1');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content2'])){
    $cont = valid($_POST['content2']);
    $form = valid($_POST['form2']);
    $gram = valid($_POST['grammar2']);
    $vocab = valid($_POST['vocab2']);
    $read = $cont;
    $write = $form + $gram + $vocab;
    $sumques = $cont + $form + $gram + $vocab + $read + $write;
    try {
        $sql = 'update mocktestscores set sumcontent = sumcontent + :content, sumgrammar = sumgrammar + :gram, sumvocab = sumvocab + :vocab, sumwritdisc = sumwritdisc + :writdisc,  sumread = sumread + :read, sumwrite = sumwrite + :write, sumquesscore = sumquesscore + :sumques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':content', $cont);
        $s->bindValue(':gram', $gram);
        $s->bindValue(':vocab', $vocab);
        $s->bindValue(':writdisc', $form);
        $s->bindValue(':read', $read);
        $s->bindValue(':write', $write);
        $s->bindValue(':sumques', $sumques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoresummarizetext.html.php?x=2');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

try {
    $sql = 'select sumquesscore from mocktestscores where mocid = :id';
    $s = $conn->prepare($sql);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        $col = $s->fetch();
        $score = $col['sumquesscore'];
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
    <title>PTE Preparation - Summarize Written Text Check</title>
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
                        <th>Summarize Text Question</th>
                    </tr>
                    <?php foreach ($result as $row) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['summid']; ?></td>
                        <td style="text-align: center"><?php echo $row['sumqno']; ?></td>
                        <td><?php echo $row['sumcontent']; ?></td>
                    </tr>
                    <?php }?>
                </table>   
                
                <h3>Answers by student</h3>
                <table class="quest" style="width: 100%">
                    <tr>
                        <th>Mock Test Id</th>
                        <th>Item No</th>
                        <th>Answer</th>
                        <th>Words</th>
                        <th>Score</th>
                    </tr>
                    
                    <?php foreach ($results as $row) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['sumtestid']; ?></td>
                        <td style="text-align: center"><?php echo $row['sumquesno']; ?></td>
                        <td id="text<?php echo $row['sumquesno'];?>"><?php echo $row['sumtext']; ?></td>
                        <td id="words<?php echo $row['sumquesno'];?>" style="text-align: center"></td>
                        <td>
                            <form action="" method="post" name="MyForm<?php echo $row['sumquesno'];?>">
                            Content: <select name="content<?php echo $row['sumquesno'];?>">
                                    <option>Choose Marks</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                            Form: <select name="form<?php echo $row['sumquesno'];?>">
                                    <option>Choose Marks</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                            Grammar: <select name="grammar<?php echo $row['sumquesno'];?>">
                                    <option>Choose Marks</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                            Vocabulary: <select name="vocab<?php echo $row['sumquesno'];?>">
                                    <option>Choose Marks</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                                <input type="submit" name="score" value="submit" id="score<?php echo $row['sumquesno'];?>">
                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </table>
                <h3>Score: <?php echo $score; ?>/28</h3>
                <table class="quest" style="width: 100%">
                    <tr>
                        <th colspan="5">Score Guide</th>
                    </tr>
                    <tr>
                        <th>Score</th>
                        <th>Content</th>
                        <th>Form</th>
                        <th>Grammar</th>
                        <th>Vocabulary</th>
                    </tr>
                    <tr>
                        <td style="text-align: center">2</td>
                        <td>Provides a good summary of the text. All relevant aspects mentioned</td>
                        <td></td>
                        <td>Has correct grammatical structure</td>
                        <td>Has appropriate choice of words</td>
                    </tr> 
                    <tr>
                        <td style="text-align: center">1</td>
                        <td>Provides a fair summary of the text but misses one or two aspects</td>
                        <td>Is written in one, single, complete sentence</td>
                        <td>Contains grammatical errors but with no hindrance to communication</td>
                        <td>Contains lexical errors but with no hindrance to communication</td>
                    </tr>  
                    <tr>
                        <td style="text-align: center">0</td>
                        <td>Omits or misrepresents the main aspects of the text</td>
                        <td>Not written in one, single, complete sentence or contains fewer than 5 
                            or more than 75 words. Summary is written in capital letters</td>
                        <td>Has defective grammatical structure which could hinder communication</td>
                        <td>Has defective word choice which could hinder communication</td>
                    </tr>   
                </table>                                  
            </div>
            <div id="footer" class="bottom1"><button type="button" class="btn btn-default btn-md" id="next">Next</button></div>
        </div>
    </div>
  <script>
$(document).ready(function() {
    $('#score<?php echo $_GET['x']; ?>').attr('disabled', 'disabled');        
});
    
$(document).ready(function() {
   $('#next').click(function(){
       window.location = 'scoreessay.html.php?x=';
   });
});

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