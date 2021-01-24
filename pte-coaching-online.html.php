<?php include_once 'php/includes/connect.php'; 
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Coaching Courses Online Along With Practice Tests & More</title>
    <meta name="description" content="Offers one to one personal coaching online along with high quality academic content, practice questions &  scored tests with model answers - Try Us Out!">
    <meta name="keywords" content="">
    <meta itemprop="name" content="PTE Coaching Course Online Along With Practice Tests & More">
    <meta itemprop="description" content="Offers one to one personal coaching online along with high quality academic content, practice questions &  scored tests with model answers - Try Us Out!">
    <meta itemprop="image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg">
    <meta name="twitter:site" content="@ptepreparations">
    <meta name="twitter:title" content="PTE Coaching Courses Online Along With Practice Tests & More">
    <meta name="twitter:description" content="Offers one to one personal coaching online along with high quality academic content, practice questions &  scored tests with model answers - Try Us Out!">
    <meta name="twitter:image:src" content="https://pte-preparation.com/images/ptepreparation-twitter.jpg">
    <meta property="og:url" content="https://www.pte-preparation.com/pte-coaching-online.html.php">
    <meta property="og:image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg" />
    <meta property="og:title" content="PTE Coaching Courses Online Along With Practice Tests & More">
    <meta property="og:description" content="Offers one to one personal coaching online along with high quality academic content, practice questions &  scored tests with model answers - Try Us Out!">
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/silverstyle.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <style>
    .sec1{position: relative; background-image: url("./images/pte-coaching-online.jpg"); 
          background-repeat: no-repeat; background-attachment: fixed; background-size: cover; width: 100%; height: 560px;}
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
            <p>Learn the <span class="green60">Secrets</span></p>
            <p>to <span class="green56">PTE Success</span></p>
            <p>with <span class="green56">Personal Coaching</span></p>
        </div>
        <div class="cname">
            <p>PTE <span class="green56">DIAMOND</span> </p>
        </div>
        <div class="prompt"><a href="pte-courses-enrolment.html.php" class="btn btn-default btn-md">Enrol Now!</a></div>
    </div>
</div>
<!--End Sec1-->
<div class="container-fluid sec2">
    <div class="mobile"><h1>PTE Diamond</h1></div>
    <h1>What you get</h1>
    <div class="line"></div>
    <ul>
        <li>85 days access - study <span class="greenb">Anytime</span> and <span class="greenb">Anywhere</span></li>
        <li>Timed Practice Questions - Practice on <span class="greenb">actual PTE test like portal</span></li>
        <li>10 PTE Scored Practice tests - Practice tests that <span class="greenb">simulate actual PTE test</span></li>
        <li>Answer Key with Model Answers - Further <span class="greenb">develop PTE skills and strategies</span></li>
        <li>In-depth Practice Tests Result & Analysis - Know <span class="greenb">where you stand</span></li>
        <li>Complete G-Analytics - know <span class="greenb">skill areas that require most focus</span></li>
        <li>Option to add coaching hours - Learn the secrets to <span class="greenb">one attempt PTE success</span></li>
        <li>PTE strategy and tips - Learn the <span class="greenb">game and develop strategies</span></li>
        <li>Email support for upto 84 queries - To help you <span class="greenb">improve PTE performance</span></li>
        <li><span class="imp">Free 1 hour of 1-1 Coaching - Limited offer! Hurry!</span></li>
        <li><span style="color: red; font-size: 20px; font-weight: bold;">FREE tutor feedback on Skype for 1 practice test - Limited offer! Hurry!</span></li>
    </ul>
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-8 text-center">
            <div itemprop="video" itemscope itemtype="http://schema.org/VideoObject" style="width: 100%; margin: 0 auto;">
                <h2>Video: <span itemprop="name">PTE Coaching for One Attempt PTE Success</span></h2>
                <meta itemprop="duration" content="T5M15S" />
                <meta itemprop="thumbnailUrl" content="https://www.pte-preparation.com/videoblog/thumbnails/PTECoaching.jpg" />
                <meta itemprop="embedURL" content="https://player.vimeo.com/video/221404614" />
                <meta itemprop="uploadDate" content="2017-06-13T13:00:00+08:00" />
                <meta itemprop="height" content="405" />
                <meta itemprop="width" content="720" />
                <div class="flex-video vimeo">
                    <embed src="https://player.vimeo.com/video/221404614" width="640" height="360" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                </div>
                <span itemprop="description">A very wise man once said "A problem understood is the problem half solved”. This idea is the 
           foundation of our coaching program. It is what sets up apart from classroom coaching where students in line 
           with centuries old ineffective teaching methodologies are fed with pre-prepared lectures and exercises; taking 
           no account of a student's individual needs. Hence, in our coaching program we make all effort to understand you 
           and your English skill level...</span>
            </div>
        </div>
        <div class="col-xs-2"></div>
    </div>
    
    <div class="blink"><a href="pte-courses-enrolment.html.php" class="btn btn-default btn-md">Enrol Now!</a></div>
