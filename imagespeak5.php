<?php
ob_start();
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

try {
    $sql = 'select * from describeimageques where desmid = :testid and desqno = :qno';
    $s = $conn->prepare($sql);
    $s->bindValue(':testid', $_SESSION['testid']);
    $s->bindValue(':qno', '5');
    $s->execute();
    while ($row = $s->fetch()) {
        $file = $row['desfile'];
    }
} catch (PDOException $e) {
    echo '<br>Error fetching image: '. $e->getMessage();
}

if (isset($_POST['time'])) {
    if ($_POST['time'] < 0) {
        try {
            header('location: summarisetext.php?x=' . $_POST['time'] . '&y=' . $_POST['ftime']);       
            exit();
        } catch (PDOException $e) {
            echo '<br> error updating database: ' . $e->getMessage();
            exit();
        }
    } else {
        try {
            header('location: imagespeak6.php?x=' . $_POST['time'] . '&y=' . $_POST['ftime']);       
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
    <title>PTE Practice Test - Describe Image Question 5</title>
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
            <p> Pearson Test of English Academic (Mock Test) - <?php echo $_SESSION['name'];?></p>
            <div id="cover">
                <p class="glyphicon glyphicon-time"> Time Remaining </p><div id="timer"></div>
            </div>                
        </div>
        <div class="topper"></div>
        
        <div class="heading">Look at the image below. In 25 seconds, please speak into the microphone
            and describe in detail what the image is showing. You will have 40 seconds to give your response.</div>

  
    <ul id="recordingslist" type="Hidden"></ul>
			
	<!-- the code below is the css and html tages required only by boxes-->

    <div class="container">
        <br>
        <div class="row">
            <div class="col">
		<div class="container-fluid pull-right" style="width:500px" >
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
                                    <p id="countdowntillrecord" style="font-weight:900;color:black;">-</p>
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
            <div class="col pull-left">
		<img id="myimage" src="" class="img-rounded img-thumbnail img-responsive" style="max-height:350px;max-width:600px;">
            </div>
            <form action="" method="post" name="MyForm">
                <input type="hidden" id="time" name="time" value="">
                <input type="hidden" id="ftime" name="ftime" value="">
            </form>
        </div>

		
	<div class="row" style="display:none">
           <h2>Log</h2>
	<pre id="log"></pre>
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
	var prepare_time = 25;			//enter preparetime here
	var recording_time = 40;			//enter recordingtime here
	var numofrows = 1;				//enter when there are mupltiple questions
	var imagesource = "serveruploads/images/imagespeak/<?php echo trim($file);?>";	//enter image source here
	
	
	//getters
	var progressbar=document.getElementById("progressbar");
	var countdowntillrecording=document.getElementById("countdowntillrecord");
	var timeelapsed=document.getElementById("timeelapsed");
	
	function nextpage()
	{
		window.location.href = 'retelllecture.php';
	}
	
	
	var questionno=1;
  main();
  function main()
  {		
		if (questionno<=numofrows)
		{
			progressbar.style.width="0%";
			progressbar.className="progress-bar progress-bar-success progress-bar-striped active";
		
			document.getElementById("status").innerHTML="Not Recording";
			document.getElementById("status").style.color="black";
			timeelapsed.innerHTML="-";
		
		
		
			var x=prepare_time;
			var y=recording_time;
			var z=imagesource;
			secondtomain(x,y,z);
	 
		
			questionno++;
		}
		
		else
		{
			nextpage();
		}
  }
	
  function secondtomain(a,b,c)
  {
	 	
	
 
	function theAnswer()
	{	
		var prepareTime=a;
		var inSeconds=prepareTime*1000;
		var recordingTime=b;
		document.getElementById("myimage").src=c;
		
		setTimeout(shortSound,inSeconds+1000);
				
		var prog=0;
		var progressbar=document.getElementById("progressbar");
		setTimeout(progressbarfun,inSeconds+2000);
		
		function progressbarfun()
		{
			var durationInterval=setInterval(progresser,50);
			function progresser()
			{
				if(prog<recordingTime)
				{
					prog=prog+0.05;
					var percent=(((prog/(recordingTime))*100)+7)+"%";
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
			var elapsedInterval=setInterval( elapsedtimer,1000);
			function elapsedtimer()
			{
				if(etime<=recordingTime)
				{
					timeelapsed.innerHTML=etime;
					etime++;
				}
				else if (etime>recordingTime)
				{
						clearelapsedInterval();
				}
			}
		
			function clearelapsedInterval()
			{
			
				clearInterval(elapsedInterval);
			}
		
		
		}
			
		
		var x=prepareTime;
		var anInterval=setInterval(countdowntillrecord,1000);	
		function countdowntillrecord()
		{
			
			if(x>=0)
			{
				var fakestring=x;
				document.getElementById("countdowntillrecord").innerHTML=fakestring;
				x--;
			}
			else
			{	
				document.getElementById("countdowntillrecord").innerHTML="-";
				clearanInterval();
			}
		}
		
		function clearanInterval()
		{
			clearInterval(anInterval);
		}
		
	}
 
	theAnswer();
	
	function shortSound()
	{
		var beep;
		var beepsource="serveruploads/shortsound/shortsound.wav";
		
		function initShortSound()
		{
			beep=new Audio();
			beep.src=beepsource;
			beep.play();
		}
	
	
		initShortSound();
	}
  
  }

var blob;    

function successCallback(stream){
    setTimeout(strtrecording,prepare_time*1000+2200);    
        function strtrecording() {
            recordRTC = RecordRTC(stream, {
                type: 'audio',    
            });

            statustag.innerHTML="Recording";
            statustag.style.color="red";	
            recordRTC.startRecording();            
            setTimeout(stprecording,recording_time*1000+1000);
            
            function stprecording() {
                statustag.innerHTML="Saving...";
                statustag.style.color="black";
                recordRTC.stopRecording(function(){
                    var blob = recordRTC.blob;                    
                    upload(blob);
                });
            }
        }
        function upload(blob){    
            var fileType = 'audio'; // or "audio"
            var fileName = '<?php echo $_SESSION['id'] . $_SESSION['testid'] . $_SESSION['name'] ."-". date( 'd-m-Y H-i-s' );?>' + '.webm'  // or "wav"

            var formData = new FormData();
            formData.append(fileType + '-filename', fileName);
            formData.append(fileType + '-blob', blob);

            xhr('myphpuploaders/imagespeak5uploader.php', formData, function (fName) {
                statustag.innerHTML = 'Complete';
            });

        function xhr(url, data, callback) {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    callback(location.href + request.responseText);
                }
            };
            request.open('POST', url);
            request.send(data);
        }
    }
}
function errorCallback(error) {
    console.log('error while recording');
}
    
    var mediaConstraints = { audio: true };
    navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
    
    
    
  </script>
   <script type='text/javascript' > var statustag = document.getElementById("status");  </script>
   <script src="mylibs/RecordRTC.min.js"></script>
</body>
</html>