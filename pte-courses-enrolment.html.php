<?php include_once 'php/includes/connect.php'; 
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Practice & Preparation Courses Comparison - Enrol</title>
    <meta name="description" content="Offers PTE preparation online courses featuring high quality academic content in practice questions & tests with model answers, coaching & MORE!">
    <meta name="keywords" content="">
    <meta itemprop="name" content="PTE Practice & Preparation Courses Comparison - Enrol">
    <meta itemprop="description" content="Offers PTE preparation online courses featuring high quality academic content in practice questions & tests with model answers, coaching & MORE!">
    <meta itemprop="image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg">
    <meta name="twitter:site" content="@ptepreparations">
    <meta name="twitter:title" content="PTE Practice & Preparation Courses Comparison - Enrol">
    <meta name="twitter:description" content="Offers PTE preparation online courses featuring high quality academic content in practice questions & tests with model answers, coaching & MORE!">
    <meta name="twitter:image:src" content="https://pte-preparation.com/images/ptepreparation-twitter.jpg">
    <meta property="og:url" content="https://www.pte-preparation.com/pte-courses-enrolment.html.php">
    <meta property="og:image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg" />
    <meta property="og:title" content="PTE Practice & Preparation Courses Comparison - Enrol">
    <meta property="og:description" content="Offers PTE preparation online courses featuring high quality academic content in practice questions & tests with model answers, coaching & MORE!">
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/coursesenrolstyle.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <style>
        .sec2 p a{padding: 6px 60px; background-color: #0fa80f; text-decoration: none; font-size: 20px; 
            border-radius: 4px; color: white;}
        #mobspec{font-size: 18px;}
        @media screen and (max-width:767px) {
            .sec2 p a{padding: 6px 15px; background-color: #0fa80f; text-decoration: none; font-size: 16px; 
            border-radius: 4px; color: white;}
            #mobspec{display: none}
        }
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
<!--Start navbar-->
<div class="container-fluid">
    <nav class="nav navbar-default">
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="myNavbar">
                <div class="row">
                    <ul class="nav navbar-nav">                    
                            <div class="col-sm-2">
                                <li><div class="hovanim"></div><a href="https://www.pte-preparation.com/"><span class="glyphicon glyphicon-home"></span></a></li>
                            </div>
                            <div class="col-sm-2">
                                <li><div class="hovanim"></div><a href="pte-courses-online.html.php">Courses</a></li>
                            </div>
                            <div class="col-sm-2 active">
                                <li><div class="hovanim"></div><a href="pte-courses-enrolment.html.php">Enrol</a></li>
                            </div>
                            <div class="col-sm-2">
                                <li><div class="hovanim"></div><a href="pte-preparation-blog.html.php">Blog</a></li>
                            </div>
                            <div class="col-sm-2">
                                <li><div class="hovanim"></div><a href="pte-preparation-contact.html.php">Contact</a></li>
                            </div>
                            <div class="col-sm-2">
                                
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != FALSE) { 
                            echo '<li><div class="hovanim"></div><a href="php/ptelogout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout</a></li>'; 
                        } else { 
                            echo '<li><div class="hovanim"></div><a href="pte-preparation-login.html.php"><span class="glyphicon glyphicon-log-in"> </span> Login</a></li>'; 
                        }?> 
                            </div>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
<!--End Navbar-->
<div class="container sec1">
    <h1>PTE Courses Comparison</h1>
</div>
<!--End Sec1-->


