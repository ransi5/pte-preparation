<?php
include_once 'php/includes/connect.php';
include_once 'php/includes/access.php';

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
    //pagination
    $perpage = 1;
    $page = isset($_GET['page']) && $_GET['page'] >= 1 ? (int)$_GET['page'] : 1;
    $limit = ($page * $perpage) - $perpage;
    $sql = "select * from summarisewrittenques where summid = :mid limit $limit, $perpage";
    $s = $conn->prepare($sql);
    $s->bindValue(':mid', $_SESSION['testid']);
    $s->execute();
    $result = $s->fetchAll();
    $sql1 = "select * from summarisetextanswers where sumstudid = :studid and sumtestid = :testid limit $limit, $perpage";
    $s = $conn->prepare($sql1);
    $s->bindValue(':studid', $_SESSION['id']);
    $s->bindValue(':testid', $_SESSION['testid']);
    $s->execute();
    $answer = $s->fetchAll();
    $query = $conn->query("select count(*) from summarisewrittenques where summid = '".$_SESSION['testid']."'");
    $total = $query->fetch();
    $pages = ceil($total[0]/$perpage);    
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

try {
    $sql = "select * from category where id > 2";
        $s = $conn->prepare($sql);
        $s->execute();
        $results = $s->fetchAll();                
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}
        
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Summarize Written Text Answer Key</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link rel="stylesheet" type="text/css" href="css/anskeystyle.css">
    <link rel="stylesheet" type="text/css" href="css/studentportal.css">
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
    <div class="gill">
<!--Start navbar-->
<?php include_once 'php/includes/navbar.html.php'; ?>
<!--End Navbar-->

<!--Start side navigation-->
<div class="container-fluid sidenav">
    <div class="row">
        <div class="col-md-2">
            <div class="sidebox">
                <div>yarsg</div>
                <ul class="navmenu">
                    <p>Welcome</p>
                    <h4 class="center"><?php echo $_SESSION['name']; ?></h4>
                    <li><a href="studdashboard.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-dashboard"></span> &nbsp;Dashboard</a></li>
                    <li><a href="practiceques.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-question-sign"></span> &nbsp;Practice Questions</a></li>
                    <li><a href="mocktest.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-edit"></span> &nbsp;Mock Tests</a></li>
                    <li class="active"><a href="mocktestanskey.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-wrench"></span> &nbsp;Answer Key</a></li>
                    <li class="dropdown">
                        <a href="#"><span class="hovanim"></span><span class="glyphicon glyphicon-stats"></span> &nbsp;G-Analytics &nbsp;<span class="glyphicon glyphicon-menu-down pull-right"></span></a>
                        <ul class="dropdownmenu">
                            <li><a href="mocktestchecked.html.php"><span class="movanim"></span>Results & Micro Analysis</a></li>
                            <li><a href="gmacroanalytics.html.php"><span class="movanim"></span>Macro Analysis</a></li>
                        </ul></li>
                    <li><a href="studfeedbackappt.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-earphone"></span> &nbsp;Feedback Appointment</a></li>
                    <li><a href="upgradeprogram.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-level-up"></span> &nbsp;Upgrade Program</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 mid">
            <h2>Question type: Summarize Text</h2>
            <ul class="pagination">
                <?php for ($i=1; $i <= $pages; $i++) {?>
                <li><a href="?page=<?php echo $i?>">Item <?php echo $i?></a></li>
                <?php } ?>
                <li><a style="background-color: #082f6f; color: white;" href="anskeyEssay.html.php?page=1">Next Item Type</a></li>
            </ul>
            <?php foreach ($result as $row) {?>
            <div class="qbox">
                <h3>Item <?php echo $row['sumqno'];?></h3>
                <p><?php echo $row['sumcontent'];?></p>
                <?php foreach ($answer as $how) {?>
                <div class="youranswer">
                    <h3>Your Answer</h3>
                    <p class="text"><?php echo $how['sumtext'];?></p>
                </div>
                <?php } ?>
                <div class="modanswer">
                    <h3>Model Answer</h3>
                    <p class="text"><?php echo $row['sumanskey'];?></p>
                </div>
            </div>
            <?php } ?>
            
        </div>
        <div class="col-md-2">
            <div class="box">
                <?php foreach ($results as $row) { ?>
                <a href="anskey<?php echo str_replace(' ', '', $row['name']); ?>.html.php?page=1" class="ansbox" id="ans<?php echo trim($row['id']); ?>"><?php echo trim($row['name']); ?></a>
                <?php } ?>
            </div>
        </div>
    </div>

<!--End side navigation-->
<?php include_once 'php/includes/footer.html.php'; ?>
    </div>





<script type="text/javascript">

document.oncontextmenu = document.body.oncontextmenu = function() {return false;}

$(document).ready(function() {
  $('.dropdown').click(function(){
      $('.dropdownmenu').slideToggle();
  });
});

$(document).ready(function() {
   
   var docHeight = $(window).height();
   var footerHeight = $('.footer').height();
   var footerTop = $('.gill').height();
   
   if (footerTop < docHeight) {
        $('.footer').removeClass('bottom1');
        $('.footer').addClass('bottom');
   }
   if ((footerTop) >= docHeight) {
        $('.footer').removeClass('bottom');
        $('.footer').addClass('bottom1');
   }
});

$(document).ready(function() {
    y = $('.footer').position();
    $('.navmenu').css('height', y.top);
});
</script>
</body>
</html>