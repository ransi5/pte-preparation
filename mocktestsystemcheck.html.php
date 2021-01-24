<?php
include_once 'php/includes/connect.php';
include 'php/includes/access.php';

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

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Practice Test System Check</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link href="css/teststyle.css" rel="stylesheet" type="text/css" />
    <style>
        .bottom a, .bottom1 a{margin-left: 8px; background-color: #00b200; padding: 8px 49px; 
               color: black; text-decoration: none;}
        #close{margin-left: 60px; background-color: red;}
        #confirm{margin-left: 396px; color: blue;}
        ul { list-style: none; }
        #recordingslist audio { display: block; margin-bottom: 10px; }
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
            <p> Pearson Test of English Academic (Mock Test) - <?php echo $_SESSION['name'];?></p>
            <div id="cover"></div>                
        </div>
        <div class="topper"></div>
        <div class="container">
            <h3>System Check</h3>
            <div id="dabba" class="container" style="background: linear-gradient(360deg, hsl(60, 35%, 90%), hsl(60, 35%, 90%) 50%, rgb(191, 191, 191) 160%); border-radius: 15px;width:500px;height:212px;box-shadow: 8px 8px 8px #E4E4E4;padding-top: 5px;padding-right: 20px;padding-bottom: 5px;padding-left: 30px;border: 2px solid #E4E4E4;">
                <p class="row" style="text-align:center;font-family:Lucida Sans Unicode, Lucida Grande, sans-serif; font-size: 25px; letter-spacing: 2px;">Audio & Recorder Test</p>
                <br>
                <p class="row" style="font-family:Lucida Sans Unicode, Lucida Grande, sans-serif;color:	black; ">Click 'Record' below and repeat the following</p>
                <p class="row" style="font-family:Lucida Sans Unicode, Lucida Grande, sans-serif; font-style: italic; color: black">I'm ready to focus on the PTE practice test for next 3 hours.</p>
		<div class="row">
                    <div class="col-md-4">
                        <input id="record" class="record" type="button" value=" Record " onmouseover="recordmouseover(this)" onmouseout="recordmouseout(this)"  style="display:block; background-color: hsl(60, 5%, 88%); box-shadow: 5px 5px 5px hsl(1, 5%, 70%);border-radius: 5px;border: none; color: black;padding: 15px 32px;font-size: 16px; margin: 4px 2px;cursor: pointer;"/>
                        <input id="stop" type="button" value="   Stop   " style="display:none; background-color: hsl(60, 5%, 88%); box-shadow: 5px 5px 5px hsl(1, 5%, 70%);border-radius: 5px;border: none; color: black;padding: 15px 32px;font-size: 16px; margin: 4px 2px;cursor: pointer;"/>
                    </div>
                    <div class="col-md-4">
                        <input id="play" type="button" value="Play" onmouseover="playmouseover(this)" onmouseout="playmouseout(this)" style="display: inline-block;background-color: hsl(60, 5%, 88%); box-shadow: 5px 5px 5px hsl(1, 5%, 70%);border-radius: 5px;border: none; color: black;padding: 15px 32px;font-size: 16px; margin: 4px 2px;cursor: pointer;"/>
                        <input id="stopplay" type="button" value="Stop"  style="display: none;background-color: hsl(60, 5%, 88%); box-shadow: 5px 5px 5px hsl(1, 5%, 70%);border-radius: 5px;border: none; color: black;padding: 15px 32px;font-size: 16px; margin: 4px 2px;cursor: pointer;"/>
                    </div>
		</div>
            </div>
            <div class="row">
                <h3>System Requirements</h3>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="scripttest">
                        <h3>Javascript <span class="glyphicon glyphicon-remove-sign pull-right"></span></h3>
                        <noscript>
                        Disabled.<br>Attention: Without Javascript the Mock Test will not perform as intended.
                        Please, refer to your browsers "Help" section to turn on Javascript.
                        <style>#enabled{ display:none; }</style>
                        </noscript>
                        <div id="enabled">Enabled</div>                
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="browsertest">
                        <h3>Browser <span class="pull-right"></span></h3>
                        <div class="browsername">
                            <?php 
                            if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
                                echo 'Internet explorer';
                              elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) 
                                 echo 'Internet explorer';
                              elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
                                echo 'Mozilla Firefox';
                              elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
                                echo 'Google Chrome';
                              elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
                                echo "Opera Mini";
                              elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
                                echo "Opera";
                              elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
                                echo "Safari";
                              else
                                echo 'Not Google Chrome';
                            ?>
                        </div>
                        <div class="browseradvice"></div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <div id="footer" class="bottom"><span id="confirm">Is the systems check OK and system requirement as advised?</span>
            <a href="Javascript:window.close();" id="close">Exit</a><a href="intro.php">Start</a></div>
    </div>
</div>
  <script>
