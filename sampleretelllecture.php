<?php
ob_start();
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

try {
    $sql = 'select * from retelllectureques where retmid = :testid and retqno = :qno';
    $s = $conn->prepare($sql);
    $s->bindValue(':testid', '10');
    $s->bindValue(':qno', '2');
    $s->execute();
    while ($row = $s->fetch()) {
        $image = $row['retimage'];
        $file = $row['retfile'];        
    }
} catch (PDOException $e) {
    echo '<br>Error fetching image: '. $e->getMessage();
}

if (isset($_POST['time'])) {
    if ($_POST['time'] < 0) {
        try {
            header('location: samplesummarisetext.php?x=' . $_POST['time'] . '&y=' . $_POST['ftime']);       
            exit();
        } catch (PDOException $e) {
            echo '<br> error updating database: ' . $e->getMessage();
            exit();
        }
    } else {
        try {
            header('location: sampleshortanswer.php?x=' . $_POST['time'] . '&y=' . $_POST['ftime']);       
            exit();
        } catch (PDOException $e) {
            echo '<br> error updating database: ' . $e->getMessage();
            exit();
        }
    }
}
ob_flush();?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Practice Test - Re-tell Lecture Question 1</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/teststyle.css" rel="stylesheet" type="text/css" />
    <style type='text/css'>
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
            <p> Pearson Test of English Academic (Sample)</p>
            <div id="cover">
                <p class="glyphicon glyphicon-time"> Time Remaining </p><div id="timer"></div>
            </div>                
        </div>
        <div class="topper"></div>
        
        <div class="heading">You will hear a lecture. After listening to the lecture, in 10 seconds, please speak
            into the microphone and retell what you have just heard from the lecture in your own words. You will
            have 40 seconds to give your response.</div>

	<p id ="khan" style="display: none;">My name is khan</p>
	<p id ="sultan" style="display: none;">My name is sultan</p>
    	
	
		<!-- the code below is the css and html tages required only by boxes-->
	<div class="container">
            <br>
            <div class="row">
            <div class="col pull-left">
		<img id="myimage" src="" class="img-rounded img-thumbnail img-responsive" style="max-height:600px;max-width:350px;">
            </div>
            <div class="col pull-right">
		<div class="row">
                    <div class="container-fluid" style="width:500px" >
			<div class="panel panel-primary">
                            <div class="panel-heading">
				<h3 class="panel-title" style="text-align:center;"><strong>Audio Playback</strong></h3>
                            </div>
                            <div class="panel-body" style="background-color: rgb(231,239,250);">
				<div class="row">
                                    <div class="col-sm-4">
					<p>Status : </p>
                                    </div>
				<div class="col-sm-8">
                                    <p id="audiostatus">Audiostatus</p>
				</div>
                            </div>
                            <br>
                            <div class="row">
				<div class="col-sm-4">
                                    <p>Volume  : </p>
				</div>
				<div class="col-sm-8">
                                    <input id="volumeslider" type="range" min="0" max="100" value="100" step="1">
				</div>
                            </div>      				
                            <br>
                            <div class="progress">
				<div id="progressbar2" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%;color: transparent; ">
                                    completed
				</div>
                            </div>
        		</div>
                    </div>
		</div>
            </div>
            <br>
            <div class="row">
                <div class="container-fluid" style="width:500px" >
                    <div class="panel panel-primary">
			<div class="panel-heading">
                            <h3 class="panel-title" style="text-align:center;"><strong>Recorded Answer</strong></h3>
			</div>
			<div class="panel-body" style="background-color: rgb(231,239,250);">
                            <div class="row">
				<div class="col-sm-4">
                                    <p>Current Status : </p>
				</div>
				<div class="col-sm-8">
                                    <p id="status" style="font-weight:900;color:black;">Not Recording</p>
				</div>
                            </div>
                            <br>
                            <div class="row">
				<div class="col-sm-4">
                                    <p>Beginning in  : </p>
				</div>
				<div class="col-sm-1">
                                    <p> <strong id="countdown">r</strong></p>
				</div>
                            </div>      				
                            <br>
                            <div class="row">
				<div class="col-sm-4">
                                    <p>Time Elapsed  : </p>
				</div>
				<div class="col-sm-1">
                                    <p id="timeelapsed" style="font-weight:900;color:black;">-</p>
				</div>
                            </div>
                            <br>			
                            <div class="progress">
				<div id="progressbar" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%;color: transparent; ">
                                    completed
				</div>
                            </div>
			</div>
                    </div>
		</div>
            </div>				
	</div>
                
    </div>
        <form action="" method="post" name="MyForm">
            <input type="hidden" id="time" name="time" value="">
            <input type="hidden" id="ftime" name="ftime" value="">
        </form>
    <div id="row" style="display:none">
	<h2>Log</h2>
	<pre id="log"></pre>
    </div>
		
    <div id="row">
			
        <ul id="recordingslist" type="Hidden"></ul>
    </div>
		
    </div>
                <div id="footer" class="bottom"><a href="javascript:document.MyForm.submit();">Next</a></div>
    </div>
    </div>
 

  <script>
	
    var time = <?php echo valid($_GET['x']);?>;
    var ftime = <?php echo valid($_GET['y']);?>;
    
    document.oncontextmenu = document.body.oncontextmenu = function() {return false;} //disables right click on mouse
    document.body.oncopy = function() { return false; }  //disables copy
    document.body.oncut = function() { return false; }   //disables cut
    
    timer(time, "timer");
    remainingtime(time);
    ftimer(ftime, "ftime");
    
