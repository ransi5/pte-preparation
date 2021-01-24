<?php
include_once 'php/includes/connect.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Confirmation</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link rel="stylesheet" type="text/css" href="css/loginstyle.css">    
    <style>
        .sec{margin-top: 100px;}
        .footer{position: absolute; bottom:0; width: 100%;}
        
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
<?php include 'php/includes/navbar.html.php';?>
<!--End Navbar-->


<div class="container sec">
    
    <p>This policy covers how we use your personal information. We take your privacy seriously 
        and will take all measures to protect your personal information.</p>
    <p>Any personal information received will only be used to fill your order. We will not sell 
        or redistribute your information to anyone.</p>
</div>


<!--Start Footer-->
<?php include ('php/includes/footer.html.php'); ?>
<!--End Footer-->



</body>
</html>