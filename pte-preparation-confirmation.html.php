<?php
include_once 'php/includes/connect.php';
session_start();
$name = $email = $pass = $pass1 = $country = '';
$errors = array();
$success = '';

if (isset($_GET['passkey'])) {
    $passkey = $_GET['passkey'];
    
    try {
        $sql = "select * from tmpmembers where passkey = :passkey";
        $s = $conn->prepare($sql);
        $s->bindValue(':passkey', $passkey);
        $s->execute();
        $result = $s->fetch();
    } catch (PDOException $e) {
        $errors[] = 'Error while confirming: ' . $e->getMessage();
        exit();
    }
    $name = $result['name'];
    $email = $result['email'];
    $pass = $result['PASSWORD'];
    $country = $result['country'];
    $expdate = Date("y:m:d", strtotime("+180 days"));   
    
    $count = count($result);
    if ($count > 1) {
        try {
            $sql = 'insert into members (id, name, email, password, country, date, expdate) '
                . 'values (null, :name, :email, :pass, :country, NOW(), :expdate)';
            $s = $conn->prepare($sql);
            $s->bindValue(':name', $name);
            $s->bindValue(':email', $email);
            $s->bindValue(':pass', $pass);
            $s->bindValue(':country', $country);
            $s->bindValue(':expdate', $expdate);
            $result = $s->execute();
        } catch (PDOException $e) {
            $errors[] = '<br>Error adding member: ' . $e->getMessage();
            exit();
        }
        
        $id = $conn->lastInsertId();
        
         try {
            $sql = 'insert into memberrole (memberid, roleid) values(:id, 1)';
            $s = $conn->prepare($sql);
            $s->bindValue(':id', $id);
            $s->execute();
        } catch (PDOException $e) {
            $errors[] = '<br> Error allocating role to member: ' . $e->getMessage();
            exit();
        }
        
        if ($result) {
            $success = "Welcome $name, Your account has been activated";
            try {
                $sql = "delete from tmpmembers where passkey = '".$passkey."'";
                $result = $conn->exec($sql);
            } catch (PDOException $e) {
                $errors[] = '<br> Error executing action 3: ' . $e->getMessage();
            }
            
        }
    } else {
        $errors[] = 'Account Already activated or confirmation link not valid. Please contact +91 9830704729.';
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
        <p class="success"><?php echo $success;?></p>
        <p class="error"><?php foreach ($errors as $error) { echo $error; } ?></p>
    </div>

<!--Start Footer-->
<?php include ('php/includes/footer.html.php'); ?>
<!--End Footer-->

</body>
</html>