</div>

<div class="container-fluid sec8">
    <div class="container text-center">
        For description of course features common with Silver course - click <a href="pte-practice-tests.html.php">here</a><br><br>
        For description of course features common with Gold course - click <a href="pte-course-gold.html.php">here</a>
    </div>
</div>
<!--End sec8-->
<!--End Sec2-->
<div class="container-fluid sec3">
    <div class="container">
        <h2>Will 85 days access be enough for PTE practice</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/pte-coaching-85-days.jpg" class="img-responsive" alt="PTE Practice - 85 Days Access">
            </div>
            <div class="col-sm-8">
                <p>Our experience and research has shown that on an e-learning platform, students learn and perform better
                    when under time constraint. The time provided as such, will be sufficient to go through our content and 
                    coaching program thoroughly. However, If at the end of the course you find this time insufficient, you 
                    can email us and we will consider allocating more time based on the reasons you provide.</p>
            </div>
        </div>        
    </div>
</div>
<!--End sec3-->
<div class="container-fluid sec6">
    <div class="container">
        <h2>What is PTE Coaching methodology</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/coaching-methodology.jpg" class="img-responsive" alt="PTE Practice - Timed Practice Question in Real PTE Test Like Conditions">
            </div>
            <div class="col-sm-8">
                <p>Our PTE coaching methodology is unique and one that cannot be implemented in a classroom setting. 
                    It is based on latest research on language training and includes that our 
                    language experts understand your needs by learning common errors, you make while communicating 
                    and comprehending English; then through 1-1 coaching session they make you aware and provide you the 
                    knowledge and exercises or assignments to correct them in a manner so that correct English syntax becomes
                    part of your subconscious mind.</p>
            </div>
        </div>        
    </div>
</div>
<!--End sec6-->
<div class="container-fluid sec5">
    <div class="container">
        <h2>Can I get coaching anytime I want</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/coaching-anytime.jpg" class="img-responsive" alt="PTE Practice - Practice Tests that behave like Actual PTE Test">
            </div>
            <div class="col-sm-8">
                <p>Yes, you can book a coaching session anytime you want. All you need to do is send us an email 
                    to info@pte-preparation.com or fill up the form in the student portal to which you will have 
                    access to when you are enrolled in a course. In the email or form you must provide three options 
                    for when you want to schedule the coaching session.</p>
            </div>
        </div>        
    </div>
</div>
<!--End sec5-->
<div class="container-fluid sec9">
    <div class="container">
        <h2>How is one to one PTE coaching conducted</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/pte-coaching-online-tutor.jpg" class="img-responsive" alt="PTE Coaching - Provides one to one Online Coaching from Best PTE Tutors">
            </div>
            <div class="col-sm-8">
                <p>Personal PTE coaching is conducted on only voice media on Skype. To ensure quality coaching,
                    we recruit only the best PTE instructors and our PTE tutors prepare beforehand by 
                    studying your answers in practice tests and G-Analytics. Our experience and research 
                    enables us to provide instructions and strategies that you will not find elsewhere. Hence, 
                    the probability of you attaining the PTE scores you need in one attempt increases exponentially.</p>                
            </div>            
        </div>        
    </div>
</div>
<div class="container-fluid sec7">
    <div class="container">
        <h2>Can I use PTE coaching session to get practice test and assignment reviews</h2>
        <div class="line"></div>
        <div class="row">
            <div class="col-sm-4">
                <img src="images/PTE-test-review.jpg" class="img-responsive" alt="PTE Practice - Provides Detailed PTE Scores for All PTE Skill Types">
            </div>
            <div class="col-sm-8">
                <p>Yes, you can use the coaching session to get reviews on practice tests and assignments along 
                    with tips and strategies tweaked up for you. For the assignments review, it is not neccessary that 
                    you book a coaching session; as your tutor will provide you with feedback by email. You can book 
                    a coaching session only to get further review or to discuss some doubts you may have; however, you 
                    clarify issues by email.</p>                
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