function timer(x, elem){
    var t = setInterval(function(){
        if(x > 0) {              
            var minutes = Math.floor(x/60);
            var seconds = Math.floor(x - minutes * 60);
            var y = minutes + ' : ' + seconds;
            
        } else {
            var seconds = Math.floor(x);
            var y = seconds;            
        }
        var elemContent = document.getElementById(elem);
        elemContent.innerHTML = y
        x--;            
    }, 1000);
}

function ftimer(x, elem){
        var t = setInterval(function(){
        var elemContent = document.getElementById(elem);
            elemContent.value = x
            x--;
            if(x < 0) {
                clearInterval(t);
                window.location.href = 'mocktestend.php';
            }
    }, 1000);
}

function remainingtime(time) {
    var t = setInterval(function(){
        document.getElementById('time').value = time;
        time--;
        if(time < 0) {
            $('a').unbind('click', false);
            $('a span').removeClass('glyphicon glyphicon-lock');
            $('a').css('margin','90%');           
        }
    },1000)    
}

$(document).ready(function(){
    y = $("#status").text();
    if (y.trim() != 'Complete') {
        $('a').click('click', false);
        $('a').prepend('<span></span> ');
        $('a span').addClass('glyphicon glyphicon-lock');
        $('a span').css('font-size','14px');
        $('a').css('margin','88%');
    }     
});

$(document).ready(function(){    
    $("#status").bind('DOMSubtreeModified', function(){
        y = $("#status").text();
        if (y.trim() == 'Complete') {
            setTimeout(function () {
                $('a').unbind('click', false);
                $('a span').removeClass('glyphicon glyphicon-lock');
                $('a').css('margin','90%');
            }, 1000)            
        }
    });
});

$(document).ready(function(){
    $("#cover").click(function(){
        $("#timer").toggle();
    });
});

