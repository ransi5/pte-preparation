<?php
ob_start();

include_once 'php/includes/connect.php';
include_once 'php/includes/access.php';

if (!userIsLoggedIn())
{
include 'pte-preparation-login.html.php';
exit();
}
if (!userHasRole('Member') && !userHasRole('Silver') && !userHasRole('Gold') && !userHasRole('Diamond') && !userHasRole('Admin'))
{
$error = 'Only members may access this page.';
include 'accessdenied.html.php';
exit();
}

$hashSecretWord = 'YzYzZTUyMzYtM2Y5OC00ZjQ4LWI5MDctMjY4NzZiNzdhNTU0'; //2Checkout Secret Word
$hashSid = 203196941; //2Checkout account number
$hashTotal = trim($_GET['total']); //Sale total to validate against
$hashOrder = $_REQUEST['order_number']; //2Checkout Order Number 
$StringToHash = strtoupper(md5($hashSecretWord . $hashSid . $hashOrder . $hashTotal));

if ($StringToHash != $_REQUEST['key']) {
    $result = 'Failed'; 
} else { 
    $result = 'Success';
}

if (isset($_GET['x']) && !empty($result) && $result == 'Success'){
    $course = valid($_GET['x']);    
    if ($course == 2) {
        try {
            $sql = 'update memberrole set roleid = :course where memberid = :id';
            $s = $conn->prepare($sql);
            $s->bindValue(':course', $course);
            $s->bindValue(':id', trim($_SESSION['id']));
            $result1 = $s->execute();
            $sql1 = 'update members set expdate = :date where id = :id';
            $s = $conn->prepare($sql1);
            $s->bindValue(':date', Date("y:m:d", strtotime("+31 days")));
            $s->bindValue(':id', $_SESSION['id']);
            $result2 = $s->execute();
            if ($result1 && $result2) {
                $success = 'Your Account has been setup';
                $action = 'Please log out and log back in to access your student portal';
            }
        } catch (PDOException $e) {
            echo '<br> error updating database: ' . $e->getMessage();
            exit();
        }
    }
    if ($course == 3) {
        try {
            $sql = 'update memberrole set roleid = :course where memberid = :id';
            $s = $conn->prepare($sql);
            $s->bindValue(':course', $course);
            $s->bindValue(':id', trim($_SESSION['id']));
            $result1 = $s->execute();
            $sql1 = 'update members set expdate = :date where id = :id';
            $s = $conn->prepare($sql1);
            $s->bindValue(':date', Date("y:m:d", strtotime("+61 days")));
            $s->bindValue(':id', $_SESSION['id']);
            $result2 = $s->execute();
            if ($result1 && $result2) {
                $success = 'Your Account has been setup';
                $action = 'Please log out and log back in to access your student portal';
            }
        } catch (PDOException $e) {
            echo '<br> error updating database: ' . $e->getMessage();
            exit();
        }
    }
    if ($course == 4) {
        try {
            $sql = 'update memberrole set roleid = :course where memberid = :id';
            $s = $conn->prepare($sql);
            $s->bindValue(':course', $course);
            $s->bindValue(':id', trim($_SESSION['id']));
            $result1 = $s->execute();
            $sql1 = 'update members set expdate = :date where id = :id';
            $s = $conn->prepare($sql1);
            $s->bindValue(':date', Date("y:m:d", strtotime("+86 days")));
            $s->bindValue(':id', $_SESSION['id']);
            $result2 = $s->execute();
            $sqls = 'insert into feedbackappttime (timstudid, timallocated, timconsumed) values (:id, :time, 0)';
            $s = $conn->prepare($sqls);
            $s->bindValue(':id', $_SESSION['id']);
            $s->bindValue(':time', '60');
            $result3 = $s->execute();
            if ($result1 && $result2 && $result3) {
                $success = 'Your Account has been setup';
                $action = 'Please log out and log back in to access your student portal';
            }
        } catch (PDOException $e) {
            echo '<br> error updating database: ' . $e->getMessage();
            exit();
        }
    }
    if ($course == 5) {
        try {
            $sql = 'update memberrole set roleid = :course where memberid = :id';
            $s = $conn->prepare($sql);
            $s->bindValue(':course', $course);
            $s->bindValue(':id', trim($_SESSION['id']));
            $result1 = $s->execute();
            $sql1 = 'update members set expdate = :date where id = :id';
            $s = $conn->prepare($sql1);
            $s->bindValue(':date', Date("y:m:d", strtotime("+86 days")));
            $s->bindValue(':id', $_SESSION['id']);
            $result2 = $s->execute();
            if ($result1 && $result2) {
                $success = 'Your Account has been setup';
                $action = 'Please log out and log back in to access your student portal';
            }
        } catch (PDOException $e) {
            echo '<br> error updating database: ' . $e->getMessage();
            exit();
        }
    }
    if ($course > 10) {
        try {
            $sql = 'select COUNT(*) from feedbackappttime where timstudid = :id';
            $s = $conn->prepare($sql);
            $s->bindValue(':id', $_SESSION['id']);
            $s->execute();
            $row = $s->fetch();
            if ($row[0] > 0) {
                $sql = 'update feedbackappttime set timallocated = timallocated + :course where timstudid = :id';
                $s = $conn->prepare($sql);
                $s->bindValue(':course', $course);
                $s->bindValue(':id', trim($_SESSION['id']));
                $row1 = $s->execute();
                if ($row1) {
                    $success = 'Your Account has been setup';
                    $action = 'Please log out and log back in to access your student portal';
                }
            } else {
                $sqls = 'insert into feedbackappttime (timstudid, timallocated, timconsumed) values (:id, :time, 0)';
                $s = $conn->prepare($sqls);
                $s->bindValue(':id', $_SESSION['id']);
                $s->bindValue(':time', $course);
                $row2 = $s->execute();
                if ($row2) {
                    $success = 'Your Account has been setup';
                    $action = 'Please log out and log back in to access your student portal';
                }
            }
        } catch (Exception $ex) {
            echo '<br> error updating database: ' . $e->getMessage();
            exit();
        }
    }
}

