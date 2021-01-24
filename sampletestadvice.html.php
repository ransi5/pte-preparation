<?php
include_once 'php/includes/connect.php';
include 'php/includes/access.php';

if (!userIsLoggedIn())
{
include 'pte-preparation-login.html.php';
exit();
}
if (!userHasRole('Member') && !userHasRole('Admin'))
{
$error = 'Only members may access this page.';
include 'accessdenied.html.php';
exit();
}
        
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Sample Practice Test Instructions</title>
    <meta name="description" content="Sample test information & advice">
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link rel="stylesheet" type="text/css" href="css/teststyle.css">
    <link rel="stylesheet" type="text/css" href="css/studentportal.css">
    <style>
        .bottom a, .bottom1 a{margin-left: 8px; background-color: #00b200; padding: 8px 49px; 
              color: black; text-decoration: none;}
        #close{margin-left: 60px; background-color: red;}
        #confirm{margin-left: 382px; color: blue;}
        ul{color: black;}
        .highfont{color: red; background-color: yellow; font-weight: bold;}
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
    <script type = "text/javascript" >
    function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="gill">
        <div class="header">
            <p> Pearson Test of English Academic (Sample)</p>
            <div id="cover"></div>                
        </div>
        <div class="topper"></div>
        <div class="container">
            <h2>Must Read before you go further</h2>
            <h3>Please be adviced</h3>
            <ul>
                <li>These sample questions/test is meant to give you an insight on the quality of our content 
                    to help help you make a purchasing decision.</li>
                <li>The sample test does not have all the test feature that our full length practice tests have.</li>
                <li>This sample test comprises 1 question for each question type.</li>
                <li>There are 20 questions in total.</li>
                <li>The sample test will take approximately 1 hour.</li>
                <li>The sample test will not be scored.</li>
                <li>To enable clear listening and recording of audio, we strongly recommend use of a
                    headphone with mic.</li>
            </ul>
            <h3>Technical differences with the actual PTE test.</h3>
            <h4>Major differences</h4>
            <ul>
                <li>In the speaking section, the feature that stops recording after 3 seconds silence
                        is not available. However, if you do take a 3 seconds pause, we will not
                        mark the content after the pause.</li>                
            </ul>
            <h4>Minor differences</h4>
            <ul>
                <li>For the speaking section, you will not be able to move to the next question,
                till the recording time for that question has finished and recording status has changed to "complete".</span></li>
                <li>For the writing section, we have not provided the paste button.
                    You can instead use "ctrl+V" on Windows or "command+V" on Mac keyboard to paste copied/cut content.</li>
                <li>In Re-order paragraph question, instead of 2 boxes to arrange paragraphs by drag and drop, 
                    we have provided just one box. You can arrange paragraphs by dragging and dropping them within 
                    the given box.</li>
            </ul>
    </div>
        <div id="footer" class="bottom"><span id="confirm">Are you prepared to focus for the next 75 minutes without distractions?</span>
            <a href="Javascript:window.close();" id="close">Exit</a><a href="samplesystemcheck.html.php">Next</a></div>
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