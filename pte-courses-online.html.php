<?php include_once 'php/includes/connect.php'; 
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Academic Preparation Courses Online</title>
    <meta name="description" content="Offers PTE preparation courses online with high quality academic content, practice questions & tests with model answers & coaching for one attempt PTE success">
    <meta itemprop="name" content="PTE Academic Preparation Courses Online">
    <meta itemprop="description" content="Offers PTE preparation courses online with high quality academic content, practice questions & tests with model answers & coaching for one attempt PTE success">
    <meta itemprop="image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg">
    <meta name="twitter:site" content="@ptepreparations">
    <meta name="twitter:title" content="PTE Academic Preparation Courses Online">
    <meta name="twitter:description" content="Offers PTE preparation courses online with high quality academic content, practice questions & tests with model answers & coaching for one attempt PTE success">
    <meta name="twitter:image:src" content="https://pte-preparation.com/images/ptepreparation-twitter.jpg">
    <meta property="og:url" content="https://www.pte-preparation.com/pte-courses-online.html.php">
    <meta property="og:title" content="PTE Academic Preparation Courses Online">
    <meta property="og:description" content="Offers PTE preparation courses online with high quality academic content, practice questions & tests with model answers & coaching for one attempt PTE success">
    <meta property="og:image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg" />
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/coursesstyle.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
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
<div class="gill">
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
<div class="container sec1">
    <h1>PTE Preparation Courses</h1>
</div>
<!--End Sec1-->

<div class="container sec2">
    <div class="cont"><span style="font-weight: bold">Please note: </span>We have three PTE preparation courses. 
        The choice of which course will be suitable for you is dependent on how much time you have 
        to prepare, what your current level of English is and what your target score 
        is. However, if you have trouble selecting a course, contact us and our PTE experts will be happy 
        to guide you.</div>
   <div class="row">
        <div class="col-sm-4">
            <div class="box">
                <div class="subboxgreen">
                    <div class="header">
                        <h4>PTE</h4>
                        <h2>Silver</h2>
                    </div>                    
                </div>
                <div class="content">
                    <p>
                    PTE Silver is suitable for students who have high proficiency and are confident 
                    of English language skills and only need to familiarize themselves with the PTE test format.</p>
                    <a href="pte-practice-tests.html.php">Learn more!</a>
                </div>                
            </div>
        </div>
        <div class="col-sm-4">            
            <div class="box">
                <div class="subboxblue">
                    <div class="header">
                        <h4>PTE</h4>
                        <h2>Gold</h2>
                    </div>                    
                </div>
                <div class="content">
                    <p>
                    PTE Gold is designed for Comprehensive preparation of PTE test and is suitable 
                    for students with English language proficiency of 65 (PTE) or 6.5 (IELTS) and above.</p>
                    <a href="pte-course-gold.html.php">Learn more!</a>
                </div>                
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box">
                <div class="subboxorange">
                    <div class="header">
                        <h4>PTE</h4>
                        <h2>Diamond</h2>
                    </div>                    
                </div>
                <div class="content">
                    <p>
                    PTE Diamond is designed for Comprehensive preparation of PTE test and is suitable 
                    for students with English language proficiency of 50 (PTE) or 5 (IELTS) and above.</p>
                    <a href="pte-coaching-online.html.php">Learn more!</a>
                </div>                
            </div>
        </div>
       <div class="link">
           <a href="pte-courses-enrolment.html.php">Compare Courses</a>
       </div>
    </div>
</div>


<?php include ('php/includes/footer.html.php'); ?>
</div>

<script type="text/javascript">
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
</script>
<script type='text/javascript'>var fc_JS=document.createElement('script');fc_JS.type='text/javascript';fc_JS.src='https://assets1.freshchat.io/production/assets/widget.js?t='+Date.now();(document.body?document.body:document.getElementsByTagName('head')[0]).appendChild(fc_JS); window._fcWidgetCode='JM7L66MO2E';window._fcURL='https://gillanlearningsolutions.freshchat.io';</script>
</body>
</html>