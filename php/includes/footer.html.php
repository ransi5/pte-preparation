<div class="container-fluid footer bottom1">
     <div class="container">
         <div class="row">
             <div class="col-xs-8">
                <ul class="nav1">
                    <li><a href="https://www.pte-preparation.com/"><span class="glyphicon glyphicon-home"></span></a></li>
                    <li>|</li>
                    <li><a href="pte-courses-online.html.php">Courses</a></li>
                    <li>|</li>
                    <li><a href="pte-courses-enrolment.html.php">Enrol</a></li>
                    <li>|</li>
                    <li><a href="pte-preparation-blog.html.php">Blog</a></li>
                    <li>|</li>
                    <li><a href="pte-preparation-contact.html.php">Contact</a></li>
                    <li>|</li>
                    <li>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != TRUE) { 
                            echo '<li><div class="hovanim"></div><a href="php/ptelogout.php">Logout</a></li>'; 
                        } else { 
                            echo '<li><div class="hovanim"></div><a href="pte-preparation-login.html.php">Login</a></li>'; 
                        }?>
                    </li>
                    <li>|</li>
                    <li><a href="pte-preparation-privacypoilcy.html.php">Privacy Policy</a></li>                    
                </ul>
                 <div class="socialfoot">
                     <a href="https://www.facebook.com/ptepreparation1/" target="_blank"><img class="img-responsive" src="images/pte-preparation-facebook-icon.png" alt="pte practice test: facebook icon"></a>
                     <a href="https://twitter.com/ptepreparations" target="_blank"><img class="img-responsive" src="images/pte-preparation-twitter-icon.png" alt="pte practice test: twitter icon"></a>
                     <a href="https://plus.google.com/b/104069757156862091717/" target="_blank"><img class="img-responsive" src="images/pte-preparation-google+-icon.png" alt="pte practice test: google+ icon"></a>
                 </div>
                 <div class="copyright">&copy; <?php echo date("Y");?> Gillan Learning Solutions LLP - All rights reserved</div>
             </div>
             <div class="col-xs-4">
                <div class="logo">
                    <span class="logtxt">PTE</span>
                    <div class="logbox">preparation</div>
                </div>
            </div>
        </div>
     </div>
</div>