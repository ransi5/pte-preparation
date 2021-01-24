<?php
session_start();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - address</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link rel="stylesheet" type="text/css" href="css/orderconfirm.css">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
</head>
<body>
    <div class="gill">
<!--Start navbar-->
<?php include_once 'php/includes/navbar.html.php'; ?>
<!--End Navbar-->
<div class="container">
    <div class="bbox">
        <h2>Hi <span class="spchar"><?php echo $_SESSION['name'];?></span></h2>
        <div class="confbox">
            <p>Address: 209 Amrit Dham Complex, Nityanand Nagar, Bakultala, Howrah - 711109.</p>                                    
        </div>        
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

$(document).ready(function() {
    y = $('.footer').position();
    $('.navmenu').css('height', y.top);
});

</script>
</body>
</html>