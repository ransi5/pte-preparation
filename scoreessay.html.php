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
    $sql = "select * from essayques where essmid = :mid";
        $s = $conn->prepare($sql);
        $s->bindValue(':mid', $_SESSION['moctestid']);
        $s->execute();
        $result = $s->fetchAll();        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

try {
    $sql = "select * from essayanswers where essstudid = :studid and esstestid = :testid";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_SESSION['mocstudid']);
        $s->bindValue(':testid', $_SESSION['moctestid']);
        $s->execute();
        $results = $s->fetchAll();        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if (isset($_POST['content'])){
    $cont = valid($_POST['content']);
    $writdisc = valid($_POST['form']) + valid($_POST['writdisc1']) + valid($_POST['writdisc2']);
    $gram = valid($_POST['grammar']);
    $vocab = valid($_POST['vocab']);
    $spell = valid($_POST['spell']);
    $write = $cont + $writdisc + $gram + $vocab + $spell;
    $essques = $cont + $writdisc + $gram + $vocab + $spell + $write;
    try {
        $sql = 'update mocktestscores set esscontent = esscontent + :content, essgrammar = essgrammar + :gram, essvocab = essvocab + :vocab, essspell = essspell + :spell,  esswritdisc = esswritdisc + :writdisc,  esswrite = esswrite + :write, essquesscore = essquesscore + :essques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':content', $cont);
        $s->bindValue(':gram', $gram);
        $s->bindValue(':vocab', $vocab);
        $s->bindValue(':spell', $spell);
        $s->bindValue(':writdisc', $writdisc);
        $s->bindValue(':write', $write);
        $s->bindValue(':essques', $essques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreessay.html.php?x=1');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

try {
    $sql = 'select essquesscore from mocktestscores where mocid = :id';
    $s = $conn->prepare($sql);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        $col = $s->fetch();
        $score = $col['essquesscore'];
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
    <title>PTE Preparation - Essay Check</title>
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
                        <th>Essay Question</th>
                    </tr>
                    <?php foreach ($result as $row) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['essmid']; ?></td>                        
                        <td><?php echo $row['esscontent']; ?></td>
                    </tr>
                    <?php }?>
                </table>   
                
                <h3>Answers by student</h3>
                <table class="quest" style="width: 100%">
                    <tr>
                        <th>Mock Test Id</th>
                        <th>Answer</th>
                        <th>Words</th>
                        <th>Score</th>
                    </tr>
                    
                    <?php foreach ($results as $row) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['esstestid']; ?></td>                        
                        <td id="text"><?php echo $row['esstext']; ?></td>
                        <td id="words" style="text-align: center"></td>
                        <td>
                            <form action="" method="post" name="MyForm">
                            Content: <select name="content">
                                    <option>Choose Marks</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                            Form: <select name="form">
                                    <option>Choose Marks</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                            Development, structure and coherence: <select name="writdisc1">
                                    <option>Choose Marks</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                            Grammar: <select name="grammar">
                                    <option>Choose Marks</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                            General linguistic range: <select name="writdisc2">
                                    <option>Choose Marks</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                            Vocabulary: <select name="vocab">
                                    <option>Choose Marks</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                            Spelling: <select name="spell">
                                    <option>Choose Marks</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                                <input type="submit" name="score" value="submit" id="score1">
                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </table>
                <h3>Score: <?php echo $score; ?>/30</h3>
                <table class="quest" style="width: 100%">
                    <tr>
                        <th colspan="8">Score Guide</th>
                    </tr>
                    <tr>
                        <th>Score</th>
                        <th>Content</th>
                        <th>Form</th>
                        <th>Development, Structure and Coherence</th>
                        <th>Grammar</th>
                        <th>General Linguistic Range</th>
                        <th>Vocabulary</th>
                        <th>Spelling</th>
                    </tr>
                    <tr>
                        <td style="text-align: center">3</td>
                        <td>Adequately deals with the prompt</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr> 
                    <tr>
                        <td style="text-align: center">2</td>
                        <td>Deals with the prompt but does not deal with one minor aspect</td>
                        <td>Length is between 200 and 300 words</td>
                        <td>Shows good development and logical structure</td>
                        <td>Shows consistent grammatical control of complex language. Errors are 
                            rare and difficult to spot</td>
                        <td>Exhibits smooth mastery of a wide range of language to formulate thoughts 
                            precisely, give emphasis, differentiate and eliminate ambiguity. No sign 
                            that the test taker is restricted in what they want to communicate</td>
                        <td>Good command of a broad lexical repertoire, idiomatic expressions and colloquialisms</td>
                        <td>Correct spelling</td>
                    </tr> 
                    <tr>
                        <td style="text-align: center">1</td>
                        <td>Deals with the prompt but omits a major aspect or more than one minor aspect</td>
                        <td>Length is between 120 and 199 or between 301 and 380 words</td>
                        <td>Is incidentally less well structured, and some elements or paragraphs are poorly linked</td>
                        <td>Shows a relatively high degree of grammatical control. No mistakes which would lead to 
                            misunderstandings</td>
                        <td>Sufficient range of language to provide clear descriptions, express viewpoints and 
                            develop arguments</td>
                        <td>Shows a good range of vocabulary for matters connected to general academic topics. 
                            Lexical shortcomings lead to circumlocution or some imprecision</td>
                        <td>One spelling error</td>
                    </tr>  
                    <tr>
                        <td style="text-align: center">0</td>
                        <td>Does not deal properly with the prompt</td>
                        <td>Length is less than 120 or more than 380 words. Essay is written in capital letters, 
                            contains no punctuation or only consists of bullet points or very short sentences</td>
                        <td>Lacks coherence and mainly consists of lists or loose elements</td>
                        <td>Contains mainly simple structures and/or several basic mistakes</td>
                        <td>Contains mainly basic language and lacks precision</td>
                        <td>Contains mainly basic vocabulary insufficient to deal with the topic at the required level</td>
                        <td>More than one spelling error</td>
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
       window.location = 'scorermcqsingleanswer.html.php?x=';
   });
});

function counters() {
    var value = $('#text').text();

    if (value.length == 0) {
        $('#words').html(0);
        return;
    }
    var regex = /\s+/gi;
    var wordCount = value.trim().replace(regex, ' ').split(' ').length;
    console.log(wordCount);
    $('#words').html(wordCount);
}

$(window).load(function() {
    counters();
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