$(window).load(function() {
   
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
<script src="mylibs/gumadapter.js"></script>
<script>
        var prepare_time= 11;			//enter preparetime here
	var recording_time =40;			//enter recordingtime here
	var audiosource = "serveruploads/questions/retelllecture/<?php echo trim($file);?>";	//enter audiosource here
	var imagesource ="serveruploads/images/retelllecture/<?php echo trim($image);?>";	//enter image source here
	var numofrows = 1;		//enter when there are mupltiple questions
	//getters
	var progressbar=document.getElementById("progressbar");
	var countdowntillrecording=document.getElementById("countdowntillrecord");
	var timeelapsed=document.getElementById("timeelapsed");
	function nextpage()
	{
		window.location.href = 'shortanswer.php';
	}
	var questionno=1;
        var audio;
        audio=new Audio();
        audio.src=audiosource;
        audio.addEventListener('durationchange',setDurat);
        function setDurat() {
            document.getElementById("khan").innerHTML=audio.duration;
        }
	main();
	function main()
	{//reset	
		if (questionno<=numofrows)
		{
		var progressbar=document.getElementById("progressbar");
		var progressbar2=document.getElementById("progressbar2");
		progressbar.style.width="0%";
		progressbar.className="progress-bar progress-bar-success progress-bar-striped active";
		progressbar2.style.width="0%";
		progressbar2.className="progress-bar progress-bar-success progress-bar-striped active";
	
		document.getElementById("status").innerHTML="Not Recording";
		document.getElementById("status").style.color="black";
		timeelapsed.innerHTML="-";	
		
	
	
		var w=prepare_time;
		var x=recording_time;
		var y=audiosource;
		var z=imagesource;
		secondtomain(w,x,y,z);
	
		questionno++;
		}
		else
		{
			nextpage();
		}
	
  }
  
  function secondtomain(a,b,c,d)
  {
	
   var xpreparetime=a;
   var xallowedduration=b;
   var xaudiosource=c;
   document.getElementById("myimage").src=d;
   
   
  document.getElementById("countdown").innerHTML="-";
  var audiostatus=document.getElementById("audiostatus");
  audiostatus.innerHTML="<strong>Stopped</strong>";
  audiostatus.style.color="black";

  
  
  var prepareTime=10;
  var audiobeginsin=xpreparetime;
  var counter=audiobeginsin;
  var audiostartinterval=setInterval(audiostarter,1000);
  function audiostarter()
  {
	  if(counter>0)
	  {
		  counter--;
		  audiostatus.innerHTML="<p>Playing in <strong>"+counter+"</strong> seoconds</p>";
	  }
	  else
	  {
		  
		  clearaudiostartinterval();
		  audiostatus.innerHTML="<strong>Playing</strong>";
		  audiostatus.style.color="green";
		  question();
	  }
  }
  
  function clearaudiostartinterval()
  {
	  clearInterval(audiostartinterval);
  }
  
  
 function  question()
 {
//  	var audio;
	
	function initAudioPlayer()
				{
//					audio=new Audio();
//					audio.src=xaudiosource;
//					
//			
//					audio.addEventListener('loadedmetadata',setDuration);
                                        setDuration();					
					volumeslider=document.getElementById("volumeslider");
					volumeslider.addEventListener("mousemove",setvolume);
					
					function setvolume()
					{
						audio.volume=volumeslider.value / 100;
						
					}
					
					var progressbar2=document.getElementById("progressbar2");
					
					setTimeout(caller,1000);
					function caller()
					{  
						var trackDuration=document.getElementById("khan").innerHTML;
						document.getElementById("sultan").innerHTML=trackDuration;
						
						
						var prog2=0;
						
						var durationInterval2=setInterval(progresser2,50);
						function progresser2()
						{
							if(prog2<Math.ceil(trackDuration))
							{
								prog2=prog2+0.05;
								var percent=(((prog2/(trackDuration))*100)+7)+"%";
								progressbar2.style.width=percent;
							}
							else
							{
								clearDurationInterval2();
							}
						}
						function clearDurationInterval2()
						{
							clearInterval(durationInterval2);
						}
						
						var countDownInterval=setInterval(downCounter,1000);
						var downstring=Math.ceil(trackDuration)+prepareTime;
						function downCounter()
						{
							if (downstring>0)
							{
								downstring--;
								var toDisplay=downstring;
								document.getElementById("countdown").innerHTML=toDisplay;
								if(downstring==prepareTime)
								{
									audiostatus.innerHTML="<strong>Stopped</strong>";
									document.getElementById("progressbar2").className="progress-bar progress-bar-primary";
									audiostatus.style.color="black";
								}
							}
							else
							{
								clearDownInterval();								
								shortSound();
							}
						}
						function clearDownInterval()
						{
							clearInterval(countDownInterval);
						}
								
					
					}
					
				
	
							
	
						function setDuration() 
						{
//							document.getElementById("khan").innerHTML=audio.duration;
							audio.play(); 
							
							
						}
					
				}
				
	
					initAudioPlayer();
	
	
	
 }
  
 	
 
 
	function shortSound()
	{
		var beep;
		var beepsource="serveruploads/shortsound/shortsound.wav";
		
		function initShortSound()
		{
		beep=new Audio();
		beep.src=beepsource;
		beep.play();
                var mediaConstraints = { audio: true };
                navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
		theAnswer();
		}
	
	
		initShortSound();
	}
	
	
	function theAnswer()
	{	var allowedDuration=xallowedduration;
		var prog=0;
		var durationInterval=setTimeout(function(){setInterval(progresser,50);},1000);
                var progressbar=document.getElementById("progressbar");
		
		function progresser()
		{
			if(prog<allowedDuration)
			{
				prog=prog+0.05;;
				var percent=(((prog/(allowedDuration))*100)+7)+"%";
				progressbar.style.width=percent;
			}
			else
			{
				clearDurationInterval();
			}
		}
		function clearDurationInterval()
		{
			clearInterval(durationInterval);
		}
			var etime=1;
			var elapsedInterval=setTimeout(function(){setInterval(elapsedtimer,1000);},1000);
			function elapsedtimer()
			{
				if(etime<=allowedDuration)
				{
					timeelapsed.innerHTML=etime;
					etime++;
				}
				else if (etime>allowedDuration)
				{
					clearelapsedInterval();
				}
			}
			
			function clearelapsedInterval()
			{
				clearInterval(elapsedInterval);
			}
	} 
  }
  
var blob;    

function successCallback(stream){
//    var audiodurt;
    
    setTimeout(strtrecording,1000);
    
//    function waiter() {
//        audiodurt = Math.ceil(document.getElementById("khan").innerHTML)*1000;
//        console.log(audiodurt);
//        setTimeout(strtrecording,audiodurt+14000);
//    }
        
        
        function strtrecording() {
            recordRTC = RecordRTC(stream, {
                type: 'audio',    
            });

            statustag.innerHTML="Recording";
            statustag.style.color="red";	
            recordRTC.startRecording();
            console.log('recording');
            setTimeout(stprecording,recording_time*1000+500);
            
            function stprecording() {
                statustag.innerHTML="Saving...";
                statustag.style.color="black";
                recordRTC.stopRecording(function(){
                    var blob = recordRTC.blob;                    
                    setTimeout(function(){statustag.innerHTML = 'Complete';},2000);
                });
            }
        }
//        function upload(blob){    
//            var fileType = 'audio'; // or "audio"
//            var fileName = '' + '.wav'  // or "wav"
//
//            var formData = new FormData();
//            formData.append(fileType + '-filename', fileName);
//            formData.append(fileType + '-blob', blob);
//
//            xhr('myphpuploaders/retelllectureuploader.php', formData, function (fName) {
//                statustag.innerHTML = 'Complete';
//            });
//
//        function xhr(url, data, callback) {
//            var request = new XMLHttpRequest();
//            request.onreadystatechange = function () {
//                if (request.readyState == 4 && request.status == 200) {
//                    callback(location.href + request.responseText);
//                }
//            };
//            request.open('POST', url);
//            request.send(data);
//        }
//    }
}
function errorCallback(error) {
    console.log('error while recording');
}
    
//    var mediaConstraints = { audio: true };
//    navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
    
    
    
  </script>
   <script type='text/javascript' > var statustag = document.getElementById("status"); statustag.innerHTML="Not Recording"; </script>
   <script src="mylibs/RecordRTC.min.js"></script>
</body>
</html>