<div class="container sec2">
    <p class="cont">We have three PTE courses available. The choice of which course will be suitable for you depends
        on how much time you have to prepare, what your current level of English is and what your target score is. 
        Below is a comparison, to help you make a decision. However, if you have trouble selecting a course; contact 
        us; our PTE experts will happily guide you.</p>
    <p id="mobspec">Before you Enrol - &nbsp;<a href="javascript:window.open('sampletestadvice.html.php','_blank','menubar=no,toolbar=no,status=no,top=0,width=1366,height=650')">Try our Free Sample test</a></p>
    <p id="spec" style="display: none; font-size: 18px; color: royalblue;"></p>
    <div class="row">
        <div class="col-sm-4">
            <div class="blk1 header">
            <h3>PTE <br><span class="white">SILVER</span></h3>
                <h4>30 days access</h4>
                <h3 class="red"><span class="curr"></span> <strike class="price1"></strike> <span class="offer"></span><sup>**</sup></h3>
            </div>
            <div class="content">
                <ul>
                    <li>Get 30 days access</li>
                    <li>Timed practice questions in test like conditions</li>
                    <li>2 scored PTE practice tests</li>
                    <li>Answer key with model answers</li>
                    <li>In-depth practice test results & analysis</li>
                    <li>Micro G-Analytics</li>
                    <li>Complete access to PTE strategy and tips in our blog</li>
                    <li>Upgrade to Gold or Diamond courses</li>
                </ul>
                <p><a href="silver-enrol-confirm.html.php" id="last">Enrol Now!</a></p>
                <p><a href="pte-practice-tests.html.php">Learn More!</a></p>                
            </div>
        </div>
        <div class="col-sm-4">
            <div class="blk2 header">
                <h3>PTE <br><span class="white">Gold</span></h3>
                <h4>60 days access</h4>
                <h3 class="red"><span class="curr"></span> <span class="price2"></span><sup>*</sup></h3>
            </div>
            <div class="content">
                <ul>
                    <li>Get 60 days access</li>
                    <li>Timed practice questions in test like conditions</li>
                    <li>6 scored PTE practice tests</li>
                    <li>Answer key with model answers</li>
                    <li>In-depth practice test results & analysis</li>
                    <li>Complete access to G-Analytics</li>
                    <li>Complete access to PTE strategy and tips in our blog</li>
                    <li>Email support for upto 21 queries on on any topic relating to PTE preparation<sup>****</sup></li>
                    <li>Upgrade to Diamond course</li>
                    <li><span style="color: red; font-size: 20px; font-weight: bold;">FREE tutor feedback on Skype for 1 practice test of your choice<sup>***</sup></span></li>
                </ul>
                <p><a href="gold-enrol-confirm.html.php" id="last">Enrol Now!</a></p>
                <p><a href="pte-course-gold.html.php">Learn More!</a></p>                
            </div>
        </div>        
        <div class="col-sm-4">
            <div class="blk3 header">
                <h3>PTE <br><span class="white">Diamond<sup>*</sup></span></h3>
                <h4>85 days access</h4> 
                <h3 class="red"><span class="curr"></span> <span class="price3"></span><sup>*</sup></h3>
            </div>
            <div class="content">
                <ul>
                    <li>Get 85 days access</li>
                    <li>Timed practice questions in test like conditions</li>
                    <li>10 scored PTE practice tests</li>
                    <li>Answer key with model answers</li>
                    <li>In-depth practice test results & analysis</li>
                    <li>Complete access to G-Analytics</li>
                    <li>Complete access to PTE strategy and tips in our blog</li>
                    <li>Email support for upto 84 queries on on any topic relating to PTE preparation<sup>****</sup></li>
                    <li>Option to add coaching hours</li>
                    <li><span style="color: red; font-size: 20px; font-weight: bold;">FREE tutor feedback on Skype for 1 practice test of your choice<sup>***</sup></span></li>
                    <li><span style="color: red; font-size: 20px; font-weight: bold;">FREE upto 1 hours of personal coaching<sup>**</sup></span></li>
                </ul>
                <p><a href="diamond-enrol-confirm.html.php" id="last">Enrol Now!</a></p>
                <p><a href="pte-coaching-online.html.php">Learn More!</a></p>                
            </div>            
        </div>
    </div>
    <div class="referral">
        <h3 style="font-weight: bold;">PTE Preparation Referral Program</h3>
        <p>The intent of this referral program is to make our courses affordable.</p>
        <p>This offer is valid only for the duration of the course you are enrolled in.</p>
        <p>Under the referral program, if you get two family or friends to enroll in any of our courses, you get a free upgrade</p>
        <p>So, if you are enrolled in Silver course and get two family or friends to enroll, you get a free upgrade to Gold 
            course. Likewise, students enrolled in Gold course get free upgrade to Diamond course.</p>
        <p>Students enrolled in Diamond course get additional upto one hour of 1-1 personal coaching free for every family member or friend 
            who enrolls in one of our courses.</p>
        <p>The student should have enrolled after you.</p>
        <p>To avail this offer all you need to do is use the "Referral program" form in the dashboard section of your student 
            portal to send us the email addresses of your referrral. Alternatively, you can email info@pte-preparation.com 
            the registered email addresses of your referrals.</p>
        <p>We will upgrade your course within 24 hours of receipt of your email.</p>
    </div>
    <h5>* We are setup to accept payments from residents of more than 200 countries. To see 
        if we can accept debit/credit cards from your country <a href="https://www.2checkout.com/global-payments" target="_blank">click here</a>.</h5>
    <h5>** Limited period offer</h5>
    <h5>*** Limited period offer. For Free practice test feedback you will have to email customerservice@pte-preparation.com requesting Skype session.</h5>
    <h5>**** Email support limited to 7 queries per week. However, you can carry forward unused email queries</h5>
