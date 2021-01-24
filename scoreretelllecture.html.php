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
    $sql = "select * from retelllectureques where retmid = :mid";
        $s = $conn->prepare($sql);
        $s->bindValue(':mid', $_SESSION['moctestid']);
        $s->execute();
        $result = $s->fetchAll();        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

try {
    $sql = "select * from retelllectureanswers where retstudid = :studid and rettestid = :testid";
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
    $cont1 = valid($_POST['content1']);
    $pron1 = valid($_POST['pronunce1']);
    $oral1 = valid($_POST['fluency1']);
    $listen = $cont1;
    $speak = $pron1 + $oral1;
    $retlect = $cont1 + $pron1 + $oral1 + $listen + $speak;
    try {
        $sql = 'update mocktestscores set retcontent = retcontent + :content, retpronounce = retpronounce + :pronounce, retfluency = retfluency + :fluency, retlisten = retlisten + :listen, retspeak = retspeak + :speak, retlectscore = retlectscore + :retlect where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':content', $cont1);
        $s->bindValue(':pronounce', $pron1);
        $s->bindValue(':fluency', $oral1);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':retlect', $retlect);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreretelllecture.html.php?x=1');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content2'])){
    $cont1 = valid($_POST['content2']);
    $pron1 = valid($_POST['pronunce2']);
    $oral1 = valid($_POST['fluency2']);
    $listen = $cont1;
    $speak = $pron1 + $oral1;
    $retlect = $cont1 + $pron1 + $oral1 + $listen + $speak;
    try {
        $sql = 'update mocktestscores set retcontent = retcontent + :content, retpronounce = retpronounce + :pronounce, retfluency = retfluency + :fluency, retlisten = retlisten + :listen, retspeak = retspeak + :speak, retlectscore = retlectscore + :retlect where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':content', $cont1);
        $s->bindValue(':pronounce', $pron1);
        $s->bindValue(':fluency', $oral1);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':retlect', $retlect);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreretelllecture.html.php?x=2');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content3'])){
    $cont1 = valid($_POST['content3']);
    $pron1 = valid($_POST['pronunce3']);
    $oral1 = valid($_POST['fluency3']);
    $listen = $cont1;
    $speak = $pron1 + $oral1;
    $retlect = $cont1 + $pron1 + $oral1 + $listen + $speak;
    try {
        $sql = 'update mocktestscores set retcontent = retcontent + :content, retpronounce = retpronounce + :pronounce, retfluency = retfluency + :fluency, retlisten = retlisten + :listen, retspeak = retspeak + :speak, retlectscore = retlectscore + :retlect where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':content', $cont1);
        $s->bindValue(':pronounce', $pron1);
        $s->bindValue(':fluency', $oral1);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':retlect', $retlect);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreretelllecture.html.php?x=3');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

try {
    $sql = 'select retlectscore from mocktestscores where mocid = :id';
    $s = $conn->prepare($sql);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        $col = $s->fetch();
        $score = $col['retlectscore'];
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
    <title>PTE Preparation - Describe Image Check</title>
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
                        <th>Re-tell lecture Text</th>
                        <th>Answer Key</th>
                    </tr>
                    <?php foreach ($result as $row) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['retmid']; ?></td>
                        <td style="text-align: center"><?php echo $row['retqno']; ?></td>
                        <td><?php echo $row['rettext']; ?></td>
                        <td>
                            <audio controls>
                                <source src="serveruploads/answers/retelllecture/<?php echo $row['retanskey']; ?>" type="audio/mpeg">
                            </audio>
                        </td>
                    </tr>
                    <?php }?>
                </table>   
                
                <p>Answers by student</p>
                <table class="quest" style="width: 100%">
                    <tr>
                        <th>Mock Test Id</th>
                        <th>Item No</th>
                        <th>Answer</th>
                        <th>Score</th>
                    </tr>
                    
                    <?php foreach ($results as $row) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['rettestid']; ?></td>
                        <td style="text-align: center"><?php echo $row['retquesno']; ?></td>
                        <td>
                            <audio controls>
                                <source src="myphpuploaders/clientuploads/retelllecture/<?php echo $row['retfile']; ?>" type="audio/mpeg">
                            </audio>
                        </td>
                        <td>
                            <form action="" method="post" name="MyForm<?php echo $row['retquesno'];?>">
                            Content: <select name="content<?php echo $row['retquesno'];?>">
                                    <option>Choose Marks</option>
                                    <option value="5">5</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                                Pronunciation: <select name="pronunce<?php echo $row['retquesno'];?>">
                                    <option>Choose Marks</option>
                                    <option value="5">5</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select><br>
                                Oral Fluency: <select name="fluency<?php echo $row['retquesno'];?>">
                                    <option>Choose Marks</option>
                                    <option value="5">5</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select>
                                <input type="submit" name="score" value="submit" id="score<?php echo $row['retquesno'];?>">
                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </table>
                <h3>Score: <?php echo $score; ?>/90</h3>
                <table class="quest" style="width: 100%">
                    <tr>
                        <th colspan="4">Score Guide</th>
                    </tr>
                    <tr>
                        <th>Score</th>
                        <th>Content</th>
                        <th>Pronunciation</th>
                        <th>Oral Fluency</th>
                    </tr>
                    <tr>
                        <td style="text-align: center">5</td>
                        <td>Re-tells all points of the presentation and describes characters, 
                            aspects and actions, their relationships, the underlying development, implications and conclusions</td>
                        <td>Native-like</td>
                        <td>Native-like</td>
                    </tr> 
                    <tr>
                        <td style="text-align: center">4</td>
                        <td>describes all key points of the presentation and their relations, 
                            referring to their implications and conclusions</td>
                        <td>Advanced</td>
                        <td>Advanced</td>
                    </tr>  
                    <tr>
                        <td style="text-align: center">3</td>
                        <td>Deals with most points in the presentation and refers to their 
                            implications and conclusions</td>
                        <td>Good</td>
                        <td>Good</td>
                    </tr>  
                    <tr>
                        <td style="text-align: center">2</td>
                        <td>Deals with only one key point and refers to an implication or 
                            conclusion. Shows basic understanding of several core elements of the presentation</td>
                        <td>Intermediate</td>
                        <td>Intermediate</td>
                    </tr>  
                    <tr>
                        <td style="text-align: center">1</td>
                        <td>Describes some basic elements of the presentation but does not make 
                            clear their interrelations or implications</td>
                        <td>Intrusive</td>
                        <td>Intrusive</td>
                    </tr>  
                    <tr>
                        <td style="text-align: center">0</td>
                        <td>Mentions some disjointed elements of the presentation</td>
                        <td>Non-English</td>
                        <td>Non-English</td>
                    </tr>  
                </table>  
                <table class="quest" style="width: 100%">
                    <tr>
                        <th colspan="2">Scoring Criteria for Pronunciation and Oral Fluency</th>
                    </tr>
                    <tr>
                        <th colspan="2">Pronunciation</th>                        
                    </tr>
                    <tr>
                        <td>5 Native-like</td>
                        <td>All vowels and consonants are produced in a manner that is easily understood 
                            by regular speakers of the language. The speaker uses assimilation and deletions 
                            appropriate to continuous speech. Stress is placed correctly in all words and 
                            sentence-level stress is fully appropriate</td>                        
                    </tr> 
                    <tr>
                        <td>4 Advanced</td>
                        <td>Vowels and consonants are pronounced clearly and unambiguously. A few minor 
                            consonant, vowel or stress distortions do not affect intelligibility. All words 
                            are easily understandable. A few consonants or consonant sequences may be distorted. 
                            Stress is placed correctly on all common words, and sentence level stress is reasonable</td>
                    </tr>  
                    <tr>
                        <td>3 Good</td>
                        <td>Most vowels and consonants are pronounced correctly. Some consistent errors might 
                            make a few words unclear. A few consonants in certain contexts may be regularly 
                            distorted, omitted or mispronounced. Stress-dependent vowel reduction may occur 
                            on a few words</td>                        
                    </tr>  
                    <tr>
                        <td>2 Intermediate</td>
                        <td>Some consonants and vowels are consistently mispronounced in a non-native like 
                            manner. At least 2/3 of speech is intelligible, but listeners might need to 
                            adjust to the accent. Some consonants are regularly omitted, and consonant 
                            sequences may be simplified. Stress may be placed incorrectly on some words 
                            or be unclear</td>
                    </tr>  
                    <tr>
                        <td>1 Intrusive</td>
                        <td>Many consonants and vowels are mispronounced, resulting in a strong intrusive 
                            foreign accent. Listeners may have difficulty understanding about 1/3 of the 
                            words. Many consonants may be distorted or omitted. Consonant sequences may be 
                            non-English. Stress is placed in a non-English manner; unstressed words may be 
                            reduced or omitted and a few syllables added or missed</td>
                    </tr>  
                    <tr>
                        <td style="text-align: center">0 Non-English</td>
                        <td>Pronunciation seems completely characteristic of another language. Many consonants 
                            and vowels are mispronounced, misordered or omitted. Listeners may find more than 
                            1/2 of the speech unintelligible. Stressed and unstressed syllables are realized 
                            in a non-English manner. Several words may have the wrong number of syllables</td>
                    </tr>  
                    <tr>
                        <th colspan="2">Oral Fluency</th>                        
                    </tr>
                    <tr>
                        <td>5 Native-like</td>
                        <td>Speech shows smooth rhythm and phrasing. There are no hesitations, repetitions, 
                            false starts or non-native phonological simplifications</td>                        
                    </tr> 
                    <tr>
                        <td>4 Advanced</td>
                        <td>Speech has an acceptable rhythm with appropriate phrasing and word emphasis. 
                            There is no more than one hesitation, one repetition or a false start. There 
                            are no significant non-native phonological simplifications</td>
                    </tr>  
                    <tr>
                        <td>3 Good</td>
                        <td>Speech is at an acceptable speed but may be uneven. There may be more than one 
                            hesitation, but most words are spoken in continuous phrases. There are few repetitions 
                            or false starts. There are no long pauses and speech does not sound staccato</td>                        
                    </tr>  
                    <tr>
                        <td>2 Intermediate</td>
                        <td>Speech may be uneven or staccato. Speech (if >= 6 words) has at least one smooth 
                            three-word run, and no more than two or three hesitations, repetitions or false 
                            starts. There may be one long pause, but not two or more</td>
                    </tr>  
                    <tr>
                        <td>1 Intrusive</td>
                        <td>Speech has irregular phrasing or sentence rhythm. Poor phrasing, staccato or syllabic 
                            timing, and/or multiple hesitations, repetitions, and/or false starts make spoken 
                            performance notably uneven or discontinuous. Long utterances may have one or two long 
                            pauses and inappropriate sentence-level word emphasis</td>
                    </tr>  
                    <tr>
                        <td style="text-align: center">0 Non-English</td>
                        <td>Speech is slow and labored with little discernable phrase grouping, multiple hesitations, 
                            pauses, false starts, and/or major phonological simplifications. Most words are isolated, 
                            and there may be more than one long pause</td>
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
       window.location = 'scoreshortanswer.html.php?x=';
   });
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