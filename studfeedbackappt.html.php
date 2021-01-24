<?php
ob_start();
include_once 'php/includes/connect.php';
include_once 'php/includes/access.php';

if (!userIsLoggedIn())
{
include 'pte-preparation-login.html.php';
exit();
}
if (!userHasRole('Silver') && !userHasRole('Gold') && !userHasRole('Diamond') && !userHasRole('Admin'))
{
$error = 'Only Diamond course members may access this page.';
include 'accessdenied.html.php';
exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'Submit') {
    try {
        $sql = "insert into feedbackappt (feestudid, feestatus, feeapptfocus, feedate1, feetime1, "
                . "feedate2, feetime2, feedate3, feetime3, feedate) values (:studid, :status, :focus, "
                . ":date1, :time1, :date2, :time2, :date3, :time3, NOW())";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->bindValue(':status', 'unapproved');
        $s->bindValue(':focus', $_POST['focus']);
        $s->bindValue(':date1', $_POST['date1']);
        $s->bindValue(':time1', $_POST['time1']);
        $s->bindValue(':date2', $_POST['date2']);
        $s->bindValue(':time2', $_POST['time2']);
        $s->bindValue(':date3', $_POST['date3']);
        $s->bindValue(':time3', $_POST['time3']);
        $s->execute();
        header('location: studfeedbackappt.html.php');
    } catch (PDOException $e) {
        echo '<br>Error updating db: ' . $e->getMessage();
        exit();
    }
}

try {
        $sql1 = "select COUNT(*) from feedbackappttime where timstudid = :id";
        $s = $conn->prepare($sql1);
        $s->bindValue(':id', $_SESSION['id']);        
        $s->execute();
        $result = $s->fetch();
    } catch (PDOException $e) {
        echo '<br>Error updating db: ' . $e->getMessage();
        exit();
    }
    
ob_flush();?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Personal Coaching Appointments</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link rel="stylesheet" type="text/css" href="css/anskeystyle.css">
    <link rel="stylesheet" type="text/css" href="css/studentportal.css">
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
    $(document).ready(function() {
    <?php 
        if (userHasRole('Diamond') && $result[0] <= 0) {
            echo "$('.mid form').hide();";
            echo "$('#spec').show();";
            echo "$('#spec').html('Please, purchase coaching hours to access this form.');";
        }
        if (userHasRole('Silver') || userHasRole('Gold')) {
            echo "$('.mid form').hide();";
            echo "$('#spec').show();";
            echo "$('#spec').html('Please, upgrade to Diamond course to access this form.');";
        }
    ?>
    });
    </script>
        
    
</head>
    
<body>
    
    <div class="container-fluid">
        <div class="gill">
            <?php include_once 'php/includes/navbar.html.php';?>
<!--Start side navigation-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebox">
                    <div>yarsg</div>
                    <ul class="navmenu">
                        <p>Welcome</p>
                        <h4 class="center"><?php echo $_SESSION['name']; ?></h4>
                        <li><a href="studdashboard.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-dashboard"></span> &nbsp;Dashboard</a></li>
                        <li><a href="practiceques.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-question-sign"></span> &nbsp;Practice Questions</a></li>
                        <li><a href="mocktest.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-edit"></span> &nbsp;Mock Tests</a></li>
                        <li><a href="mocktestanskey.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-wrench"></span> &nbsp;Answer Key</a></li>
                        <li class="dropdown">
                            <a href="#"><span class="hovanim"></span><span class="glyphicon glyphicon-stats"></span> &nbsp;G-Analytics &nbsp;<span class="glyphicon glyphicon-menu-down pull-right"></span></a>
                            <ul class="dropdownmenu">
                                <li><a href="mocktestchecked.html.php"><span class="movanim"></span>Results & Micro Analysis</a></li>
                                <li><a href="gmacroanalytics.html.php"><span class="movanim"></span>Macro Analysis</a></li>
                            </ul></li>
                            <li class="active"><a href="studfeedbackappt.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-earphone"></span> &nbsp;Feedback Appointment</a></li>
                            <li><a href="upgradeprogram.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-level-up"></span> &nbsp;Upgrade Program</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8 mid">  
                <h3 id="spec" style="display: none;"></h3>
                <form class="form-inline" action="" method="post">
                    <h3>Student Feedback Appointment</h3>
                    <div class="half">
                        <span style="font-weight: bold;">Please Note:</span>
                        <ul>
                            <li>Please provide 3 preferences of date and time to set an appointment.</li>
                            <li>The time is as per Australian Eastern Standard time(AEST). Please search the web for a time zone converter to convert your country time into AEST.</li>
                            <li>Only time between 02:00 PM (14:00) AEST and 11:30 PM (23:30) AEST will be accepted.</li>
                            <li>In the comment section; Enter the PTE topics or mock test questions that you want to discuss
                            during the appointment. Please be as precise as possible.</li>
                            <li>Your mentor will get back to you through email within 24 hrs of request submission confirming your
                            appointment or alternate dates for you to choose from.</li>
                            <li>Your mentor will provide you with a telephone number that you will have to call either through 
                                telephone or whatsapp on the scheduled appointment day and time.</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="email">Preference 1</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="date" name="date1" class="form-control" required>&nbsp;&nbsp;
                        <input type="time" name="time1" class="form-control" required> 
                    </div><br><br>
                    <div class="form-group">
                        <label class="control-label" for="email">Preference 2</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="date" name="date2" class="form-control" required>&nbsp;&nbsp;
                        <input type="time" name="time2" class="form-control" required> 
                    </div><br><br>
                    <div class="form-group">
                        <label class="control-label" for="email">Preference 3</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="date" name="date3" class="form-control" required>&nbsp;&nbsp;
                        <input type="time" name="time3" class="form-control" required> 
                    </div><br><br>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" cols="100" name="focus" required placeholder="Enter the PTE topics or mock test questions that you want to discuss during the appointment"></textarea>
                    </div><br><br>
                    <div class="form-group">
                        <input type="submit" name="action" class="btn btn-default" value="Submit">
                    </div>
                  </form>                                
            </div>
            <div class="col-md-2 right">

            </div>
        </div>
    </div>
<!--End side navigation-->
            
    <?php include_once 'php/includes/footer.html.php';?>
            
        </div>
    </div>
  <script>
  
$(document).ready(function() {
  $('.dropdown').click(function(){
      $('.dropdownmenu').slideToggle();
  });
});
    
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
</script>
   
</body>
</html>