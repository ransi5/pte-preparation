<?php

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


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Answer Key by PTE Question Type</title>
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
    <div class="bbox">
        <h2>Hi <span class="spchar"><?php echo $_SESSION['name'];?></span></h2>
        <h3>Please confirm your order</h3>
        <div class="confbox">
            <h4>PTE preparation Diamond Course upgrade - <span class="curr spchar"></span> <span class="price spchar"></span></h4>
            <p>You get</p>
            <p>85 days access - timed practice questions in test like conditions - 10 scored practice test 
            - answer key with model answers - in-depth practice test result & analysis - Complete access to G-Analytics - 
            complete access to PTE strategy & tips on our blog - option to add coaching hours - FREE upto 1 hour of 
            personal coaching</p>
            <h4 class="spchar1">Total - <span class="curr">INR</span> <span class="price"></span></h4>                        
        </div>
        <div class="buttons">
            <form action="https://www.2checkout.com/checkout/purchase" method="post">
                <input type="hidden" name="sid" value="203196941" />
                <input type="hidden" name="mode" value="2CO" />
                <input type="hidden" name="li_0_type" value="product" />
                <input type='hidden' name='li_0_name' value='Diamond Course Upgrade' >
                <input type='hidden' name='li_0__description' value='85 days access - timed practice questions in test like conditions - 10 scored practice test 
            - answer key with model answers - in-depth practice test result & analysis - Complete access to G-Analytics - 
            complete access to PTE strategy & tips on our blog - option to add coaching hours - FREE upto 1 hour of 
            personal coaching' >
                <input type="hidden" name="li_0_price" value="" />
                <input type="hidden" name="currency_code" value="" />
                <input type="hidden" name="x_receipt_link_url" value="https://pte-preparation.com/orderconfirmation.html.php?x=4" />
                <a href="javascript:window.history.back()" id="first" class="btn btn-default btn-md">Go Back</a>
                <input name="submit" id="imp" class="btn btn-default btn-md"type="submit" value="Proceed to Checkout" />
            </form>
        </div>
    </div>
</div>

<!--Start side navigation-->

<?php include_once 'php/includes/footer.html.php'; ?>
    </div>

<script>
$(document).ready(function() {
    $.getJSON("https://freegeoip.net/json/", function (data) {
        var country = data.country_name;
        var ip = data.ip;
        
        if (country == "India") {
            $('.curr').html('INR')
            $('.price').text('1,550.00')
            $('input[name="currency_code"]').val('INR')
            $('input[name="li_0_price"]').val('1550.00')
        } else if (country == "Bangladesh") {
            $('.curr').html('USD')
            $('.price').text('25.00')
            $('input[name="currency_code"]').val('USD')
            $('input[name="li_0_price"]').val('25.00')
        } else if (country == "Pakistan") {
            $('.curr').html('USD')
            $('.price').text('25.00')
            $('input[name="currency_code"]').val('USD')
            $('input[name="li_0_price"]').val('25.00')
        } else if (country == "Nepal") {
            $('.curr').html('USD')
            $('.price1').text('25.00')
            $('input[name="currency_code"]').val('USD')
            $('input[name="li_0_price"]').val('25.00')
        } else if (country == "Australia") {
            $('.curr').html('USD')
            $('.price').text('14')
            $('input[name="currency_code"]').val('USD')
            $('input[name="li_0_price"]').val('29.00')
        } else {
            $('.curr').html('USD')
            $('.price').text('14')
            $('input[name="currency_code"]').val('USD')
            $('input[name="li_0_price"]').val('29.00')
        }
    });
});
</script>


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