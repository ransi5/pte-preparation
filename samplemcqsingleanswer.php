<?php
ob_start();
include_once 'php/includes/connect.php';
include 'php/includes/access.php';

if (!userIsLoggedIn())
{
include 'pte-preparation-login.html.php';
exit();
}
if (!userHasRole('Member') && !userHasRole('Admin'))
{
$error = 'Only members may access this page.';
include 'accessdenied.html.php';
exit();
}

try {
    $sql = 'select * from smcreadingques where smcmid = :testid and smcqno = :qno';
    $s = $conn->prepare($sql);
    $s->bindValue(':testid', '9');
    $s->bindValue(':qno', '2');
    $s->execute();
    while ($row = $s->fetch()) {
        $content = $row['smccontent'];
        $question = $row['smcquestion'];
        $optiona = $row['smcoptiona'];
        $optionb = $row['smcoptionb'];
        $optionc = $row['smcoptionc'];
        $optiond = $row['smcoptiond'];
    }
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if (isset($_POST['time'])) {
    try {
//        $sql = 'insert into smcreadinganswers (smctestid, smcquesno, smcstudid, smcanswer) values (:test, :quesno, :studid, :content)';
//        $s = $conn->prepare($sql);
//        $s->bindValue(':test', $_SESSION['testid']);
//        $s->bindValue(':quesno', '1');
//        $s->bindValue(':studid', $_SESSION['id']);
//        $s->bindValue(':content', $_POST['options']);
//        $s->execute();
        if ($_POST['time'] < 0) {
                header('location: samplepte10break.php?x=' . $_POST['time'] . '&y=' . $_POST['ftime']);       
                exit();        
        } else {
                header('location: samplemcqmultipleanswer.php?x=' . $_POST['time'] . '&y=' . $_POST['ftime']);       
                exit();        
        }
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}
ob_flush();?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Practice Test - Reading, MCQ Single Answer Question 1</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/teststyle.css" rel="stylesheet" type="text/css" />
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
</head>
<body>
    
    <div class="container-fluid">
    <div class="gill">
        <div class="header">
            <p> Pearson Test of English Academic (Sample)</p>
            <div id="cover">
                <p class="glyphicon glyphicon-time"> Time Remaining </p><div id="timer"></div>
            </div>                
        </div>
        <div class="topper"></div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="content1"><?php echo trim($content)?></div>
                </div>
                <div class="col-md-6">
                    <div class="heading1">Read the text and answer the multiple choice question by selecting
                    the correct response. Only one response is correct.</div>
                    <div class="question"><?php echo trim($question)?></div>
                    <br>
                    <br>
                    <div>
                        <form action="" method="post" name="MyForm">
                            <input type="radio" name="options" value="a"> &nbsp;<?php echo trim($optiona)?><br><br>
                            <input type="radio" name="options" value="b"> &nbsp;<?php echo trim($optionb)?><br><br>
                            <input type="radio" name="options" value="c"> &nbsp;<?php echo trim($optionc)?><br><br>
                            <input type="radio" name="options" value="d"> &nbsp;<?php echo trim($optiond)?><br><br>
                            <input type="hidden" id="time" name="time" value="">
                            <input type="hidden" id="ftime" name="ftime" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer" class="bottom"><a href="javascript:document.MyForm.submit();" id="submit">Next</a></div>
    </div>
    </div>

    <script>
        
    var time = 600 + <?php if ($_GET['x'] < 0) { echo '('.valid($_GET['x']).')';} else {echo '0';}?>;
    var ftime = <?php echo valid($_GET['y']);?>;
    
    document.oncontextmenu = document.body.oncontextmenu = function() {return false;} //disables right click on mouse
    document.body.oncopy = function() { return false; }  //disables copy
    document.body.oncut = function() { return false; }   //disables cut
    
    timer(time, "timer");
    remainingtime(time);
    ftimer(ftime, "ftime");
    
function timer(x, elem){
    var t = setInterval(function(){
        if(x > 0) {              
            var minutes = Math.floor(x/60);
            var seconds = Math.floor(x - minutes * 60);
            var y = minutes + ' : ' + seconds;
            
        } else {
            var seconds = Math.floor(x);
            var y = seconds;            
        }
        var elemContent = document.getElementById(elem);
        elemContent.innerHTML = y
        x--;            
    }, 1000);
}

function ftimer(x, elem){
        var t = setInterval(function(){
        var elemContent = document.getElementById(elem);
            elemContent.value = x
            x--;
            if(x < 0) {
                clearInterval(t);
                window.location.href = 'mocktestend.php';
            }
    }, 1000);
}

function remainingtime(time) {
    var t = setInterval(function(){
        document.getElementById('time').value = time;
        time--;
        if(time <= 0) {
            $('input[type=radio]').attr('disabled','disabled');
        }
    },1000)    
}
    
$(document).ready(function(){
    $("#cover").click(function(){
        $("#timer").toggle();
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