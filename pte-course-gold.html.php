<?php include_once 'php/includes/connect.php'; 
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation course - Scored Practice tests with Model Answers & More</title>
    <meta name="description" content="Offers Gold course for PTE preparation with high quality academic content, practice questions, scored tests with detailed analysis of test results - Try Us Out!">
    <meta name="keywords" content="">
    <meta itemprop="name" content="PTE Preparation course - Scored Practice tests with Model Answers & More">
    <meta itemprop="description" content="Offers Gold course for PTE preparation with high quality academic content, practice questions, scored tests with detailed analysis of test results - Try Us Out!">
    <meta itemprop="image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg">
    <meta name="twitter:site" content="@ptepreparations">
    <meta name="twitter:title" content="PTE Preparation course - Scored Practice tests with Model Answers & More">
    <meta name="twitter:description" content="Offers Gold course for PTE preparation with high quality academic content, practice questions, scored tests with detailed analysis of test results - Try Us Out!">
    <meta name="twitter:image:src" content="https://pte-preparation.com/images/ptepreparation-twitter.jpg">
    <meta property="og:url" content="https://www.pte-preparation.com/pte-course-gold.html.php">
    <meta property="og:image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg" />
    <meta property="og:title" content="PTE Preparation course - Scored Practice tests with Model Answers & More">
    <meta property="og:description" content="Offers Gold course for PTE preparation with high quality academic content, practice questions, scored tests with detailed analysis of test results - Try Us Out!">
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/silverstyle.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <style>
        .sec1{position: relative; background-image: url("./images/pte-courses-online.jpg"); 
            background-repeat: no-repeat; background-attachment: fixed; background-size: cover; width: 100%; height: 570px;}
        .flex-video {
            position: relative;
            padding-top: 25px;
            padding-bottom: 67.5%;
            height: 0;
            margin-bottom: 16px;
            overflow: hidden;
          }

          .flex-video.widescreen { padding-bottom: 57.25%; }
          .flex-video.vimeo { padding-top: 0; }

          .flex-video embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
          }
    </style>
    <script async src="js/jquery-1.11.0.min.js"></script>
    <script async src="js/bootstrap.min.js"></script>
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
                            <div class="col-sm-2 active">
                                <li><div class="hovanim"></div><a href="pte-courses-online.html.php">Courses</a></li>
                            </div>
                            <div class="col-sm-2">
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
<!--Start slide-->
<div class="container-fluid sec1">
    
    <div class="container">
        <div class="logo">
            <span class="logtxt">PTE</span>
            <div class="logbox">preparation</div>
        </div>
        <div class="quoteg">
            <p>Improve <span class="green60">Academic English</span></p>
            <p>and Lay the <span class="green56">Foundation</span> for</p>
            <p><span class="green60">One Attempt PTE Success</span></p>
        </div>
        <div class="cnameg">
            <p>PTE <span class="green56">GOLD</span> </p>
        </div>
        <div class="prompt1"><a href="pte-courses-enrolment.html.php" class="btn btn-default btn-md">Enrol Now!</a></div>
    </div>
