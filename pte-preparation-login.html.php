<?php
ob_start();
include_once 'php/includes/connect.php';
include_once 'php/includes/access.php';


$name = $email = $pass = $pass1 = $country = '';
$errors = array();
$success = '';
global $message;
if (isset($_POST['action']) && $_POST['action'] == 'Sign Up') {
    $name = valid($_POST['name']);
    $email = valid($_POST['email']);
    $pass = valid($_POST['pass']);
    $pass1 = valid($_POST['pass1']);
    $country = valid($_POST['country']);
    $passkey = md5(uniqid(rand()));
    
    if (preg_match("/^[a-zA-Z ]*$/", $name) == FALSE) {
        $errors[] = '<br>*Only letters allowed for name';
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = '<br>*Invalid email format';
    }
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            $result = $conn->query("select * from members where email = '".$email."'");
            $count = $result->fetchColumn();
            if ($count >= 1){
            $errors[] = '<br>*Email/Username already exists';
            }
        } catch (PDOException $e){
            $errors[] = '*Error checking email'.$e->getMessage();
        }  
    }
    
    if (strlen($pass) < 6 || strlen($pass1) < 6) {
        $errors[] = '<br>*Password should be atleast 6 characters long';
    }
    
    if ($pass != $pass1) {
        $errors[] = '<br>*Password do not match';
    }
    
    if (preg_match("/^[a-zA-Z ]*$/", $country) == FALSE) {
        $errors[] = '<br>*Only letters allowed for country';
    }
    
    if (empty($errors)) {
        try {
            $sql = 'insert into tmpmembers (passkey, name, email, PASSWORD, country, date) values'.
                '(:passkey, :name, :email, :pass, :country, NOW())';
            $s = $conn->prepare($sql);
            $s->bindValue(':passkey', $passkey);
            $s->bindValue(':name', $name);
            $s->bindValue(':email', $email);
            $s->bindValue(':pass', $pass);
            $s->bindValue(':country', $country);
            $result = $s->execute();
        } catch (PDOException $e) {
            $errors[] = '<br>Error signing up: ' . $e->getMessage();
            exit();
        }
        
        $id = $conn->lastInsertId();
        
        if ($result) {
            $to = $email;
            $subject = "pte-preparation.com - Your email verification link";
            $header = "from:pte-preparation.com<no-reply@pte-preparation.com>";            
            $header .= "Reply-To: info@pte-preparation.com\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = "<html><body>";
            $message .= "<h3>Hi $name</h3>";
            $message .= "<p style='font-size:16px;'>Thank you, for choosing to register with pte-preparation.com</p>";
            $message .= "<p style='font-size:16px;'>Please, click on the following link to complete the registration process</p>";
            $message .= "<br><a style='background-color:#f55959;padding:10px 20px;color:white;text-decoration:none;border-radius:4px;font-size:18px;font-weight:bold;' href='https://www.pte-preparation.com/pte-preparation-confirmation.html.php?passkey=$passkey'>Confirm Email</a>";
            $message .= "<br><br><br><p style='font-size:16px;'>Kindest Regards;</p>";
            $message .= "<p style='font-size:16px;'>from pte-preparation.com family</p>";
            $message .= "<p>info@pte-preparation.com</p>";
            $message .= "<br><br><br><h5>Please Note: Any personal information received will only be used to fill your order. We will not sell or redistribute your information to anyone.</h5>";
            $message .= "</body></html>";
        try {
            $sentmail = mail($to,$subject,$message,$header);
        } catch (PDOException $e) {
            $errors[] = '<br>Error sending confirmation link. Please contact +919830704729';
        }    
        }
        if ($sentmail) {
            header('location: ptesignup.html.php?success=Your confirmation link has been sent to your email address.&error=');
            exit();
        } else {
            header('location: ptesignup.html.php?error=Could not send link to your email address. Please contact +919830704729.&success=');
            exit();
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    if (userIsLoggedIn())  {
        header('location: studdashboard.html.php');
    } else {
        $errors[] = '<br>Your login credentials do not match.';
    }
}
    


ob_flush();?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Signup and Login</title>
    <meta name="description" content="Provides complete PTE preparation with high quality academic content, practice questions & tests with model answers & coaching for one attempt PTE success.">
    <meta name="keywords" content="">
    <meta itemprop="name" content="PTE Preparation - Signup and Login">
    <meta itemprop="description" content="Provides complete PTE preparation with high quality academic content, practice questions & tests with model answers & coaching for one attempt PTE success.">
    <meta itemprop="image" content=""https://pte-preparation.com/images/ptepreparation-social-media.jpg">
    <meta name="twitter:site" content="@ptepreparations">
    <meta name="twitter:title" content="PTE Preparation - Signup and Login">
    <meta name="twitter:description" content="Provides complete PTE preparation with high quality academic content, practice questions & tests with model answers & coaching for one attempt PTE success.">
    <meta name="twitter:image:src" content="https://pte-preparation.com/images/ptepreparation-twitter.jpg">
    <meta property="og:url" content="https://www.pte-preparation.com/pte-preparation-login.html.php">
    <meta property="og:image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg" />
    <meta property="og:title" content="PTE Preparation - Signup and Login">
    <meta property="og:description" content="Provides complete PTE preparation with high quality academic content, practice questions & tests with model answers & coaching for one attempt PTE success.">
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/loginstyle.css">
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
                            <div class="col-sm-2">
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
                            <div class="col-sm-2 active">
                                
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


<div class="container-fluid sec2">
    <div class="container">
        <p class="errors"><?php foreach ($errors as $error) { echo $error; } echo $message;?></p>
        <ul class="nav nav-tabs nav-justified">
            <li><a data-toggle="tab" href="#signup">Signup</a></li>
            <li class="active"><a data-toggle="tab" href="#member">Member login</a></li>
        </ul>

        <div class="tab-content">
            <div id="signup" class="tab-pane fade">
                <h1>Sign-up</h1>
                <h3>First step towards success in PTE</h3>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <form action="" method="post" role="form">

                            <div class="form-group">
                                <label for="name">Name:<span class="errors">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:<span class="errors">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your Email" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:<span class="errors">*</span></label>
                                <input type="password" name="pass" class="form-control" placeholder="Enter a password" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Repeat Password:<span class="errors">*</span></label>
                                <input type="password" name="pass1" class="form-control" placeholder="Repeat password" required>
                            </div>
                            <div class="form-group">
                                <label for="country">Country:<span class="errors">*</span></label>
                                <input type="text" name="country" class="form-control" placeholder="Enter your country" required>
                            </div>
                                <input type="submit" name="action" value="Sign Up" class="btn btn-default btn-lg">

                        </form>
                    </div>
                        <div class="col-sm-3"></div>
                </div>
                    
            </div>
            <div id="member" class="tab-pane fade in active">
                <h1>Login</h1>
                <h3>Login to begin learning.</h3>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6"> 
                        <form action="" method="post" role="form">
                            <div class="form-group">
                            <label for="email">Email:<span class="errors">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your Email" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:<span class="errors">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Enter a password" required>
                            </div>
                            <input type="submit" name="action" value="login" class="btn btn-default btn-lg">
                        </form>                    
                        <br>
                        <h6 style="text-align: left; color: red;"><a href="pte-password-recovery.html.php">forgot password?</a></h6>
                        <div class="col-sm-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Start Footer-->
<?php include ('php/includes/footer.html.php'); ?>
<!--End Footer-->
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