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
    $sql = 'select * from rfillblankques where rfimid = :testid and rfiqno = :qno';
    $s = $conn->prepare($sql);
    $s->bindValue(':testid', $_SESSION['testid']);
    $s->bindValue(':qno', '4');
    $s->execute();
    while ($row = $s->fetch()) {
        $content = $row['rficontent'];
        $optiona = $row['rfioptiona'];
        $optionb = $row['rfioptionb'];
        $optionc = $row['rfioptionc'];
        $optiond = $row['rfioptiond'];
        $optione = $row['rfioptione'];
        $optionf = $row['rfioptionf'];
        $optiong = $row['rfioptiong'];
        $optionh = $row['rfioptionh'];
    }
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if (isset($_POST['time'])) {
    try {
        $sql = 'insert into rfillblankanswers (rfitestid, rfiquesno, rfistudid, rfiansa, rfiansb, '
                . 'rfiansc, rfiansd, rfianse) values (:test, :quesno, :studid, :ansa, :ansb, :ansc, :ansd, :anse)';
        $s = $conn->prepare($sql);
        $s->bindValue(':test', $_SESSION['testid']);
        $s->bindValue(':quesno', '4');
        $s->bindValue(':studid', $_SESSION['id']);
        $s->bindValue(':ansa', $_POST['a']);
        $s->bindValue(':ansb', $_POST['b']);
        $s->bindValue(':ansc', $_POST['c']);
        $s->bindValue(':ansd', $_POST['d']);
        $s->bindValue(':anse', $_POST['e']);
        $s->execute();
        if ($_POST['time'] < 0) {
                header('location: pte10break.php?x=' . $_POST['time'] . '&y=' . $_POST['ftime']);       
                exit();        
        } else {
                header('location: rfillblank5.php?x=' . $_POST['time'] . '&y=' . $_POST['ftime']);       
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
    <title>PTE Preparation - Reading, Fill in the Blank Question 4</title>
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
            <div class="heading1">In the text below some words are missing. Drag words from the box below
            to the appropriate place in the text. To undo an answer choice, drag the word back to the box below
            the text.</div>
            <form action="" method="post" name="MyForm">
            <div id="contents">
                <?php echo $content; ?>                
            </div> 
                <input type="hidden" id="time" name="time" value="">
                <input type="hidden" id="ftime" name="ftime" value="">
            </form>
            <div class="box">
                <span class="draggable" id="d1"><?php echo $optiona; ?></span>
                <span class="draggable" id="d2"><?php echo $optionb; ?></span>
                <span class="draggable" id="d3"><?php echo $optionc; ?></span>
                <span class="draggable" id="d4"><?php echo $optiond; ?></span>
                <span class="draggable" id="d5"><?php echo $optione; ?></span>
                <span class="draggable" id="d6"><?php echo $optionf; ?></span>
                <span class="draggable" id="d7"><?php echo $optiong; ?></span>
                <span class="draggable" id="d8"><?php echo $optionh; ?></span>
            </div>
           
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
            $('.blank').attr('disabled','disabled');
            $('.blank').removeClass('ui-droppable ui-draggable ui-draggable-handle');
            $('span').removeClass('draggable ui-draggable ui-draggable-handle');
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
    $(document).ready(function() {
        
      $('.draggable').draggable({
          containment: 'document',
          revert: true,
          helper: 'clone',
          cursor: 'hand',
      });
      $('.blank').droppable({
          accept: ".draggable",
          drop: function(event, ui) {
              content = $(ui.draggable).clone().text();
              console.log(content);
              $(this).val(content);
              $(ui.draggable).appendTo(this);
              $(this).attr('readonly', true);
              $('input').draggable({
                  helper: 'clone',
                  appendTo: '.box',
                  cancel: ''
              });
              $('.box').droppable({
                  accept: 'input', 
                  drop: function(event, ui) {
                    contents = $(ui.draggable).clone().val();
                    d = document.createElement('span');
                    content = $(d).addClass('draggable').html(contents);
                    console.log(content);
                    $(content).appendTo(this);
                    $(ui.draggable).val(' ');
                    $('.draggable').draggable({
                        containment: 'document',
                        revert: true,
                        helper: 'clone',
                        cursor: 'hand',                        
                    })
                  }
              });
          }
      });      
  });
  $(document).ready(function() {
    $('.draggable:empty').remove();
  });
</script>
 
</body>
</html>