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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Silver Upgrades</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link rel="stylesheet" type="text/css" href="css/studentportal.css">
    <link rel="stylesheet" type="text/css" href="css/coursesenrolstyle.css">
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
    <div class="row sec2" style="margin-bottom: 0px;">
        <div class="col-md-2">
            <div class="sidebox">
                <div>yarsg</div>
                <ul class="navmenu">
                    <p>Welcome</p>
                    <h4 class="center"><?php echo $_SESSION['name']; ?></h4>
                    <li><a href="studdashboard.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-dashboard"></span> &nbsp;Dashboard</a></li>
                    <li><a href="practiceques.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-question-sign"></span> &nbsp;Practice Questions</a></li>
                    <li><a href="mocktest.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-edit"></span> &nbsp;Mock Tests</a></li>
                    <li><a href="mocktestanskey.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-wrench"></span> &nbsp;Answer Key</a></li>
                    <li class="dropdown">
                        <a href="#"><span class="hovanim"></span><span class="glyphicon glyphicon-stats"></span> &nbsp;G-Analytics &nbsp;<span class="glyphicon glyphicon-menu-down pull-right"></span></a>
                        <ul class="dropdownmenu">
                            <li><a href="mocktestchecked.html.php"><span class="movanim"></span>Results & Micro Analysis</a></li>
                            <li><a href="gmacroanalytics.html.php"><span class="movanim"></span>Macro Analysis</a></li>
                        </ul></li>
                        <li><a href="studfeedbackappt.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-earphone"></span> &nbsp;Feedback Appointment</a></li>
                        <li class="active"><a href="upgradeprogram.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-level-up"></span> &nbsp;Upgrade Program</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 mid">
            <h3>Upgrade Options</h3>
            <div class="row" style="margin-top: 40px;">
                <div class="col-sm-2"></div>
                <div class="col-sm-4">
                    <div class="blk2 header">
                        <h3 style="margin-top: 20px">PTE <br><span class="white">Gold</span></h3>
                        <h4>60 days access</h4>
                        <h3 class="red"><span class="curr"></span> <span class="price2"></span><sup>*</sup></h3>
                    </div>
                    <div class="content">
                        <ul style="color: black;">
                            <li>Get 60 days access</li>
                            <li>Timed practice questions in test like conditions</li>
                            <li>6 scored PTE practice tests</li>
                            <li>Answer key with model answers</li>
                            <li>In-depth practice test results & analysis</li>
                            <li>Complete access to G-Analytics</li>
                            <li>Complete access to PTE strategy and tips in our blog</li>
                            <li>Upgrade to Diamond course</li>
                        </ul>
                        <p><a href="gold-upgrade-confirm.html.php" id="last">Enrol Now!</a></p>
                        <p><a href="pte-course-gold.html.php">Learn More!</a></p>                        
                    </div>
                </div>        
                <div class="col-sm-4">
                    <div class="blk3 header">
                        <h3 style="margin-top: 20px">PTE <br><span class="white">Diamond</span></h3>
                        <h4>85 days access</h4> 
                        <h3 class="red"><span class="curr"></span> <span class="price3"></span><sup>*</sup></h3>
                    </div>
                    <div class="content">
                        <ul style="color: black;">
                            <li>Get 85 days access</li>
                            <li>Timed practice questions in test like conditions</li>
                            <li>10 scored PTE practice tests</li>
                            <li>Answer key with model answers</li>
                            <li>In-depth practice test results & analysis</li>
                            <li>Complete access to G-Analytics</li>
                            <li>Option to add coaching hours</li>
                            <li>Complete access to PTE strategy and tips in our blog</li>
                            <li><span style="color: red; font-size: 20px; font-weight: bold;">FREE upto 1 hour of personal coaching<sup>**</sup></span></li>
                        </ul>
                        <p><a href="sdiamond-upgrade-confirm.html.php" id="last">Enrol Now!</a></p>
                        <p><a href="pte-coaching-online.html.php">Learn More!</a></p>                        
                    </div>            
                </div>
                <div class="col-sm-2"></div>
            </div>
            <h5>* We are setup to accept payments from residents of more than 200 countries. To see 
                if we can accept debit/credit cards from your country <a href="https://www.2checkout.com/global-payments" target="_blank">click here</a>.</h5>
            <h5>** Limited Period Offer</h5>
        </div>
        <div class="col-md-2 right">
            
        </div>
    </div>
</div>
<!--End side navigation-->
<?php include_once 'php/includes/footer.html.php'; ?>
    </div>

<script>
$(document).ready(function() {
    $.getJSON("https://freegeoip.net/json/", function (data) {
        var country = data.country_name;
        var ip = data.ip;
        
        if (country == "India") {
            $('.curr').html('INR')
            $('.price2').text('910');
            $('.price3').text('1,550');            
        } else if (country == "Bangladesh") {
            $('.curr').html('USD');
            $('.price2').text('13');
            $('.price3').text('25');            
        } else if (country == "Pakistan") {
            $('.curr').html('USD');
            $('.price2').text('13');
            $('.price3').text('25');            
        } else if (country == "Nepal") {
            $('.curr').html('USD');
            $('.price2').text('13');
            $('.price3').text('25');            
        } else if (country == "Australia") {
            $('.curr').html('USD');
            $('.price2').text('14');
            $('.price3').text('29');
        } else {
            $('.curr').html('USD');
            $('.price2').text('14');
            $('.price3').text('29');
        }
    });
});
</script>
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