<?php 
session_start();
include 'connect.php';
$sth = $db->prepare("SELECT * FROM imagespeak");
$sth->execute();
$numofrows=$sth->rowCount();

$imageprestring="serveruploads/images/imagespeak/";
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
   $prepare_time[] = $row['prepare_time'];
   $recording_time[] = $row['recording_time'];
   $imagesource[]= $imageprestring."".$row['file_name'].".".$row['file_ext'];
   
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
  
  <ul id="recordingslist" type="Hidden"></ul>
			
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
   				<p class="text-justify" ><strong><i>Look at the Map below. In 25 seconds, please speak into the microphone and describe in detail what the map is showing. You will have 40 seconds to give your response </i></strong></p>
        	</div>
			<br>
			<br>
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
				<img id="myimage" src="" class="img-rounded img-thumbnail img-responsive" style="max-height:650px;max-width:650px;">
			</div>
        </div>

		
		<div class="row" style="display:none">
             <h2>Log</h2>
				<pre id="log"></pre>
        </div>
		
     	<div class="row">
            <button id="next" class="btn btn-primary pull-right" onclick="main()" style="width:90px" disabled>Next</button>
        </div>
		
		
	</div>

  <script>

	var prepare_time = <?php echo json_encode($prepare_time); ?>;
	var recording_time = <?php echo json_encode($recording_time); ?>;
	var numofrows = <?php echo json_encode($numofrows); ?>;
	var imagesourcearr = <?php echo json_encode($imagesource); ?>;
	
	
	//getters
	var progressbar=document.getElementById("progressbar");
	var countdowntillrecording=document.getElementById("countdowntillrecord");
	var timeelapsed=document.getElementById("timeelapsed");
	
	function nextpage()
	{
		window.location.href = 'retelllecture.php';
	}
	
	var i=(-1);
	var questionno=1;
  main();
  function main()
  {		
		if (questionno<=numofrows)
		{
			progressbar.style.width="0%";
			progressbar.className="progress-bar progress-bar-success progress-bar-striped active";
			document.getElementById("next").disabled=true;
			document.getElementById("status").innerHTML="Not Recording";
			document.getElementById("status").style.color="black";
			timeelapsed.innerHTML="-";
		
			i++;
		
			var x=prepare_time[i];
			var y=recording_time[i];
			var z=imagesourcearr[i];
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
		
		setTimeout(shortSound,inSeconds);
		setTimeout(startRecording,inSeconds+2000);
		setTimeout(stopRecording,inSeconds+(recordingTime*1000)+2000);
		
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
			
		
		var x=prepareTime-1;
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
		var beepsource="serveruploads/shortsound/shortSound.wav";
		
		function initShortSound()
		{
			beep=new Audio();
			beep.src=beepsource;
			beep.play();
		}
	
	
		initShortSound();
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
	document.getElementById("progressbar").className="progress-bar progress-bar-primary";
   // button.disabled = true;
  //  button.previousElementSibling.disabled = false;
    __log('Stopped recording.');

    // create WAV download link using audio data blob
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

  <script type='text/javascript' > var statustag = document.getElementById("status");  </script>
   <script src="js/jquery-1.11.0.min.js"></script>
   <script src="css/bootstrap.min.js"></script>
  <script src="mylibs/imagespeakrecordmp3.js"></script>
</body>
</html>