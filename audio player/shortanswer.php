<?php 
session_start();
include 'connect.php';
$sth = $db->prepare("SELECT * FROM shortanswer");
$sth->execute();
$numofrows=$sth->rowCount();

$audioprestring="serveruploads/questions/answershortquestion/";
$imageprestring="serveruploads/images/answershortquestion/";
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) 
{
   $prepare_time[] = $row['prepare_time'];
   $audiosource[] = $audioprestring."".$row['audiofile_name'].".mp3";
   $recording_time[]= $row['recording_time'];
   $imagesource[]= $imageprestring."".$row['imagefile_name'].".".$row['imagefile_ext'];
   
   $questionidarr[]=$row['id'];
}
?>
<?php
$_SESSION['CurrentUser']="demo";
$_SESSION['questionids'] = $questionidarr;
$_SESSION['globalcounter'] = -1;
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

	<p id ="khan" style="display: none;">My name is khan</p>
	<p id ="sultan" style="display: none;">My name is sultan</p>
    	<div class="container-fluid">
		<div class="row" style=" background-color: rgb(157,18,72);
    color: transparent;">ss
		</div>
		<div class="row"style=" background-color: rgb(157,18,72);
    color: transparent;">ss
		</div>
		<br>
	</div>
	<div class="container">
		<div class="row">
   			<p class="text-justify" ><strong><i>You will hear a question. Please give a simple short answer. Often just one or few words is enough.</i></strong></p>
        </div>
		<br>
		<br>
		<br>
		<br>
		<div class="row">
			<div class="col pull-left">
				<img id="myimage" src="" class="img-rounded img-thumbnail img-responsive" style="max-height:650px;max-width:650px;">
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
		<div id="row" style="display:none">
			<h2>Log</h2>
			<pre id="log"></pre>
		</div>
		<div class="row">
            <button id="next"class="btn btn-primary pull-right" onclick="main()" style="width:90px" disabled>Next</button>
        </div>
		<div id="row">
			
			 <ul id="recordingslist" type="Hidden"></ul>
		</div>
		
	</div>

  <script>
    var prepare_timearr = <?php echo json_encode($prepare_time); ?>;
	var recording_timearr = <?php echo json_encode($recording_time); ?>;
	var audiosourcearr = <?php echo json_encode($audiosource); ?>;
	var imagesourcearr = <?php echo json_encode($imagesource); ?>;
	var numofrows = <?php echo json_encode($numofrows); ?>;
  
  //getters
	var progressbar=document.getElementById("progressbar");
	var countdowntillrecording=document.getElementById("countdowntillrecord");
	var timeelapsed=document.getElementById("timeelapsed");
	function nextpage()
	{
		window.location.href = 'logout.php';
	}
	var i=(-1);
	var questionno=1;
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
		document.getElementById("next").disabled=true;
		document.getElementById("status").innerHTML="Not Recording";
		document.getElementById("status").style.color="black";
		
		timeelapsed.innerHTML="-";	
		
		i++;
	
		var w=prepare_timearr[i];
		var x=recording_timearr[i];
		var y=audiosourcearr[i];
		var z=imagesourcearr[i];
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
  	var audio;
	
	
	function initAudioPlayer()
				{
					audio=new Audio();
					audio.src=xaudiosource;
					
			
					audio.addEventListener('loadedmetadata',setDuration);	
					
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
								prog2=prog2+0.05;;
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
							document.getElementById("khan").innerHTML=audio.duration;
							audio.play(); 
							
							
						}
					
				}
				
	
					initAudioPlayer();
	
	
	
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
		theAnswer();
		}
	
	
		initShortSound();
	}
	
	
	function theAnswer()
	{	var allowedDuration=xallowedduration;
		var prog=0;
		var durationInterval=setInterval(progresser,50);
		
		
		setTimeout(startRecording,1200);
		setTimeout(stopRecording,(allowedDuration*1000)+2000)
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
			var elapsedInterval=setInterval(elapsedtimer,1000);
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
   // button.disabled = true;
  //  button.previousElementSibling.disabled = false;
    __log('Stopped recording.');

    // create WAV download link using audio data blob
	document.getElementById("progressbar").className="progress-bar progress-bar-primary";
    createDownloadLink();

    recorder.clear();
	document.getElementById("next").disabled=false;
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
	  document.getElementById("next").disabled=false;
	  
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

   <script type='text/javascript' > var statustag = document.getElementById("status"); statustag.innerHTML="Not Recording";  </script>
   <script src="js/jquery-1.11.0.min.js"></script>
   <script src="css/bootstrap.min.js"></script>
  <script src="mylibs/shortanswerrecordmp3.js"></script>
</body>
</html>