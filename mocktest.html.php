<?php
include_once 'php/includes/connect.php';
include 'php/includes/access.php';

if (!userIsLoggedIn())
{
include 'pte-preparation-login.html.php';
exit();
}
if (!userHasRole('Silver') && !userHasRole('Gold') && !userHasRole('Diamond') && !userHasRole('Admin'))
{
$error = 'Only members may access this page.';
include 'accessdenied.html.php';
exit();
}

try {
    $sql = "select * from mocktestscores";
        $s = $conn->prepare($sql);
        $s->execute();
        $result = $s->fetchAll();
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Mock Test List</title>
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
    <?php 
        if (isset($_POST['action']) && $_POST['action'] == 'Attempt') {
            $_SESSION['testid'] = valid($_POST['moctestid']);
            echo "window.open('mocktestadvice.html.php','_blank','menubar=no,toolbar=no,status=no,top=0,width=1366,height=650')";
        }
    ?>
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
                        <li class="active"><a href="mocktest.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-edit"></span> &nbsp;Mock Tests</a></li>
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
                <h3>Mock tests</h3>
                <div class="half">
                    <p>Please change your browser settings to allow popups on this website.</p>                    
                </div>
                <table style="width: 100%">
                    <tr>
                        <th>Mock Test Id</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>Mock Test 1</td>
                        <td id="status1">Active</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="moctestid" value="1">
                                <input class="red btn btn-default" type="submit" name="action" value="Attempt" id="stat1">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Mock Test 2</td>
                        <td id="status2">Active</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="moctestid" value="2">
                                <input class="red btn btn-default" type="submit" name="action" value="Attempt" id="stat2">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Mock Test 3</td>
                        <td id="status3">Active</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="moctestid" value="3">
                                <input class="red btn btn-default" type="submit" name="action" value="Attempt" id="stat3">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Mock Test 4</td>
                        <td id="status4">Active</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="moctestid" value="4">
                                <input class="red btn btn-default" type="submit" name="action" value="Attempt"  id="stat4">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Mock Test 5</td>
                        <td id="status5">Active</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="moctestid" value="5">
                                <input class="red btn btn-default" type="submit" name="action" value="Attempt"  id="stat5">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Mock Test 6</td>
                        <td id="status6">Active</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="moctestid" value="6">
                                <input class="red btn btn-default" type="submit" name="action" value="Attempt"  id="stat6">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Mock Test 7</td>
                        <td id="status7">Active</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="moctestid" value="7">
                                <input class="red btn btn-default" type="submit" name="action" value="Attempt"  id="stat7">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Mock Test 8</td>
                        <td id="status8">Active</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="moctestid" value="8">
                                <input class="red btn btn-default" type="submit" name="action" value="Attempt"  id="stat8">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Mock Test 9</td>
                        <td id="status9">Active</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="moctestid" value="9">
                                <input class="red btn btn-default" type="submit" name="action" value="Attempt" id="stat9">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Mock Test 10</td>
                        <td id="status10">Active</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="moctestid" value="10">
                                <input class="red btn btn-default" type="submit" name="action" value="Attempt"  id="stat10">
                            </form>
                        </td>
                    </tr>
                </table>
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
  <?php    
  for ($i = 1; $i <= 10; $i++){
    echo "var x$i = document.getElementById('stat$i');";
  }
  ?>
  <?php
  
    if (userHasRole('Silver')) {
      for ($i=3; $i <= 10; $i++) {
          echo "x$i.disabled += true;";
          echo "x$i.className += ' disabled';";
          echo "$('#status$i').text('Upgrade program to activate');";    
      }
    } 

    if (userHasRole('Gold')) {
      for ($i=7; $i <= 10; $i++) {
          echo "x$i.disabled += true;";
          echo "x$i.className += ' disabled';";
          echo "$('#status$i').text('Upgrade program to activate');";    
      }
    }
    ?>
  <?php
    for ($i = 1; $i <= 10; $i++){
        $sql = "select count(*) from mocktestscores where mocstudid = :studid and moctestid = :testid";
        $s = $conn->prepare("$sql");
        $s->bindValue(':studid', $_SESSION['id']);
        $s->bindValue(':testid', $i);
        $s->execute();
        $row = $s->fetch();
        if ($row[0] >= 1) {
            echo "x$i.disabled += true;";
            echo "x$i.className += ' disabled';";
            echo "$('#status$i').text('Attempted');";
        }
    }
  ?>

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