<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'php/includes/connect.php'; 
include_once 'php/includes/access.php';
require_once "/home/ptepreparation/php/Mail.php";
 session_start();
 
$name = $email = $subject = $message = '';
$errors = array();
$success = '';
if (isset($_POST['action']) && $_POST['action'] == 'Send') {
    $name = valid($_POST['name']);
    $email = valid($_POST['email']);
    $subject = valid($_POST['subject']);
    $message = valid($_POST['message']);
        
    if (preg_match("/^[a-zA-Z ]*$/", $name) == FALSE) {
        $errors[] = '<br>*Only letters allowed for name';
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = '<br>*Invalid email format';
    }
    
    if (empty($errors)) {
        try {
            $sql = 'insert into contactmessages (conname, conemail, consubject, conmessage) values (:name, :email, :subject, :message)';
            $s = $conn->prepare($sql);
            $s->bindValue(':name', $name);
            $s->bindValue(':email', $email);
            $s->bindValue(':subject', $subject);
            $s->bindValue(':message', $message);
            $result = $s->execute();
        } catch (PDOException $e) {
            $errors[] = '<br>Error signing up: ' . $e->getMessage();
            exit();
        }
                
        if ($result > 0) {
            $to = 'pte-preparation.com <info@pte-preparation.com>';
            $from = $name.'<'.$email.'>';
            $sub = $subject;
//            $header = "MIME-Version: 1.0\r\n";
//            $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $mess = $message;
        try {
            $host = "ssl://smtp.gmail.com";
            $port = "465";
            $username = "info@pte-preparation.com";
            $password = "finance@1";
            

            $headers = array ('From' => $from,
              'To' => $to,
              'Subject' => $sub);
            $smtp = Mail::factory('smtp',
              array ('host' => $host,
                'port' => $port,
                'auth' => true,
                'username' => $username,
                'password' => $password));

            $mail = $smtp->send($to, $headers, $mess);

            if (PEAR::isError($mail)) {
                echo($mail->getMessage());
//                header('location: pte-preparation-contactexp.html.php?error=Could not send message. Please contact +91 98307 04729.&success=');
//                exit();
             } else {
                header('location: pte-preparation-contactexp.html.php?success=Your message has been sent. We will be in touch asap within 24hrs.&error=');
                exit();
             }
//            $sentmail = mail($to,$sub,$mess,$header);
        } catch (PDOException $e) {
            $errors[] = '<br>Error sending message. Please contact +919830704729';
        }    
        }
//        if ($sentmail) {
//            header('location: pte-preparation-contact.html.php?success=Your message has been sent. We will be in touch asap within 24hrs.&error=');
//            exit();
//        } else {
//            header('location: pte-preparation-contact.html.php?error=Could not send message. Please contact 0091 9830704729.&success=');
//            exit();
//        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Contact Us</title>
    <meta name="description" content="Contact Us through phone, chat or email for further information or booking a free 15 minutes 1-1 personal coaching session.">
    <meta name="keywords" content="">
    <meta itemprop="name" content="PTE Preparation: Contact Us">
    <meta itemprop="description" content="Contact Us through phone, chat or email for further information or booking a free 15 minutes 1-1 personal coaching session.">
    <meta itemprop="image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg">
    <meta name="twitter:site" content="@ptepreparations">
    <meta name="twitter:title" content="PTE Preparation - Contact Us">
    <meta name="twitter:description" content="Contact Us through phone, chat or email for further information or booking a free 15 minutes 1-1 personal coaching session.">
    <meta name="twitter:image:src" content="https://pte-preparation.com/images/ptepreparation-twitter.jpg">
    <meta property="og:url" content="https://www.pte-preparation.com/pte-preparation-contact.html.php">
    <meta property="og:image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg" />
    <meta property="og:title" content="PTE Preparation - Contact Us">
    <meta property="og:description" content="Contact Us through phone, chat or email for further information or booking a free 15 minutes 1-1 personal coaching session.">
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/contactstyle.css">
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
                                <li><div class="hovanim"></div><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
                            </div>
                            <div class="col-sm-2">
                                <li><div class="hovanim"></div><a href="pte-courses-online.html.php">Courses</a></li>
                            </div>
                            <div class="col-sm-2">
                                <li><div class="hovanim"></div><a href="pte-courses-enrolment.html.php">Enrol</a></li>
                            </div>
                            <div class="col-sm-2">
                                <li><div class="hovanim"></div><a href="pte-preparation-blog.html.php">Blog</a></li>
                            </div>
                            <div class="col-sm-2 active">
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
<div class="container-fluid sec">
    <div class="container">
        <h1>Contact Us</h1>
        <h5>We will be glad to answer your queries. Please contact us using any of the methods below.</h5>
        <div class="row">
            <div class="col-sm-6">
                <div class="sec1">
                    <form action="" method="post">
                        <h3>Message</h3>
                        <p class="errors"><?php 
                        foreach ($errors as $error) { echo $error; };
                        if (isset($_GET['error'])){echo valid($_GET['error']);}?>
                        </p>
                        <p class="success">
                            <?php 
                            echo $success; 
                            if (isset($_GET['success'])){echo valid($_GET['success']);}?>
                        </p>
                        <div class="form-group">
                            <label for="name">Name:<span class="errors">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your Name" required>
                        </div>
                        <div class="form-group">
                        <label for="email">Email:<span class="errors">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your Email" required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" name="subject" class="form-control" placeholder="Enter message subject">
                        </div>
                        <div class="form-group">
                            <label for="messages">Messages:<span class="errors">*</span></label>
                            <textarea name="message" rows="5" class="form-control" placeholder="Enter your message" required></textarea>
                        </div>
                            <input type="submit" name="action" value="Send" class="btn btn-default btn-lg">                   
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="sec1">
                    <p><span class="bold">Please note: </span>Phone lines are open between 2:00 PM (14:00) and 
                    11:30 PM (23:30) Australian Eastern Standard Time. To know the time translated to your time zone,
                    please search for an appropriate "time zone converter" online.</p>
                    <p><span class="bold">Phone(Worldwide): </span> +1 815 600 7277 </p>
                    <p><span class="bold">Phone(India IST 10am - 6pm): </span> +91 98307 04729</p>
                    <div><span class="bold">Email: </span> info@pte-preparation.com</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include ('php/includes/footer.html.php'); ?>

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