<?php
ob_start();
include_once 'php/includes/connect.php';
include 'php/includes/access.php';

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Prepartion - Practice Test End</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link href="css/teststyle.css" rel="stylesheet" type="text/css" />
    <style type='text/css'>
      .options{margin: 170px auto;}
      .btns{margin: 10px auto;}
      #exit{padding: 8px 55px;}
      #submit{padding: 8px 48px;}
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
    <script type = "text/javascript" >
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    </script>
    
        <?php
//        if (isset($_POST['action']) && $_POST['action'] == 'Submit') {
//            try {
//                $sql = 'insert into mocktestscores (mocstudid, moctestid, mocuniqid, mocstatus, mocdate) values (:studid, :test, :uniq, :status, NOW())';
//                $s = $conn->prepare($sql);
//                $s->bindValue(':studid', $_SESSION['id']);
//                $s->bindValue(':test', $_SESSION['testid']);
//                $s->bindValue(':uniq', $_SESSION['id'] . $_SESSION['testid']);
//                $s->bindValue(':status', 'unchecked');
//                $s->execute();
//                header('location: mocktestsaved.php');
//                exit();
//            } catch (PDOException $e) {
//                echo '<br> error updating database: ' . $e->getMessage();
//                exit();
//            }   
//        }
        ob_flush();?>
    </script>

</head>
<body>
    <div class="container">
        <div class="options text-center">
            <h4>Thank you for attempting the sample test.</h4>
            <div class="btns text-center">
                <form action="" method="post">
                    <a href="pte-courses-enrolment.html.php" id="submit" class="btn btn-success btn-large">Enrol</a>
                    <a href="javascript:window.close();" id="exit" class="btn btn-danger btn-large">Exit</a>
<!--                    <button type="submit" class="btn btn-danger btn-large" name="action" id="exit" value="Exit">Exit</button>
                    <button type="submit" class="btn btn-success btn-large" name="action" id="submit" value="Submit">Submit</button>-->
                </form>
            </div>
        </div>
    </div>
   
  <script>
      
    document.oncontextmenu = document.body.oncontextmenu = function() {return false;} //disables right click on mouse
    document.body.oncopy = function() { return false; }  //disables copy
    document.body.oncut = function() { return false; }   //disables cut
    
      
  </script>
    
</body>
</html>