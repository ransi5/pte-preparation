<?php
include_once 'php/includes/connect.php';

include_once 'php/includes/tutoraccess.php';

$name = $email = $pass = $pass1 = $country = '';
$errors = array();
$success = '';
if (isset($_POST['action']) && $_POST['action'] == 'Sign Up') {
    $status = 'unapproved';
    $name = valid($_POST['name']);
    $email = valid($_POST['email']);
    $pass = valid($_POST['pass']);
    $pass1 = valid($_POST['pass1']);
      
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
    
    if (empty($errors)) {
        try {
            $sql = 'insert into tmptutors (tmpstatus, tmpname, tmpemail, PASSWORD, date) values'.
                '(:status, :name, :email, :pass, CURDATE())';
            $s = $conn->prepare($sql);
            $s->bindValue(':status', $status);
            $s->bindValue(':name', $name);
            $s->bindValue(':email', $email);
            $s->bindValue(':pass', $pass);
            $result = $s->execute();
        } catch (PDOException $e) {
            $errors[] = '<br>Error signing up: ' . $e->getMessage();
            exit();
        }
        
        if ($result > 0) {
            header('location: ptetutorsignup.html.php?success=Your account will be activated within 3 hrs. If not, please contact the admin.&error=');
            exit();
        } else {
            header('location: ptetutorsignup.html.php?error=Please contact Admin at +919830704729.&success=');
            exit();
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    if (userIsLoggedIn())  {
        header('location: mocktestattempted.html.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Tutor Login</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link rel="stylesheet" type="text/css" href="css/loginstyle.css">
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

<div class="container-fluid sec2">
    <div class="container">
        <p class="errors"><?php foreach ($errors as $error) { echo $error; } ?></p>
        <ul class="nav nav-tabs nav-justified">
            <li><a data-toggle="tab" href="#signup">Signup</a></li>
            <li class="active"><a data-toggle="tab" href="#member">Member login</a></li>
        </ul>

        <div class="tab-content">
            <div id="signup" class="tab-pane fade">
                <h3>Sign-up</h3>
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
                            <input type="submit" name="action" value="Sign Up" class="btn btn-default btn-lg">

                        </form>
                        </div>
                        <div class="col-sm-3"></div>
                </div>
            </div>
            <div id="member" class="tab-pane fade in active">
                <h3>Login</h3>
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
                        <div class="col-sm-3"></div>
                        </div>
                <h6 style="text-align: left; color: red;"><a href="#">forgot password?</a></h6>
                </div>
        </div>
    </div>
</div>


<!--Start Footer-->
<?php include ('php/includes/footer.html.php'); ?>
<!--End Footer-->


<script type="text/javascript">
$(document).ready(function() {
   
   var docHeight = $(window).height();
   var footerHeight = $('.footer').height();
   var footerTop = $('.gill').height();
   console.log()
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
</body>
</html>