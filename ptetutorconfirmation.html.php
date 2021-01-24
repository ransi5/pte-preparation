<?php
ob_start();
include_once 'php/includes/connect.php';
include 'php/includes/tutoraccess.php';

if (!userIsLoggedIn())
{
include 'ptetutorlogin.html.php';
exit();
}
if (!userHasRole('Admin'))
{
$error = 'Only Admin may access this page.';
include 'tutoraccessdenied.html.php';
exit();
}
$name = $email = $pass = $country = '';
$errors = array();
$success = '';

 
try {
    $sql = "select * from tmptutors where tmpstatus = :status";
    $s = $conn->prepare($sql);
    $s->bindValue(':status', 'unapproved');
    $s->execute();
    $result = $s->fetchAll();
} catch (PDOException $e) {
    $errors[] = 'Error while confirming: ' . $e->getMessage();
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'Approve') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    try {
        $sql = 'insert into tutors (tutid, tutname, tutemail, PASSWORD, tutdate) '
            . 'values (null, :name, :email, :pass, CURDATE())';
        $s = $conn->prepare($sql);
        $s->bindValue(':name', $name);
        $s->bindValue(':email', $email);
        $s->bindValue(':pass', $pass);        
        $result = $s->execute();
    } catch (PDOException $e) {
        $errors[] = '<br>Error adding member: ' . $e->getMessage();
        exit();
    }

    $id = $conn->lastInsertId();

     try {
        $sql = 'insert into tutorrole (tutorid, tutorroleid) values(:id, 6)';
        $s = $conn->prepare($sql);
        $s->bindValue(':id', $id);
        $s->execute();
    } catch (PDOException $e) {
        $errors[] = '<br> Error allocating role to tutor: ' . $e->getMessage();
        exit();
    }

    if ($result) {
        $success = $name . ' successfully added as tutor';
        try {
            $sql = "delete from tmptutors where tmpemail = '".$email."'";
            $result = $conn->exec($sql);
        } catch (PDOException $e) {
            $errors[] = '<br> Error executing action 3: ' . $e->getMessage();
        }

    }
    header('location: ptetutorconfirmation.html.php');
    exit();
} 

if (isset($_POST['action']) && $_POST['action'] == 'Delete') {
    $email = $_POST['email'];
    try {
        $sql = "delete from tmptutors where tmpemail = :email";
        $s = $conn->prepare($sql);
        $s->bindValue(':email', $email);
        $s->execute();
        header('location: ptetutorconfirmation.html.php');
        exit();
        } catch (PDOException $e) {
            $errors[] = '<br> Error executing action 3: ' . $e->getMessage();
        }
}

ob_flush();?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Practice Test Attempted</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link href="css/scorestyle.css" rel="stylesheet" type="text/css" />
    <style>
        .sec{margin-top: 50px;}
        .footer{position: absolute; bottom:0; width: 100%;}
        table, th, td{border: 1px solid black; border-collapse: collapse;}
        th{text-align: center;}
        th{color: white; background-color: #f55959;}
        table.quest tr:nth-child(even) {background-color: #eee;}
        table.quest tr:nth-child(odd) {background-color: #fff;}
        table.quest{margin-bottom: 20px;}
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
        <div class="container sec">
            <p class="success"><?php echo $success;?></p>
            <p class="error"><?php foreach ($errors as $error) { echo $error; } ?></p>
            <table class="quest" style="width: 100%">
                        <tr>
                            <th>Tutor Id</th>
                            <th>Tutor Status</th>
                            <th>Tutor Name</th>
                            <th>Tutor Email</th>  
                            <th>Tutor Password</th>
                            <th colspan="2">Action</th>
                        </tr>

                        <?php foreach ($result as $row) { ?>
                        <tr>
                            <td style="text-align: center"><?php echo $row['tmptutid']; ?></td>
                            <td style="text-align: center"><?php echo $row['tmpstatus']; ?></td>
                            <td><?php echo $row['tmpname']; ?></td> 
                            <td><?php echo $row['tmpemail']; ?></td> 
                            <td><?php echo $row['PASSWORD']; ?></td> 
                            <td>
                                <form action="" method="post" name="MyForm">
                                    <input type="hidden" name="id" value="<?php echo $row['tmptutid']; ?>">
                                    <input type="hidden" name="name" value="<?php echo $row['tmpname']; ?>">
                                    <input type="hidden" name="email" value="<?php echo $row['tmpemail']; ?>">
                                    <input type="hidden" name="pass" value="<?php echo $row['PASSWORD']; ?>">
                                    <input type="submit" name="action" value="Approve">                              
                                </form>
                            </td>
                            <td>
                                <form action="" method="post" name="MyForm">
                                    <input type="hidden" name="id" value="<?php echo $row['tmptutid']; ?>">
                                    <input type="hidden" name="name" value="<?php echo $row['tmpname']; ?>">
                                    <input type="hidden" name="email" value="<?php echo $row['tmpemail']; ?>">
                                    <input type="hidden" name="pass" value="<?php echo $row['PASSWORD']; ?>">
                                    <input type="submit" name="action" value="Delete">
                            </td>
                        </tr>
                        <?php }?>
                    </table>
        </div>

    </div>

</body>
</html>