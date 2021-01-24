<?php
include_once 'php/includes/connect.php';
session_start();
$name = $email = $pass = $pass1 = $country = '';
$errors = array();
$success = '';

if (isset($_POST['action']) && $_POST['action'] == 'Recover Password') {
    $email = $_POST['email'];
    
    try {
        $sql = "select COUNT(*) from members where email = :email";
        $s = $conn->prepare($sql);
        $s->bindValue(':email', $email);
        $s->execute();
        $result = $s->fetch();
        $count = $result[0];              
    } catch (PDOException $e) {
        $errors[] = 'Error while confirming: ' . $e->getMessage();
        exit();
    }
     
    
    if ($count < 1) {
        $errors[] = 'Cannot find email address in database. Please enter valid email address.';
    } else {
        try {
            $pass = 'jdgi8362';
            $sqls = "update members set PASSWORD = :pass where email = :email";
            $s = $conn->prepare($sqls);
            $s->bindValue(':pass', $pass);
            $s->bindValue(':email', $email);                        
            $result1 = $s->execute();
        } catch (PDOException $e) {
            $errors[] = '<br>Error updating password: ' . $e->getMessage();
            exit();
        }
        
        if ($result1) {            
            $to = $email;
            $subject = "pte-preparation.com - Password recovery";
            $header = "from:pte-preparation.com<no-reply@pte-preparation.com>";            
            $header .= "Reply-To: info@pte-preparation.com\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = "<html><body>";
            $message .= "<h3>Hi $name</h3>";
            $message .= "<p style='font-size:16px;text-align=center'>Please use the password below to access your account.</p><br>";
            $message .= "<div style='dispaly:inline-block;background-color:#f55959;padding:10px 20px;color:white;border-radius:4px;font-size:18px;font-weight:600;text-align:center'>$pass</div>";
            $message .= "<br><p style='font-size:16px;text-align=center'>You can reset password from the dashboard in your account.</p><br>";
            $message .= "<br><br><br><p style='font-size:16px;'>Kindest Regards;</p>";
            $message .= "<p style='font-size:16px;'>from pte-preparation.com family</p>";
            $message .= "<p>info@pte-preparation.com</p>";
            $message .= "<br><br><br><h5>Please Note: Any personal information received will only be used to fill your order. We will not sell or redistribute your information to anyone.</h5>";
            $message .= "</body></html>";
            try {
                $sentmail = mail($to,$subject,$message,$header);
                $success = 'Email has been sent. Please check your inbox and spam box for login credentials.';
            } catch (PDOException $e) {
                $errors[] = '<br>Error sending email. Please contact +919830704729';
            }    
        }
        
    } 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Registration Confirmation</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <style>
        .sec{margin-top: 100px;}
        .footer{position: absolute; bottom:0; width: 100%;}
        .success{color: blue;}
        .error{color: red;}
        .btn-default, .btn-default:hover, .btn-default:focus{background-color:#f55959;padding:10px 20px;color:white;
              border-radius:4px;font-size:18px;font-weight:600;}
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
<?php include 'php/includes/navbar.html.php';?>

    <div class="container sec">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6" style="text-align:center;">
                <div>
                    <h2>Enter username/registered email address</h2>
                    <p>Your temporary password will be sent to this address</p>
                    <p class="success"><?php echo $success;?></p>
                    <p class="error"><?php foreach ($errors as $error) { echo $error; } ?></p>
                    <br>
                    <br>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Enter registered Email" required>
                        </div>
                        <input type="submit" name="action" value="Recover Password" class="btn btn-default btn-lg">
                    </form>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>

<!--Start Footer-->
<?php include ('php/includes/footer.html.php'); ?>
<!--End Footer-->

</body>
</html>
