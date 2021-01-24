<?php
include_once 'php/includes/connect.php';
include 'php/includes/tutoraccess.php';

if (!userIsLoggedIn())
{
include 'ptetutorlogin.html.php';
exit();
}
if (userHasRole('Admin') == FALSE)
{
$error = 'Only Admin may access this page.';
include 'tutoraccessdenied.html.php';
exit();
}

try {
    $sql = "select * from feedbackappt where feestatus = :status order by feedate";
        $s = $conn->prepare($sql);
        $s->bindValue(':status', 'unapproved');
        $s->execute();
        $result = $s->fetchAll();        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    return userIsLoggedIn();
}
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Coaching Appointments List</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/scorestyle.css" rel="stylesheet" type="text/css" />
    <script src="Jquery/jquery-1.12.3.js" type="text/javascript"></script>
    <style>
        table, th, td{border: 1px solid black; border-collapse: collapse;}
        th, td{padding: 15px; text-align: center;}
        th{color: white; background-color: #f55959;}
        table tr:nth-child(even) {background-color: #eee;}
        table tr:nth-child(odd) {background-color: #fff;}
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
    <div class="container-fluid">
        <div class="gill">
            <div id="head">
                <div class="btn-group">
                    <a href="allmocktests.html.php" class="btn btn-primary">All Mock Tests</a>
                    <a href="allocatemocktests.html.php" class="btn btn-primary">Allocate Tutors</a>
                    <a href="mocktestattempted.html.php" class="btn btn-primary">Check Mock tests</a>
                    <a href="ptetutorconfirmation.html.php" class="btn btn-primary">Approve Tutors</a>
                    <a href="ptefeedbackapptlist.html.php" class="btn btn-primary">Approve Feedback Appointments</a>
                    <a href="ptefeedbackappt.html.php" class="btn btn-primary">Feedback Appointments</a>
                </div>
                <form action="" method="post" class="btn btn-primary">
                        <input type="hidden" name="goto" value="ptetutorlogin.html.php">
                        <input type="submit" name="action" value="logout" class="btn btn-primary btn-md">
                </form>
            </div>
            <div class="container">
                <table style="width: 100%">
                    <tr>
                        <th>Id</th>
                        <th>Student Id</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo $row['feeid']; ?></td>
                        <td><?php echo $row['feestudid']; ?></td>
                        <td><?php echo $row['feestatus']; ?></td>
                        <td><form action="ptefeedbackapprove.html.php" method="post">
                                <input type="hidden" name="feeid" value="<?php echo $row['feeid']; ?>">
                                <input type="submit" name="action" value="View"></form></td>
                    </tr>
                    <?php }?>
                </table>

                <div id="footer" class="bottom"></div>
            </div>
        </div>
    </div>
  <script>
  
$(document).ready(function() {
   
   var docHeight = $(window).height();
   var footerHeight = $('#footer').height();
   var footerTop = $('.gill').height();
   
   if (footerTop < docHeight) {
        $('#footer').removeClass('bottom1');
        $('#footer').addClass('bottom');
   }
   if ((footerTop) >= docHeight) {
        $('#footer').removeClass('bottom');
        $('#footer').addClass('bottom1');
   }
});

</script>
   
</body>
</html>