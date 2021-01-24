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
    $sql = 'select * from reorderparagraphques where reomid = :testid and reoqno = :qno';
    $s = $conn->prepare($sql);
    $s->bindValue(':testid', $_SESSION['testid']);
    $s->bindValue(':qno', '2');
    $s->execute();
    while ($row = $s->fetch()) {
        $optiona = $row['reooptiona'];
        $optionb = $row['reooptionb'];
        $optionc = $row['reooptionc'];
        $optiond = $row['reooptiond'];
        $optione = $row['reooptione'];
    }
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if (isset($_POST['time'])) {
    try {
        $a = $_POST['sort'];
        $sql = 'insert into reorderparagraphanswers (reotestid, reoquesno, reostudid, reoanswer) values (:test, :quesno, :studid, :content)';
        $s = $conn->prepare($sql);
        $s->bindValue(':test', $_SESSION['testid']);
        $s->bindValue(':quesno', '2');
        $s->bindValue(':studid', $_SESSION['id']);
        $s->bindValue(':content', $a);
        $s->execute();
        if ($_POST['time'] < 0) {
                header('location: pte10break.php?x=' . $_POST['time'] . '&y=' . $_POST['ftime']);       
                exit();        
        } else {
                header('location: rfillblank.php?x=' . $_POST['time'] . '&y=' . $_POST['ftime']);       
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
    <title>PTE Preparation - Re-Order Paragraph Question 2</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link href="css/teststyle.css" rel="stylesheet" type="text/css" />
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
        
        <div class="container">
            <div class="heading1">The text boxes in the panel have been placed in a random order.
            Restore the original order by dragging the text boxes.</div>
            <div id="wrapper">
                <div class="opt1" id="opt_1"><?php echo $optiona; ?></div>
                <div class="opt1" id="opt_2"><?php echo $optionb; ?></div>
                <div class="opt1" id="opt_3"><?php echo $optionc; ?></div>
                <div class="opt1" id="opt_4"><?php echo $optiond; ?></div>
                <div class="opt1" id="opt_5"><?php echo $optione; ?></div>
            </div> 
            <form action="" method="post" name="MyForm">
                <input type="hidden" id="sort" name="sort" value="">
                <input type="hidden" id="time" name="time" value="">
                <input type="hidden" id="ftime" name="ftime" value="">
            </form>
           
        </div>
        <div id="footer" class="bottom"><a href="javascript:document.MyForm.submit();" id="submit">Next</a></div>
    </div>
    </div>

    <script>
    var time = <?php echo valid($_GET['x']);?>;
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
            $('#sort').attr('disabled','disabled');
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
<script type="text/javascript">
$('document').ready(function(){
    $("#wrapper").sortable({
        update: function (event,ui) {
            var sorted = $(this).sortable('serialize');
            sorted = sorted.split('&');
            console.log(sorted[0])
            var a
            var sort = new Array();
            for (i = 0; i < sorted.length; i++) {
                a = parseInt(sorted[i].slice(6,7));
                sort.push(a);
            }
            document.getElementById('sort').value = sort;           
        }
    });
});
  </script>
 
</body>
</html>