<?php
include_once 'php/includes/connect.php';
include_once 'php/includes/access.php';

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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Upgrades for Diamond Program</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link rel="stylesheet" type="text/css" href="css/coursesenrolstyle.css">
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
</head>
<body>
    <div class="gill">
<!--Start navbar-->
<?php include_once 'php/includes/navbar.html.php'; ?>
<!--End Navbar-->

<!--Start side navigation-->
<div class="container-fluid sidenav">
    <div class="row sec2" style="margin-bottom: 0px;">
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
                        <li><a href="studfeedbackappt.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-earphone"></span> &nbsp;Feedback Appointment</a></li>
                        <li class="active"><a href="upgradeprogram.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-level-up"></span> &nbsp;Upgrade Program</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 mid">
            <h3>Upgrade Options</h3>
            <div class="row" style="margin-top: 40px;">
                <div class="col-sm-3">
                    <div class="blk1 header" style="height: auto; padding: 25px;">
                        <h3 style="margin-top: 20px">PTE Tutor Feedback<br><span class="white">1 hour</span></h3>
                        <h3 class="red"><span class="curr">USD</span> <span class="price3">20.00</span><sup>*</sup></h3>
                        <div class="content" style="background-color: transparent; padding: 0px; margin-top: 40px">
                            <div class="buttons">
                                <form action="https://www.2checkout.com/checkout/purchase" method="post">
                                    <input type="hidden" name="sid" value="203196941" />
                                    <input type="hidden" name="mode" value="2CO" />
                                    <input type="hidden" name="li_0_type" value="product" />
                                    <input type='hidden' name='li_0_name' value='PTE Personal Coaching - Upto 1 hour' />
                                    <input type='hidden' name='li_0__description' value='PTE Personal Coaching - Upto 1 hour' />
                                    <input type="hidden" name="li_0_price" value="20" />
                                    <input type="hidden" name="currency_code" value="USD" />
                                    <input type="hidden" name="x_receipt_link_url" value="https://pte-preparation.com/orderconfirmation.html.php?x=60" />
                                    <input name="submit" id="last" class="btn btn-default btn-md" type="submit" value="Upgrade" style="font-size: 20px;"/>
                                </form>
                            </div>                        
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="blk2 header" style="height: auto; padding: 25px;">
                        <h3 style="margin-top: 20px">PTE Tutor Feedback<br><span class="white">2 hours</span></h3>
                        <h3 class="red"><span class="curr">USD</span> <span class="price3">38.00</span><sup>*</sup></h3>
                        <div class="content" style="background-color: transparent; padding: 0px; margin-top: 40px">
                            <div class="buttons">
                                <form action="https://www.2checkout.com/checkout/purchase" method="post">
                                    <input type="hidden" name="sid" value="203196941" />
                                    <input type="hidden" name="mode" value="2CO" />
                                    <input type="hidden" name="li_0_type" value="product" />
                                    <input type='hidden' name='li_0_name' value='PTE Personal Coaching - Upto 2 hours' />
                                    <input type='hidden' name='li_0__description' value='PTE Personal Coaching - Upto 2 hours' />
                                    <input type="hidden" name="li_0_price" value="38" />
                                    <input type="hidden" name="currency_code" value="USD" />
                                    <input type="hidden" name="x_receipt_link_url" value="https://pte-preparation.com/orderconfirmation.html.php?x=120" />
                                    <input name="submit" id="last" class="btn btn-default btn-md" type="submit" value="Upgrade" style="font-size: 20px;"/>
                                </form>
                            </div>                        
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="blk3 header" style="height: auto; padding: 25px;">
                        <h3 style="margin-top: 20px">PTE Tutor Feedback<br><span class="white">3 hours</span></h3>
                        <h3 class="red"><span class="curr">USD</span> <span class="price3">51.00</span><sup>*</sup></h3>
                        <div class="content" style="background-color: transparent; padding: 0px; margin-top: 40px">
                            <div class="buttons">
                                <form action="https://www.2checkout.com/checkout/purchase" method="post">
                                    <input type="hidden" name="sid" value="203196941" />
                                    <input type="hidden" name="mode" value="2CO" />
                                    <input type="hidden" name="li_0_type" value="product" />
                                    <input type='hidden' name='li_0_name' value='PTE Personal Coaching - Upto 3 hours' >
                                    <input type='hidden' name='li_0__description' value='PTE Personal Coaching - Upto 3 hours' >
                                    <input type="hidden" name="li_0_price" value="51" />
                                    <input type="hidden" name="currency_code" value="USD" />
                                    <input type="hidden" name="x_receipt_link_url" value="https://pte-preparation.com/orderconfirmation.html.php?x=180" />
                                    <input name="submit" id="last" class="btn btn-default btn-md" type="submit" value="Upgrade" style="font-size: 20px;"/>
                                </form>
                            </div>                        
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="blk4 header" style="height: auto; padding: 25px;">
                        <h3 style="margin-top: 20px">PTE Tutor Feedback<br><span class="white">4 hours</span></h3>
                        <h3 class="red"><span class="curr">USD</span> <span class="price3">60.00</span><sup>*</sup></h3>
                        <div class="content" style="background-color: transparent; padding: 0px; margin-top: 40px">
                            <div class="buttons">
                                <form action="https://www.2checkout.com/checkout/purchase" method="post">
                                    <input type="hidden" name="sid" value="203196941" />
                                    <input type="hidden" name="mode" value="2CO" />
                                    <input type="hidden" name="li_0_type" value="product" />
                                    <input type='hidden' name='li_0_name' value='PTE Personal Coaching - Upto 4 hours' >
                                    <input type='hidden' name='li_0__description' value='PTE Personal Coaching - Upto 4 hours' >
                                    <input type="hidden" name="li_0_price" value="60" />
                                    <input type="hidden" name="currency_code" value="USD" />
                                    <input type="hidden" name="x_receipt_link_url" value="https://pte-preparation.com/orderconfirmation.html.php?x=240" />
                                    <input name="submit" id="last" class="btn btn-default btn-md" type="submit" value="Upgrade" style="font-size: 20px;"/>
                                </form>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
            <h5>* We are setup to accept payments from residents of more than 200 countries. To see 
                if we can accept debit/credit cards from your country <a href="https://www.2checkout.com/global-payments" 
                target="_blank">click here</a>.</h5>
        </div>
        <div class="col-md-2 right">
            
        </div>
    </div>
</div>
<!--End side navigation-->
<?php include_once 'php/includes/footer.html.php'; ?>
    </div>





<script type="text/javascript">

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