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

if (isset($_POST['action']) && $_POST['action'] == 'View') {
    $id = $_POST['feeid'];
    try {
        $sql = "select * from feedbackappt where feeid = :id";
            $s = $conn->prepare($sql);
            $s->bindValue(':id', $id);
            $s->execute();
            $result = $s->fetch();
            $id = $result['feeid'];
            $feestudid = $result['feestudid'];
            $focus = $result['feeapptfocus'];
            $feedate1 = $result['feedate1'];
            $feetime1 = $result['feetime1'];
            $feedate2 = $result['feedate2'];
            $feetime2 = $result['feetime2'];
            $feedate3 = $result['feedate3'];
            $feetime3 = $result['feetime3'];
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['pref1'])) {
    try {
        $sql = "insert into feedbackapptapproved (appstudid, appfocus, appdate, apptime) values (:studid, :focus, :date, :time)";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_POST['studid']);
        $s->bindValue(':focus', $_POST['focus']);
        $s->bindValue(':date', $_POST['date1']);
        $s->bindValue(':time', $_POST['time1']);
        $s->execute();
        $query = "delete from feedbackappt where feeid = :id";
        $t = $conn->prepare($query);
        $t->bindValue(':id', $_POST['id']);
        $t->execute();
        header('location: ptefeedbackapptlist.html.php');
        exit();
        } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['pref2'])) {
    try {
        $sql = "insert into feedbackapptapproved (appstudid, appfocus, appdate, apptime) values (:studid, :focus, :date, :time)";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_POST['studid']);
        $s->bindValue(':focus', $_POST['focus']);
        $s->bindValue(':date', $_POST['date2']);
        $s->bindValue(':time', $_POST['time2']);
        $s->execute();
        $query = "delete from feedbackappt where feeid = :id";
        $t = $conn->prepare($query);
        $t->bindValue(':id', $_POST['id']);
        $t->execute();
        header('location: ptefeedbackapptlist.html.php');
        exit();
        } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['pref3'])) {
    try {
        $sql = "insert into feedbackapptapproved (appstudid, appfocus, appdate, apptime) values (:studid, :focus, :date, :time)";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_POST['studid']);
        $s->bindValue(':focus', $_POST['focus']);
        $s->bindValue(':date', $_POST['date3']);
        $s->bindValue(':time', $_POST['time3']);
        $s->execute();
        $query = "delete from feedbackappt where feeid = :id";
        $t = $conn->prepare($query);
        $t->bindValue(':id', $_POST['id']);
        $t->execute();
        header('location: ptefeedbackapptlist.html.php');
        exit();
        } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
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
    <title>PTE Preparation - Coaching Appointment Approval</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/scorestyle.css" rel="stylesheet" type="text/css" />
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
                        <th>Student Id</th>
                        <th>preference 1</th>
                        <th>preference 2</th>
                        <th>preference 3</th>
                        <th>Appointment focus</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td><?php echo $feestudid; ?></td>
                        <td>Date: <?php echo $feedate1; ?><br> Time: <?php echo $feetime1; ?></td>
                        <td>Date: <?php echo $feedate2; ?><br> Time: <?php echo $feetime2; ?></td>
                        <td>Date: <?php echo $feedate3; ?><br> Time: <?php echo $feetime3; ?></td>
                        <td><?php echo $focus; ?></td>
                        <td><form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="studid" value="<?php echo $feestudid; ?>">
                                <input type="hidden" name="focus" value="<?php echo $focus; ?>">
                                <input type="hidden" name="date1" value="<?php echo $feedate1; ?>">
                                <input type="hidden" name="time1" value="<?php echo $feetime1; ?>">
                                <input type="hidden" name="date2" value="<?php echo $feedate2; ?>">
                                <input type="hidden" name="time2" value="<?php echo $feetime2; ?>">
                                <input type="hidden" name="date3" value="<?php echo $feedate3; ?>">
                                <input type="hidden" name="time3" value="<?php echo $feetime3; ?>">
                                <input type="submit" name="pref1" value="Preference 1"><br>
                                <input type="submit" name="pref2" value="Preference 2"><br>
                                <input type="submit" name="pref3" value="Preference 3"></form></td>
                    </tr>
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