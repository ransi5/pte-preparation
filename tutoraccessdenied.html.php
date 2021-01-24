<?php include_once 'php/includes/connect.php'; 
 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PTE Preparation - Practice Test Attempted</title>
        <meta name="author" content="Gillan Learning Solutions LLP" />
        <meta name="copyright" content="Gillan Learning Solutions LLP" />
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/scorestyle.css" rel="stylesheet" type="text/css" />
        <style>
            .sec{margin-top: 100px;}
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
        <div id="head">
                <div class="btn-group">
                    <a href="allmocktests.html.php" class="btn btn-primary">All Mock Tests</a>
                    <a href="allocatemocktests.html.php" class="btn btn-primary">Allocate Tutors</a>
                    <a href="mocktestattempted.html.php" class="btn btn-primary">Check Mock tests</a>
                    <a href="ptetutorconfirmation.html.php" class="btn btn-primary">Approve Tutors</a>                    
                </div>
                <form action="" method="post" class="btn btn-primary">
                        <input type="hidden" name="goto" value="ptetutorlogin.html.php">
                        <input type="submit" name="action" value="logout" class="btn btn-primary btn-md">
                </form>
            </div>
        
        <div class="container sec">
        <h1>Access Denied</h1>
        <p><?php echo $error;?></p>
        </div>
        
  
    </body>
</html>
