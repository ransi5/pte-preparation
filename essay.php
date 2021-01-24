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

try {
    $sql = 'select * from essayques where essmid = :testid';
    $s = $conn->prepare($sql);
    $s->bindValue(':testid', $_SESSION['testid']);
    $s->execute();
    while ($row = $s->fetch()) {
        $content = $row['esscontent'];
    }
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if (isset($_POST['content'])) {
    try {
        $sql = 'insert into essayanswers (esstestid, essstudid, esstext) values (:test, :studid, :content)';
        $s = $conn->prepare($sql);
        $s->bindValue(':test', $_SESSION['testid']);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->bindValue(':content', valid($_POST['content']));
        $s->execute();
        header('location: mcqsingleanswer.php?x=' . $_POST['time'] . '&y=' . $_POST['ftime']);
        exit();
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
    <title>PTE Preparation - Essay Question</title>
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
            <p> Pearson Test of English Academic (Mock Test) - <?php echo $_SESSION['name'];?></p>
            <div id="cover">
                <p class="glyphicon glyphicon-time"> Time Remaining </p><div id="timer"></div>
            </div>                
        </div>
        <div class="topper"></div>
        
        <div class="heading">You will have 20 minutes to plan, write and revise an essay about the topic below.
        Your response will be judged on how well you develop a position, organize your ideas, present supporting details
        and control the elements of standard written English. You should write 200-300 words.</div>
        
        <div class="container">
            
            <div class="content"><?php echo trim($content);?></div>
            <br>
            <br>
            <div class="row">
                <div class="col-md-11">
                    <form action="" method="post" id="form" class="form-group" name="MyForm">
                        <textarea name="content" id="bar" class="form-control" rows="10" style="margin: 0 35px;"></textarea>
                        <input type="hidden" id="time" name="time" value="">
                        <input type="hidden" id="ftime" name="ftime" value="">
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-1 text-right">
                    <button id="cut" class="btn btn-default">Cut</button>
                </div>
                <div class="col-md-9 text-center">
                    <p>Press ctrl + V on Windows or command + V on Mac to paste</p>
                </div>
                <div class="col-md-2 text-center">
                    <button id="copy" class="btn btn-default">Copy</button>
                </div>
            </div>
            <div class="wordcount" style="padding: 10px 35px;">Word count: <span id="count">0</span></div>
            <div class="word"></div>
        
            
        </div>
        <div id="footer" class="bottom"><a href="javascript:document.MyForm.submit();" id="submit">Next</a></div>
    </div>
    </div>

    <script>
    var time = 1200 + <?php if ($_GET['x'] < 0) { echo '('.valid($_GET['x']).')';} else {echo '0';}?>;
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
            document.getElementById('bar').disabled = true;
        }
    },1000)    
}
        
    $('document').ready(function(){
        $('#copy').click(function(){
            document.body.oncopy = function() { return true; }
            $('#bar').focus().select(getSelectionText);
            document.execCommand('copy');
            document.body.oncopy = function() { return false; }
        });
    })
    
    $('document').ready(function(){
        $('#cut').click(function(){
            document.body.oncut = function() { return true; }
            $('#bar').focus().select(getSelectionText);
            document.execCommand('cut');
            document.body.oncut = function() { return false; }
        });
    })

$(document).ready(function(){
    $("#cover").click(function(){
        $("#timer").toggle();
    });
});

$('document').ready(function(){
    $('#footer').click(function(){
        $('#bar').removeAttr('disabled');            
    });
})

function getSelectionText(){
    var selectedText = ""
    if (window.getSelection){ // all modern browsers and IE9+
        selectedText = window.getSelection().toString()
    }
    return selectedText
}
function counter() {
    var value = $('#bar').val();

    if (value.length == 0) {
        $('#count').html(0);
        return;
    }
    var regex = /\s+/gi;
    var wordCount = value.trim().replace(regex, ' ').split(' ').length;
    console.log(wordCount);
    $('#count').html(wordCount);
}
    $(document).ready(function() {
    $('#bar').change(counter);
    $('#bar').keydown(counter);
    $('#bar').keypress(counter);
    $('#bar').keyup(counter);
    $('#bar').blur(counter);
    $('#bar').focus(counter);
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