</div>


<?php include ('php/includes/footer.html.php'); ?>
<script>
$(document).ready(function() {
    $.getJSON("https://freegeoip.net/json/", function (data) {
        var country = data.country_name;
        var ip = data.ip;
        
        if (country == "India") {
            $('.curr').html('INR')
            $('.price1').text('1,220');
            $('.offer').text('860');
            $('.price2').text('1,810');
            $('.price3').text('2,470');
            $('#spec').show();
            $('#spec').text('Good News! Residents of India can now pay using their local debit/credit cards');
        } else if (country == "Bangladesh") {
            $('.curr').html('USD');
            $('.price1').text('17');
            $('.price2').text('26');
            $('.price3').text('39');
            $('#spec').show();
            $('#spec').text('Good News! Residents of Bangladesh can now pay using their local debit/credit cards');
        } else if (country == "Pakistan") {
            $('.curr').html('USD');
            $('.price1').text('17');
            $('.price2').text('26');
            $('.price3').text('39');
            $('#spec').show();
            $('#spec').text('Good News! Residents of Pakistan can now pay using their local debit/credit cards');
        } else if (country == "Nepal") {
            $('.curr').html('USD');
            $('.price1').text('17');
            $('.price2').text('26');
            $('.price3').text('39');
            $('#spec').show();
            $('#spec').text('Good News! Residents of Nepal can now pay using their local debit/credit cards');
        } else if (country == "Australia") {
            $('.curr').html('USD');
            $('.price1').text('25');
            $('.price2').text('35');
            $('.price3').text('50');
        } else {
            $('.curr').html('USD');
            $('.price1').text('25');
            $('.price2').text('35');
            $('.price3').text('50');
        }
    });
});

setTimeout(function(){
    if ($('.curr').html() == '' || $('.price1').text() == ''){
        $('.curr').html('USD');
        $('.price1').text('25');
        $('.price2').text('35');
        $('.price3').text('50');
    }
},3000)
</script>
<script type='text/javascript'>var fc_JS=document.createElement('script');fc_JS.type='text/javascript';fc_JS.src='https://assets1.freshchat.io/production/assets/widget.js?t='+Date.now();(document.body?document.body:document.getElementsByTagName('head')[0]).appendChild(fc_JS); window._fcWidgetCode='JM7L66MO2E';window._fcURL='https://gillanlearningsolutions.freshchat.io';</script>
</body>
</html>