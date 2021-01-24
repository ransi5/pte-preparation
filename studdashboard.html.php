<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once 'php/includes/connect.php';
include_once 'php/includes/access.php';
include_once 'php/includes/maintenance.php';

if (!userIsLoggedIn())
{
include 'pte-preparation-login.html.php';
exit();
}
if (!userHasRole('Member') && !userHasRole('Silver') && !userHasRole('Gold') && !userHasRole('Diamond') && !userHasRole('Admin'))
{
$error = 'Only members may access this page.';
include 'accessdenied.html.php';
exit();
}

checkaccountvalidity($_SESSION['id']);

try {
    $sql = "select count(*) from mocktestscores where mocstudid = :studid";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->execute();
        $results = $s->fetch();
        $attemptedmocktests = $results['0'];
        $answerkey = $results['0'];
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

try {
    $sql = "select count(*) from mocktestscores where mocstudid = :studid and mocstatus = 'checked'";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->execute();
        $result = $s->fetch();
        $resultsmocktests = $result['0'];
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

try {
    $sql = "select * from feedbackappttime where timstudid = :studid";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->execute();
        $result1 = $s->fetch();
        if (userHasRole('Admin') || userHasRole('Diamond')) {
            $sql1 = "select COUNT(*) from feedbackappttime where timstudid = :studid";
            $s = $conn->prepare($sql1);
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $result2 = $s->fetch();
            if ($result2[0] < 1) {
                $timeallocated = 'Purchase Time';
                $timeremaining = 'Purchase Time';
            } else {
                $timeallocated = $result1['timallocated'];
                $timeremaining = $timeallocated - $result1['timconsumed']; 
            }
        } else {
            $timeallocated = 'Upgrade program';
            $timeremaining = 'Upgrade program';
        }
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

try {
    $sql = "select * from members where id = :studid";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->execute();
        $result3 = $s->fetch();
        $expdate = date('d-m-Y', strtotime($result3['expdate']));
        $expirydate = strtotime($result3['expdate']);
        $present = strtotime(date('Y-m-d H:i:s'));
        $diff = $expirydate - $present;        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'Change Password') {
    $pass = valid($_POST['pass']);
    $pass1 = valid($_POST['pass1']);    
    
    if (strlen($pass) < 6 || strlen($pass1) < 6) {
        $errors[] = '<br>*Password should be atleast 6 characters long';
    }
    
    if ($pass != $pass1) {
        $errors[] = '<br>*Password do not match';
    }
        
    if (empty($errors)) {
        try {
            $sql = 'update members set PASSWORD = :pass where id = :id';
            $s = $conn->prepare($sql);
            $s->bindValue(':pass', $pass);
            $s->bindValue(':id', $_SESSION['id']);
            $result4 = $s->execute();
            if($result4){
                $success = 'You password is successfully changed';
                $_SESSION['password'] = $pass;
            }
        } catch (PDOException $e) {
            $errors[] = '<br>Error signing up: ' . $e->getMessage();
            exit();
        }        
    }
}

if (userHasRole('Silver')) {
    $mocktestsno = 2 - $attemptedmocktests;
}

if (userHasRole('Gold')) {
    $mocktestsno = 5 - $attemptedmocktests;
}

if (userHasRole('Diamond')) {
    $mocktestsno = 10 - $attemptedmocktests;
}

if (userHasRole('Admin')) {
    $mocktestsno = 10 - $attemptedmocktests;
}

if (isset($_POST['action']) && $_POST['action'] == 'Send') {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $subject = 'Referral Program';
    $message = valid($_POST['message']);                          
        
    $to = '<info@pte-preparation.com>';
    $sub = $subject;
    $header = "from: ". $email."\r\n";            
    $header .= "Reply-To: ".$email."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $mess = $message;
    try {
        $sentmail = mail($to,$sub,$mess,$header);
    } catch (PDOException $e) {
        $errors[] = '<br>Error sending message. Please contact +919830704729';
    }    

    if ($sentmail) {
        header('location: studdashboard.html.php?success=Your message has been sent. We will be in touch asap within 24hrs.&error=');
        exit();
    } else {
        header('location: studdashboard.html.php?error=Could not send message. Please contact 0091 9830704729.&success=');
        exit();
    }
}


ob_flush();?>


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
    <style>
        .jumbotron{padding: 14px !important; margin-top: 30px;}

        .jumbotron h3{color: #f55959;}

        .jumbotron h4, .sidenav .jumbotron h5{color: black;}

        .jumbotron p{color: black; font-size: 16px; margin-top: 25px;}

        .jumbotron h4:not(:first-of-type){font-size: 20px; font-weight: bold;}

        .jumbotron h4:first-of-type{font-size: 16px;}

        .jumbotron{margin-bottom: 15px;}

        .jumbotron h3{padding-top: 0px; margin-top: 0px;}
        
        .jumbotron .reader a{color: black; display: inline-block; padding: 10px 30px; margin-top: 5px; 
                     background-color: #f55959; font-size: 14px; color: white; border-radius: 4px; 
                     font-weight: bold; text-decoration: none;}
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
    <script>
    <?php 
    if (userHasRole('Member') == 'TRUE') {
        echo 'window.location.href = "https://pte-preparation.com/pte-courses-enrolment.html.php"';
    }
    
    ?>
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
                    <li class="active"><a href="studdashboard.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-dashboard"></span> &nbsp;Dashboard</a></li>
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
                        <li><a href="upgradeprogram.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-level-up"></span> &nbsp;Upgrade Program</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 mid">
            <h2 class="mobile">As all functions may not work on a handheld device, please log on a laptop/desktop to access student portal.</h2>
            <h3><span class="glyphicon glyphicon-dashboard"></span> &nbsp;Dashboard</h3>
            <div class="row">
                <div class="col-md-6 sec1">
                    <div class="infobox">
                        <div class="info info1">Mock tests active :<br> <h4><?php echo $mocktestsno; ?></h4></div>
                        <div class="info info2">Mock tests attempted :<br> <h4><?php echo $attemptedmocktests; ?></h4></div>
                        <div class="info info3">Answer Keys active :<br> <h4><?php echo $answerkey; ?></h4></div>
                        <div class="info info4">Results available:<br> <h4><?php echo $resultsmocktests; ?></h4></div>
                        <div class="info info5">Coaching time allocated :<br> <h4><?php echo $timeallocated; ?></h4></div>
                        <div class="info info6">Coaching time remaining :<br> <h4><?php echo $timeremaining; ?></h4></div>
                    </div>
                </div>
                <div class="col-md-6 sec1">
                    <div class="expinfo">
                        <div class="expbox">
                            <div class="expbox1">
                                <h4>Your account access expires on</h4>
                                <h2><?php echo $expdate; ?></h2>
                            </div>
                            <div class="expbox2">
                                <h4>Time Remaining</h4>
                                <h2 id="timer1"></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3>Must Read Articles Before You Begin</h3>
            <div class="jumbotron">
                <h3>How to go through our content for one attempt PTE success</h3>
                <h4>Our PTE mock tests and content are designed to help PTE test takers achieve their target scores with ease and in one attempt...</h4>
                <h5>Author: <span class="label label-primary">GLS LLP</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: <span class="label label-success">10-03-2017</span></h5>
                <div class="reader">
                    <a href="https://www.pte-preparation.com/pte-blog-reader.html.php?blogid=2">Read More!</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 sec3">
                    <div class="chgpass">
                        <h2>Change Password</h2>
                        <p><span class="errors"><?php if (!empty($errors)){foreach($errors as $error){echo $error;}}?></span><?php if(!empty($success)){echo $success;} ?></p>
                        <form action="" method="post" role="form">
                            <div class="form-group">
                                <label for="password">Password:<span class="errors">*</span></label>
                                <input type="password" name="pass" class="form-control" placeholder="Enter a password" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Repeat Password:<span class="errors">*</span></label>
                                <input type="password" name="pass1" class="form-control" placeholder="Repeat password" required>
                            </div>
                            <input type="submit" name="action" value="Change Password" class="btn btn-default btn-lg">
                        </form>
                    </div>
                </div>
                <div class="col-md-6 sec4">
                    <div class="referral">
                        <h2>Referral Program</h2>
                        <p id="refer"></p>
                        <div><a target='_blank' href='https://www.pte-preparation.com/pte-courses-enrolment.html.php'>
                                Learn More!</a></div>
                        <p><span class="errors"><?php if (isset($_GET['error'])){echo trim($_GET['error']);}?></span><?php if(isset($_GET['success'])){echo trim($_GET['success']);} ?></p>
                        <form action="" method="post" role="form">
                            <div class="form-group">
                                <label for="message">Provide email addresses of students who have enrolled because of your reference.<span class="errors">*</span></label>
                                <textarea name="message" class="form-control" placeholder="Enter email addresses only" required></textarea>
                            </div>
                            <input type="submit" name="action" value="Send" class="btn btn-default btn-lg">
                        </form>
                    </div>
                </div>
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
enddatecounter(<?php echo $diff; ?>);
function enddatecounter(x) {
    var t = setInterval(function(){        
        days = Math.floor(x/(60*60*24));
        hours = Math.floor((x-days*24*60*60)/(60*60));
        minutes = Math.floor((x-days*24*60*60-hours*60*60)/60);
        seconds = Math.floor(x-days*24*60*60-hours*60*60-minutes*60);
        var counter = days + '<span class="minify"> Days </span>' + hours + '<span class="minify"> Hours </span>' + minutes + '<span class="minify"> Minutes </span>' + seconds + '<span class="minify"> Seconds </span>'; 
       document.getElementById('timer1').innerHTML = counter;
       x--;
       if(x < 0) {
            clearInterval(t);
       }
       if (days <= 5) {
           $(document).ready(function() {
            $('.expbox2 h2').css('color','red');
            });
        }
   },1000);
}


$(document).ready(function() {
    $('.dropdown').click(function(){
        $('.dropdownmenu').slideToggle();
    });
});

$(document).ready(function() {
    infowidth = $('.infobox').width();
    infowidth = infowidth/2-3;
    console.log(infowidth);
    $('.info').css('min-width',infowidth);
    console.log($('.infobox').width());
})

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

<?php 
    if (userHasRole('Silver') == 'TRUE') {
        echo 'document.getElementById("refer").innerHTML = "Get two family members or friends to enroll with us and get '
        . 'FREE upgrade to Gold course."';
    }
    if (userHasRole('Gold') == 'TRUE') {
        echo 'document.getElementById("refer").innerHTML = "Get two family members or friends to enroll with us and get '
        . 'FREE upgrade to Diamond course."';
    }
    if (userHasRole('Diamond') == 'TRUE') {
        echo 'document.getElementById("refer").innerHTML = "For every family member or friend who enroll\'s with us; get '
        . 'FREE 1 hour of personal coaching"';
    }
    if (userHasRole('Admin') == 'TRUE') {
        echo 'document.getElementById("refer").innerHTML = "For every family member or friend who enroll s with us and get '
        . 'FREE 1 hour of personal coaching"';
    }
    ?>

</script>

</body>
</html>