<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/PTE web/PTE/php/includes/connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/PTE web/PTE/php/includes/access.php';

if (!userIsLoggedIn())
{
include $_SERVER['DOCUMENT_ROOT'] . '/PTE web/PTE/ptelogin.html.php';
exit();
}
if (!userHasRole('Silver') || !userHasRole('Gold') || !userHasRole('Diamond') || !userHasRole('Admin'))
{
$error = 'Only members may access this page.';
include 'accessdenied.html.php';
exit();
}

?>


<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type='text/css'>
        ul { list-style: none; }
        #recordingslist audio { display: block; margin-bottom: 10px; }
    </style>
   <link href="css/style.css" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
  
<!-- the code below is the css and html tages required only by boxes-->

<div class="container">
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

		
		
    <div class="row">
        <ul id="recordingslist" type="Hidden"></ul>
    </div>
		
    <div class="row" style="display:none">
        <h2 >Log</h2>
            <pre id="log"></pre>
    </div>
		
</div>
	
	
  <script>
  
	var prepare_time = 25;    //enter prepare time
	var recording_time = 30;  //enter recording time
	var numofrows = 1;		//change when you there are multiple questions
	
	//getters
	var progressbar=document.getElementById("progressbar");
	var countdowntillrecording=document.getElementById("countdowntillrecord");
	var timeelapsed=document.getElementById("timeelapsed");
	
	var questionno=1;
	function initiator()
		{	
			document.getElementById("status").style.color="black";
			if(questionno<=numofrows)
			{

				printer(prepare_time,recording_time);
				questionno++;
			}
			else if (questionno>numofrows)
			{
				nextpage();
			}
		}
		
		function printer(x,y)
		{
			theAnswer(x,y);
		}
	
	initiator();
  
	
	function nextpage()
	{
		window.location.href = 'readaloud.php';
	}
	function theAnswer(a,b)
	{	
		var prepareTime=a;
		var inSeconds=prepareTime*1000;
		var recordingTime=b;
		//reset	
		progressbar.style.width="0%";
		progressbar.className="progress-bar progress-bar-success progress-bar-striped active";
		
		document.getElementById("status").innerHTML="Not Recording";
		timeelapsed.innerHTML="-";
		
		
		
		setTimeout(shortSound,inSeconds);
		setTimeout(startRecording,inSeconds+2000);
		setTimeout(stopRecording,inSeconds+(recordingTime*1000)+3000);
	
	
		
		setTimeout(progressbarfun,inSeconds+2000);
		
		function progressbarfun()
		{	
			var prog=0;
			var durationInterval=setInterval( progresser,50);
			function progresser()
			{
				if(prog<=recordingTime)
				{
					prog=prog+0.05;
					var percent=(((prog/(recordingTime))*100)+7)+"%";
					progressbar.style.width=percent;
				}
				else if (prog>recordingTime)
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
		
		var x=prepareTime-1;
		var anInterval=setInterval(countdowntillrecord,1000);	
		function countdowntillrecord()
		{
			
			if(x>=0)
			{
				var fakestring=x;
				countdowntillrecording.innerHTML=fakestring;
				x--;
			}
			else
			{	
				
				countdowntillrecording.innerHTML="-";
				clearanInterval();
			}
		}
		
		function clearanInterval()
		{
			clearInterval(anInterval);
		}
		
	}
 
	
	
	function shortSound()
	{
		var beep;
		var beepsource="serveruploads/shortsound/shortSound.wav";
		
		function initShortSound()
		{
			beep=new Audio();
			beep.src=beepsource;
			beep.play();
		}
	
	
		initShortSound();
	}
 
	
	
  
  function __log(e, data) {
    log.innerHTML += "\n" + e + " " + (data || '');
  }

  var audio_context;
  var recorder;

  function startUserMedia(stream) {
    var input = audio_context.createMediaStreamSource(stream);
    __log('Media stream created.' );
	__log("input sample rate " +input.context.sampleRate);

    // Feedback!
    //input.connect(audio_context.destination);
    __log('Input connected to audio context destination.');

    recorder = new Recorder(input, {
                  numChannels: 1
                });
    __log('Recorder initialised.');
  }

  function startRecording() {
	statustag.innerHTML="Recording";
	statustag.style.color="red";
	
    recorder && recorder.record();
   // button.disabled = true;
 //   button.nextElementSibling.disabled = false;
    __log('Recording...');
  }

  function stopRecording() {
	statustag.innerHTML="Complete";
	statustag.style.color="black";
    recorder && recorder.stop();
	progressbar.className="progress-bar progress-bar-primary";
	
   // button.disabled = true;
  //  button.previousElementSibling.disabled = false;
    __log('Stopped recording.');

    // create WAV download link using audio data blob
    createDownloadLink();

    recorder.clear();
	
  }

  function createDownloadLink() 
  {
    recorder && recorder.exportWAV(function(blob) {
      /*var url = URL.createObjectURL(blob);
      var li = document.createElement('li');
      var au = document.createElement('audio');
      var hf = document.createElement('a');

      au.controls = true;
      au.src = url;
      hf.href = url;
      hf.download = new Date().toISOString() + '.wav';
      hf.innerHTML = hf.download;
      li.appendChild(au);
      li.appendChild(hf);
      recordingslist.appendChild(li);*/
	
    });
	
	
	
  }
	 
  window.onload = function init() {
    try {
      // webkit shim
      window.AudioContext = window.AudioContext || window.webkitAudioContext;
      navigator.getUserMedia = ( navigator.getUserMedia ||
                       navigator.webkitGetUserMedia ||
                       navigator.mozGetUserMedia ||
                       navigator.msGetUserMedia);
      window.URL = window.URL || window.webkitURL;

      audio_context = new AudioContext;
      __log('Audio context set up.');
      __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
    } catch (e) {
      alert('No web audio support in this browser!');
    }

    navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
      __log('No live audio input: ' + e);
    });
  };
  

  
  </script>
	<script type='text/javascript' > var statustag = document.getElementById("status");  </script>
   <script src="js/jquery-1.11.0.min.js"></script>
   <script src="css/bootstrap.min.js"></script>
  <script src="mylibs/introrecordmp3.js"></script>
</body>
</html>