ob_flush();?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Order Confirmation</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link rel="stylesheet" type="text/css" href="css/orderconfirm.css">    
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
<!--Start navbar-->
<?php include_once 'php/includes/navbar.html.php'; ?>
<!--End Navbar-->
<div class="container">
    <div style="margin-top: 100px;">
        <h2><?php if (!empty($result) && $result == 'Success'){echo 'Thank You';} elseif ($result == 'Failed') {echo 'Sorry';}?> <span class="spchar"><?php echo $_SESSION['name'];?></span></h2>
        <h3>for your order</h3>
        <h4 style="color: #00cd00; font-weight: bold;">Your payment <?php if (!empty($result) && $result == 'Success'){echo 'has been successfully processed.';} elseif ($result == 'Failed') {echo 'was unsuccessful.';} ?></h4>
        <h4><?php if (isset($_GET['order_number'])){echo 'Your Order no is '.valid($_GET['order_number']);} ?></h4>
        <h4><?php if (isset($_GET['invoice_id'])){echo 'Your invoice id no is '.valid($_GET['invoice_id']);} ?></h4>
        <h4><?php if (!empty($result) && $result == 'Success'){echo 'You will shortly receive an email with your order details.';} ?></h4>
        <p><?php if (!empty($success)){echo $success;} ?></p>
        <p><?php if (!empty($action)){echo $action;} ?></p>
    </div>
</div>

<!--Start side navigation-->

<?php include_once 'php/includes/footer.html.php'; ?>
    </div>

<script type="text/javascript">

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


</script>
<!-- Google Code for Course Enrolments Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 863163459;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "_oWuCMPTpnAQw6jLmwM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/863163459/?label=_oWuCMPTpnAQw6jLmwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>