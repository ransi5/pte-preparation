<?php
ob_start();
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
    $sql = "select * from mocktestscores where mocstatus = :status and moctutor = ''";
        $s = $conn->prepare($sql);
        $s->bindValue(':status', 'unchecked');
        $s->execute();
        $result = $s->fetchAll();        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

try {
    $sql = "select * from tutors";
        $s = $conn->prepare($sql);
        $s->bindValue(':status', 'unchecked');
        $s->execute();
        $results = $s->fetchAll();        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'Allocate') {
    try {
        $sql = 'update mocktestscores set moctutor = :tutor where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':tutor', $_POST['tutor']);
        $s->bindValue(':id', $_POST['mocid']);
        $s->execute();
        header('location: allocatemocktests.html.php');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    return userIsLoggedIn();
}
ob_flush();?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Allocate Practice Tests</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/scorestyle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <style>
            table, th, td{border: 1px solid black; border-collapse: collapse;}
            th, td{padding: 15px; text-align: center;}
            th{color: white; background-color: #f55959;}
            table tr:nth-child(even) {background-color: #eee;}
            table tr:nth-child(odd) {background-color: #fff;}
        </style>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
                    <a href="ptecommentlist.html.php" class="btn btn-primary">Comments</a>
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
                        <th>Mock Test Id</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Allocate Tutor</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo $row['mocid']; ?></td>
                        <td><?php echo $row['mocstudid']; ?></td>
                        <td><?php echo $row['moctestid']; ?></td>
                        <td><?php echo $row['mocdate']; ?></td>
                        <td><?php echo $row['mocstatus']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="mocid" value="<?php echo $row['mocid']; ?>">
                                <select name="tutor">
                                    <option>Choose Tutor</option>
                                    <?php foreach ($results as $row) {?>
                                    <option value="<?php echo $row['tutid'] ?>"><?php echo $row['tutname'] ?></option>
                                    <?php } ?>
                                </select>
                                <input type="submit" name="action" value="Allocate">
                            </form>
                        </td>
                        <td>
                            <form action="scorereadaloud.html.php?x=" method="post">
                                <input type="hidden" name="mocid" value="<?php echo $row['mocid']; ?>">
                                <input type="hidden" name="mocstudid" value="<?php echo $row['mocstudid']; ?>">
                                <input type="hidden" name="moctestid" value="<?php echo $row['moctestid']; ?>">
                                <input type="submit" name="check" value="Check">
                            </form>
                        </td>
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