$(document).ready(function() {
   y = $('.browsername').text();
   if (y.trim() != 'Google Chrome') {
       $('.browseradvice').text('Attention: Please switch to Google Chrome. Without Google Chrome this Mock Test may not perform as intended');
       $('.browsertest h3 span').addClass('glyphicon glyphicon-remove-sign');
       $('.browsertest').css({'background-color':'rgba(255,153,153, 0.6)', 'color':'#b20000', 'border':'1px solid #b20000'});
   } else {
       $('.browsertest h3 span').addClass('glyphicon glyphicon-ok-sign');
       $('.browsertest').css({'background-color':'rgba(178,216,178, 0.6)', 'color':'#005900', 'border':'1px solid #005900'});
   }
});

$(document).ready(function() {
   y = $('#enabled').css('display');
   console.log(y.trim());
   if (y.trim() == 'block') {
       $('.scripttest h3 span').removeClass('glyphicon glyphicon-remove-sign');
       $('.scripttest h3 span').addClass('glyphicon glyphicon-ok-sign');
       $('.scripttest').css({'background-color':'rgba(178,216,178, 0.6)', 'color':'#005900', 'border':'1px solid #005900'});
   } else {
       $('.scripttest h3 span').addClass('glyphicon glyphicon-remove-sign');
   }
});

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
<script>
	function recordmouseover(a) 
	{
		
		a.style.color= "red";
		a.style.fontWeight= "bold";
		
	}
	
	function recordmouseout(b) 
	{
		b.style.color= "black";
		b.style.fontWeight= "normal";
	}
	
	function playmouseover(c) 
	{
		c.style.color= "green";
		c.style.fontWeight= "bold";
		
	}
	
	function playmouseout(d) 
	{
		d.style.color= "black";
		d.style.fontWeight= "normal";
	}
	
	</script>

  
  

  

  <script>
  function __log(e, data) {
    log.innerHTML += "\n" + e + " " + (data || '');
  }

  var audio_context;
  var recorder;
  var sounder;
  var stopingCondition=0;
  var stopclear;
  
  var dabba=document.getElementById("dabba");
  var record=document.getElementById("record");
  var stop=document.getElementById("stop");
  var play=document.getElementById("play");
  var stopplay=document.getElementById("stopplay");
  
  record.onclick = recordFunction;
  stop.onclick = stopFunction;
  play.onclick = playFunction;
  stopplay.onclick = stopplayFunction;
  
  function recordFunction()
	{
		dabba.style.background="linear-gradient(360deg, hsl(60, 35%, 90%), hsl(60, 35%, 90%) 50%, rgb(255, 0, 0) 160%)";
		record.style.display = "none";
		stop.style.display = "block";
		play.style.color="white";
		play.disabled=true;
		stopingCondition=1;
		startRecording();
		stopclear=setTimeout(stopFunction,20000);
	}
	
	function stopFunction()
	{
		dabba.style.background="linear-gradient(360deg, hsl(60, 35%, 90%), hsl(60, 35%, 90%) 50%, rgb(191, 191, 191) 160%)";
		stop.style.display = "none";
		record.style.display = "block";
		stopRecording();
		play.style.color="black";
		play.disabled=false;
		stopingCondition=0;
		clearTimeout(stopclear);
	}
  
  function playFunction()
	{
		sounder.play();
		play.style.display = "none";
		stopplay.style.display = "inline-block";
		record.disabled=true;
		record.style.color="white";
		
		sounder.onended = function() {
		stopplay.style.display = "none";
		play.style.display = "inline-block";
		record.disabled=false;
		record.style.color="black";
		};
	}
	
	function stopplayFunction()
	{
		sounder.pause();
		sounder.currentTime = 0;
		stopplay.style.display = "none";
		play.style.display = "inline-block";
	}

  function startUserMedia(stream) {
    var input = audio_context.createMediaStreamSource(stream);
	recorder = new Recorder(input);
  }

  function startRecording() {
    recorder && recorder.record();
  }

  function stopRecording() {
    recorder && recorder.stop();
    createDownloadLink();
	recorder.clear();
  }

  function createDownloadLink() {
    recorder && recorder.exportWAV(function(blob) {
      var url = URL.createObjectURL(blob);
      var au = document.createElement('audio');
      var hf = document.createElement('a');
      
      au.controls = true;
      au.src = url;
      hf.href = url;
      hf.download = new Date().toISOString() + '.wav';
      hf.innerHTML = hf.download;
	  sounder=au;
    });
  }

  window.onload = function init() {
    try {
      // webkit shim
      window.AudioContext = window.AudioContext || window.webkitAudioContext;
      navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;
      window.URL = window.URL || window.webkitURL;
      
      audio_context = new AudioContext;
    } catch (e) {
      alert('No web audio support in this browser!');
    }
    
    navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
    });
  };
  </script>

  <script src="mylibs/recorder.js"></script>   
</body>
</html>