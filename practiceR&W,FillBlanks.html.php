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

if(!isset($_SESSION['testid']) || $_SESSION['testid'] != 111){
    $_SESSION['testid'] = 111;    
}
$_SESSION['quesno'] = $_GET['page'];

if ($_GET['page'] == 1) {
    try {
        $s = $conn->prepare("delete from rwfillblankanswers where rwftestid = :testid and rwfstudid = :studid");
        $s->bindValue(':testid', $_SESSION['testid']);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->execute();
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
}

try {
    //pagination
    $perpage = 1;
    $page = isset($_GET['page']) && $_GET['page'] >= 1 ? (int)$_GET['page'] : 1;
    $limit = ($page * $perpage) - $perpage;
    $sql = "select * from rwfillblankques where rwfmid = :mid limit $limit, $perpage";
    $s = $conn->prepare($sql);
    $s->bindValue(':mid', $_SESSION['testid']);
    $s->execute();
    $result = $s->fetchAll();
    $query = $conn->query("select count(*) from rwfillblankques where rwfmid = '".$_SESSION['testid']."'");
    $total = $query->fetch();
    $pages = ceil($total[0]/$perpage);    
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

$next = $_SESSION['quesno']+1;
$url = "practiceR&W,FillBlanks.html.php?page=".$next;

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Practice Reading & Writing, Fill in the Blanks</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
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
    <?php 
    if (isset($_POST['time'])) {
        try {
            $sql = 'insert into rwfillblankanswers (rwftestid, rwfquesno, rwfstudid, rwfansa, rwfansb, rwfansc, rwfansd) values (:test, :quesno, :studid, :ansa, :ansb, :ansc, :ansd)';
            $s = $conn->prepare($sql);
            $s->bindValue(':test', $_SESSION['testid']);
            $s->bindValue(':quesno', $_SESSION['quesno']);
            $s->bindValue(':studid', $_SESSION['id']);
            $s->bindValue(':ansa', $_POST['selectbox1']);
            $s->bindValue(':ansb', $_POST['selectbox2']);
            $s->bindValue(':ansc', $_POST['selectbox3']);
            $s->bindValue(':ansd', $_POST['selectbox4']);
            $s->execute();
            if ($_GET['page'] < $total[0]) {
                header('location: '.$url);
            } else {
                echo '<script>window.close();</script>';
            }
            exit();
        } catch (PDOException $e) {
            echo '<br> error updating database: ' . $e->getMessage();
            exit();
        }
    }
    ob_flush();?>
</head>
<body>
    <?php foreach ($result as $row) {?>
    <div class="container-fluid">
    <div class="gill">
        <div class="header">
            <p> PTE Reading & Writing: Fill in the Blanks Practice Questions - <?php echo $_SESSION['name'];?></p>
            <div id="cover">
                <p class="glyphicon glyphicon-time"> Time Remaining </p><div id="timer"></div>
            </div>                
        </div>
        <div class="topper">Question <?php echo $_GET['page']; ?> of <?php echo $total[0]; ?></div>
        
        <div class="container">
            <div class="heading1">Below is a text with blanks. Click on each blank, a list of choices
                 will appear. Select the appropriate answer choice for each blank.</div>
            <br>
            <br>
            <br>
            <form action="" method="post" name="MyForm">
            <div id="contents">
                <?php echo trim($row['rwfcontent']);?>                               
            </div> 
            <input type="hidden" id="time" name="time" value="">   
            </form>
                       
        </div>
        <div id="footer" class="bottom"><a href="javascript:document.MyForm.submit();" id="submit">Next</a></div>
    </div>
    </div>

    <script>
    var time = 150; 
    
    document.oncontextmenu = document.body.oncontextmenu = function() {return false;} //disables right click on mouse
    document.body.oncopy = function() { return false; }  //disables copy
    document.body.oncut = function() { return false; }   //disables cut
        
    timer(time, "timer");
    remainingtime(time);
            
    function timer(x, elem){
        var t = setInterval(function(){
            var minutes = Math.floor(x/60);
            var seconds = Math.floor(x - minutes * 60);
            var y = minutes + ' : ' + seconds;
            var elemContent = document.getElementById(elem);
                elemContent.innerHTML = y
                x--;
                if(x < 0) {
                    clearInterval(t);
                    document.MyForm.submit();
                }
        }, 1000);
    }
    
function remainingtime(time) {
    var t = setInterval(function(){
        document.getElementById('time').value = time;
        time--;
        if(time < 0) {
            clearInterval(t);
            document.MyForm.submit();
        }
    },1000)
}
    
$(document).ready(function(){
    $("#cover").click(function(){
        $("#timer").toggle();
    });
});

<?php 
if ($_GET['page'] == $total[0]) {
    echo "$(document).ready(function(){    
        $('.bottom a, .bottom1 a').text('Close');
});";
}
?>

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
  <?php } ?>
</body>
</html>