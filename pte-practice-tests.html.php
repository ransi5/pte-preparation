<?php include_once 'php/includes/connect.php'; 
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Academic Practice Tests with Detailed Scoring & More</title>
    <meta name="description" content="Offers Silver course for PTE preparation with high quality academic content, practice questions, scored tests with model answers for one attempt PTE success">
    <meta itemprop="name" content="PTE Academic Practice Tests - Online Course">
    <meta itemprop="description" content="Offers Silver course for PTE preparation with high quality academic content, practice questions, scored tests with model answers for one attempt PTE success">
    <meta itemprop="image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg">
    <meta name="twitter:site" content="@ptepreparations">
    <meta name="twitter:title" content="PTE Academic Practice Tests with Detailed Scoring & More">
    <meta name="twitter:description" content="Offers Silver course for PTE preparation with high quality academic content, practice questions, scored tests with model answers for one attempt PTE success">
    <meta name="twitter:image:src" content="https://pte-preparation.com/images/ptepreparation-twitter.jpg">
    <meta property="og:url" content="https://www.pte-preparation.com/pte-practice-tests.html.php">
    <meta property="og:image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg" />
    <meta property="og:title" content="PTE Academic Practice Tests with Detailed Scoring & More">
    <meta property="og:description" content="Offers Silver course for PTE preparation with high quality academic content, practice questions, scored tests with model answers for one attempt PTE success">
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/silverstyle.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <style>
    .sec1{position: relative; background-image: url("./images/pte-practice-tests.jpg"); 
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
        <div class="quote">
            <p>Got English Skills!</p>
            <p>Now Get <span class="green56">PTE Practice</span> for</p>
            <p><span class="green56">One Attempt Success</span></p>
        </div>
        <div class="cname">
            <p>PTE <span class="green56">SILVER</span> </p>
        </div>
        <div class="prompt"><a href="pte-courses-enrolment.html.php" class="btn btn-default btn-md">Enrol Now!</a></div>
    </div>
</div>
<!--End Sec1-->
<div class="container-fluid sec2">
    <div class="mobile"><h1>PTE Silver</h1></div>
    <h1>What you get</h1>
    <div class="line"></div>
    <ul>
        <li>30 days access - Study <span class="greenb">anytime</span> and <span class="greenb">anywhere</span></li>
        <li>Timed Practice Questions - Practice on <span class="greenb">actual PTE test like portal</span></li>
        <li>2 PTE Scored Practice tests - Practice tests that <span class="greenb">simulate actual PTE test</span></li>
        <li>Answer Key with Model Answers - Further <span class="greenb">develop PTE skills and strategies</span></li>
        <li>In-depth Practice tests result & analysis - Know <span class="greenb">where you stand</span></li>
        <li>Micro G-Analytics - Know <span class="greenb">skill areas that require most focus</span></li>
        <li>PTE strategy and tips - Learn the <span class="greenb">PTE game and develop strategies</span></li>
        <li>Upgrade to Gold or Diamond course - If you feel more practice is needed</li>
    </ul>
    <div class="row">
            <div class="col-xs-2"></div>
            <div class="col-xs-8 text-center">
                <div itemprop="video" itemscope itemtype="http://schema.org/VideoObject" style="width: 100%; margin: 0 auto;">
                    <h2>Video: <span itemprop="name">Complete PTE Preparation with Practice Test & More!</span></h2>
                    <meta itemprop="duration" content="T6M31S" />
                    <meta itemprop="thumbnailUrl" content="https://www.pte-preparation.com/videoblog/thumbnails/silvercourse.jpg" />
                    <meta itemprop="embedURL" content="https://player.vimeo.com/video/220983623" />
                    <meta itemprop="uploadDate" content="2017-06-09T20:00:00+08:00" />
                    <meta itemprop="height" content="405" />
                    <meta itemprop="width" content="720" />
                    <div class="flex-video vimeo">
                        <embed src="https://player.vimeo.com/video/220983623" width="640" height="360" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                    </div> 
                    <span itemprop="description">We've designed Silver course for test takers who are extremely proficient in English, have 
           academic English skills and want to familiarize themselves with the PTE test format with perfect practice so 
           they are able to achieve the PTE scores that truly reflect their academic English proficiency. Generally, such 
           test takers are expats who have pursued degrees or other academic courses in English speaking countries.</span>
                </div>
            </div>
            <div class="col-xs-2"></div>
        </div>
    <div class="blink"><a href="pte-courses-enrolment.html.php" class="btn btn-default btn-md">Enrol Now!</a></div>
</div>
<!--End Sec2-->
<div class="container-fluid sec3">
    <div class="container">
        <h2>Will 30 days access be enough for PTE practice</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/pte-practice-30-days.png" class="img-responsive" alt="PTE Practice - 30 Days Access">
            </div>
            <div class="col-sm-8">
                <p>Our experience and research has shown that on an e-learning platform, students learn and perform better
                    when under time constraint. Although, we could provide exorbitant amount of time to attract more 
                    enrollments; however, in line with our mission we decided on 30 days access, which is just 
                    sufficient amount of time for you to thoroughly learn and develop test taking skills for one attempt success
                    in the PTE test.</p>
            </div>
        </div>        
    </div>
</div>
<!--End sec3-->
<div class="container-fluid sec4">
    <div class="container">
        <h2>How will Practice Questions prepare me for PTE test</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/pte-practice-questions-screeshot.jpg" class="img-responsive" alt="PTE Practice - Timed Practice Question in Real PTE Test Like Conditions">
            </div>
            <div class="col-sm-8">
                <p>Our practice questions content is designed to further develop your academic English 
                    communicative and enabling skills. Furthermore, you practice on an online environment 
                    that imitates actual PTE test under timed conditions. This will help you further develop 
                    critical thinking & reasoning skills and PTE test strategies for each question type. As a result, 
                    you will be better equipped to perform in practice tests and the actual PTE test.</p>
            </div>
        </div>        
    </div>
</div>
<!--End sec4-->
<div class="container-fluid sec5">
    <div class="container">
        <h2>Do the PTE practice tests actually simulate the PTE test</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/pte-practice-test-screenshot.jpg" class="img-responsive" alt="PTE Practice - Practice Tests that behave like Actual PTE Test">
            </div>
            <div class="col-sm-8">
                <p>Our PTE Practice tests simulate more than 95% of the actual PTE test conditions. However, this being a 
                    preparatory course; 10% and 30% of our questions are set at difficulty level lower and higher 
                    than actual PTE questions. This has been done to help further develop academic English, and 
                    other PTE skills. As a result, in the actual PTE test, most of our students score 6-10 points 
                    higher than in our practice tests.</p>
            </div>
        </div>        
    </div>
</div>
<!--End sec5-->
<div class="container-fluid sec6">
    <div class="container">
        <h2>What is the use of Answer Keys for PTE practice and preparation</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/pte-practice-answer-key-screenshot.jpg" class="img-responsive" alt="PTE Practice - Learn PTE Machine Scoring System Expected Responses to PTE Questions">
            </div>
            <div class="col-sm-8">
                <p>Answer Keys can be your most important tool for PTE practice and preparation. Our answer key 
                    portal, you will be able to match your answer to the model answer on the same page. Careful study 
                    of answer keys will help you improve PTE academic English, reasoning skills and strategies.
                    For example, when going though the speaking section answer key with a dictionary will enhance 
                    your academic vocabulary, pronunciation along with speaking and listening skills.</p>
            </div>
        </div>        
    </div>
</div>
<!--End sec6-->
<div class="container-fluid sec7">
    <div class="container">
        <h2>How helpful are the PTE practice test results</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/pte-practice-test-score-screenshot.jpg" class="img-responsive" alt="PTE Practice - Provides Detailed PTE Scores for All PTE Skill Types">
            </div>
            <div class="col-sm-8">
                <p>Like Pearson, Our PTE results include overall score and score by skill type on a bar chart. 
                    Questions are scored strictly according to the PTE score guide. Since Pearson keeps the 
                    criteria relating to allocation of scores to various skill  types secret; We have after careful research 
                    developed a complex algorithm to do the same. Our scores are useful for analytical and 
                    PTE test preparation purposes only and do not reflect PTE scores that you may achieve in the actual test.</p>                
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