</div>
<!--End Sec1-->
<div class="container-fluid sec2">
    <div class="mobile"><h1>PTE Gold</h1></div>
    <h1>What you get</h1>
    <div class="line"></div>
    <ul>
        <li>60 days access - Study <span class="greenb">anytime</span> and <span class="greenb">anywhere</span></li>
        <li>Timed Practice Questions - Practice on <span class="greenb">actual PTE test like portal</span></li>
        <li>6 PTE Scored Practice tests - Practice tests that <span class="greenb">simulate actual PTE test</span></li>
        <li>Answer Key with Model Answers - Further <span class="greenb">develop PTE skills and strategies</span></li>
        <li>In-depth Practice tests result & analysis - Know <span class="greenb">where you stand</span></li>
        <li>Complete G-Analytics - know <span class="greenb">skill areas that require most focus</span></li>
        <li>PTE strategy and tips - Learn the <span class="greenb">game and develop strategies</span></li>
        <li>Email support for upto 21 queries - To help you <span class="greenb">improve PTE performance</span></li>
        <li>Upgrade to Diamond course - If you feel more practice is needed</li>
        <li><span style="color: red; font-size: 20px; font-weight: bold;">FREE tutor feedback on Skype for 1 practice test - Limited offer! Hurry!</span></li>
    </ul>
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-8 text-center">
            <div itemprop="video" itemscope itemtype="http://schema.org/VideoObject" style="width: 100%; margin: 0 auto;">
                <h2>Video: <span itemprop="name">How to Improve PTE Academic Score with Gold Course</span></h2>
                <meta itemprop="duration" content="T4M46S" />
                <meta itemprop="thumbnailUrl" content="https://www.pte-preparation.com/videoblog/thumbnails/ImprovePTEscores.jpg" />
                <meta itemprop="embedURL" content="https://player.vimeo.com/video/221251862" />
                <meta itemprop="uploadDate" content="2017-06-12T20:00:00+08:00" />
                <meta itemprop="height" content="405" />
                <meta itemprop="width" content="720" />
                <div class="flex-video vimeo">
                    <embed src="https://player.vimeo.com/video/221251862" width="640" height="360" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                </div>
                <span itemprop="description">The Gold course is for test takers with intermediate proficiency in English, or students 
           with English proficiency of 65 and above. In this course, such students are exposed to content that will 
           help them improve and learn new academic English skills to achieve the required scores in one attempt.</span>
            </div>
        </div>
        <div class="col-xs-2"></div>
    </div>
    <div class="blink"><a href="pte-courses-enrolment.html.php" class="btn btn-default btn-md">Enrol Now!</a></div>
</div>
<!--End Sec2-->
<div class="container-fluid sec7 text-center">
    For description of course features common with Silver course - click <a href="pte-practice-tests.html.php">here</a>
</div>
<!--End Sec7-->
<div class="container-fluid sec4">
    <div class="container">
        <h2>Will 60 days access be enough for PTE practice</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/pte-courses-60-days.jpg" class="img-responsive" alt="PTE Practice - 60 Days Access">
            </div>
            <div class="col-sm-8">
                <p>On an e-learning platform, students learn and perform better when under time constraint. As such 60 days 
                    is more than sufficient to go through our content thoroughly in order to achieve PTE success in one attempt.
                    However, If at the end of the course you find this time insufficient, you can email us and we will consider 
                    allocating more time based on the reasons you provide.</p>
            </div>
        </div>        
    </div>
</div>
<div class="container-fluid sec5">
    <div class="container">
        <h2>What does email support include</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/PTE-email-support.jpg" class="img-responsive" alt="PTE Practice - Timed Practice Question in Real PTE Test Like Conditions">
            </div>
            <div class="col-sm-8">
                <p>You can use the email support to ask questions on any topic relating to academic English or the PTE test, 
                    including advice on improving academic English and PTE skills. Furthermore, you can use email support 
                    to get reviews on long answer writing and speaking item types, such as re-tell lecture, describe image, 
                    essay to name a few.</p>
            </div>
        </div>        
    </div>
</div>
<div class="container-fluid sec8">
    <div class="container">
        <h2>What is G-Analytics and how will it help in PTE test preparation</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/pte-courses-analytics-screenshot.jpg" class="img-responsive" alt="PTE Courses - Get Detailed analysis of PTE Test Scores so You Know Where You Stand & What to do Next">
            </div>
            <div class="col-sm-8">
                <p>G-Analytics is developed exclusively for the PTE test and plays the part of your personal coach. 
                    In easy to understand charts, it will show you scores, trends and break up of the given scores, 
                    for practice tests, question types and skill areas on micro and macro level. It also generates 
                    question types and skill areas that you need to expend more effort on, to achieve your given 
                    target score.</p>                
            </div>            
        </div>
        <div class="link">
            <a href="pte-courses-enrolment.html.php">Enrol Now</a>
        </div>
    </div>
</div>
<?php include ('php/includes/footer.html.php'); ?>


<script type='text/javascript'>var fc_JS=document.createElement('script');fc_JS.type='text/javascript';fc_JS.src='https://assets1.freshchat.io/production/assets/widget.js?t='+Date.now();(document.body?document.body:document.getElementsByTagName('head')[0]).appendChild(fc_JS); window._fcWidgetCode='JM7L66MO2E';window._fcURL='https://gillanlearningsolutions.freshchat.io';</script>

</body>
</html>