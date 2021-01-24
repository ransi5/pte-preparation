<?php
include_once 'php/includes/connect.php';
include_once 'php/includes/access.php';

if (!userIsLoggedIn())
{
include 'ptelogin.html.php';
exit();
}
if (!userHasRole('Silver') && !userHasRole('Gold') && !userHasRole('Diamond') && !userHasRole('Admin'))
{
$error = 'Only members may access this page.';
include 'accessdenied.html.php';
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
    <title>PTE Preparation - Practice Questions List</title>
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
                    <li class="active"><a href="practiceques.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-question-sign"></span> &nbsp;Practice Questions</a></li>
                    <li><a href="mocktest.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-edit"></span> &nbsp;Mock Tests</a></li>
                    <li><a href="mocktestanskey.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-wrench"></span> &nbsp;Answer Key</a></li>
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
            <div class="box">
                <h3>Practice Questions by category</h3>
                <div class="half">
                    <ul>
                        Please Note - 
                        <li>To simulate actual PTE test like conditions, all questions are timed and 
                            the option to choose which questions you attempt first does not exist.</li>
                        <li>You can re-attempt practice questions, however, your previous answers will be
                            deleted. So, go through the answer key to improve your strategy before
                            re-attempting practice questions.</li>
                        <li>You must attempt all practice question for each item type in one go.</li>
                        <li>Please change your browser settings to allow popups on this website.</li>
                    </ul>
                </div>
                <?php foreach ($results as $row) { ?>
                <a href="practice<?php echo str_replace(' ', '', $row['name']); ?>.html.php?page=1" onclick="window.open('practice<?php echo str_replace(' ', '', $row['name']); ?>.html.php?page=1','_blank','menubar=no,toolbar=no,status=no,top=0,width=1366,height=650'); return false;" class="anskeybox" id="anskey<?php echo trim($row['id']); ?>"><?php echo trim($row['name']); ?></a>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-2 right">
            
        </div>
    </div>
</div>
<!--End side navigation-->
<?php include_once 'php/includes/footer.html.php'; ?>
    </div>




<script type="text/javascript">

$(document).ready(function() {
    $('.dropdown').click(function(){
        $('.dropdownmenu').slideToggle();
    });
});

$(document).ready(function() {
   
   var docHeight = $(window).height();
   var footerHeight = $('#footer').height();
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