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

//try {
//    $sql = "select * from readaloudanswers where reatestid = :testid and reastudid = :studid";
//    $s = $conn->prepare("$sql");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $result = $s->fetchAll();
//    foreach ($result as $row) {
//        unlink('myphpuploaders/clientuploads/readaloud/'.$row['reafile']);
//    }
//    $sql = "select * from repeatsentenceanswers where reptestid = :testid and repstudid = :studid";
//    $s = $conn->prepare("$sql");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $result1 = $s->fetchAll();
//    foreach ($result1 as $row) {
//        unlink('myphpuploaders/clientuploads/repeatsentence/'.$row['repfile']);
//    }
//    $sql = "select * from describeimageanswers where destestid = :testid and desstudid = :studid";
//    $s = $conn->prepare("$sql");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $result2 = $s->fetchAll();
//    foreach ($result2 as $row) {
//        unlink('myphpuploaders/clientuploads/imagespeak/'.$row['desfile']);
//    }
//    $sql = "select * from retelllectureanswers where rettestid = :testid and retstudid = :studid";
//    $s = $conn->prepare("$sql");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $result3 = $s->fetchAll();
//    foreach ($result3 as $row) {
//        unlink('myphpuploaders/clientuploads/retelllecture/'.$row['retfile']);
//    }
//    $sql = "select * from shortquestionanswers where shotestid = :testid and shostudid = :studid";
//    $s = $conn->prepare("$sql");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $result4 = $s->fetchAll();
//    foreach ($result4 as $row) {
//        unlink('myphpuploaders/clientuploads/shortanswer/'.$row['shofile']);
//    }
//    $s = $conn->prepare("delete from readaloudanswers where reatestid = :testid and reastudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from repeatsentenceanswers where reptestid = :testid and repstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from describeimageanswers where destestid = :testid and desstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from retelllectureanswers where rettestid = :testid and retstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from shortquestionanswers where shotestid = :testid and shostudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from summarisetextanswers where sumtestid = :testid and sumstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from essayanswers where esstestid = :testid and essstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from smcreadinganswers where smctestid = :testid and smcstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from mmcreadinganswers where mmctestid = :testid and mmcstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from reorderparagraphanswers where reotestid = :testid and reostudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from rfillblankanswers where rfitestid = :testid and rfistudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from rwfillblankanswers where rwftestid = :testid and rwfstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from lwsummarizespokentextanswers where lwstestid = :testid and lwsstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from lmcqmultipleansweranswers where lmctestid = :testid and lmcstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from lwfillblankanswers where lwftestid = :testid and lwfstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from lrhighlightsummaryanswers where lrhtestid = :testid and lrhstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from lsmultiplechoiceanswers where lsmtestid = :testid and lsmstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from lselectmissingwordanswers where lsetestid = :testid and lsestudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from lhighlightincorrectwordanswers where lhitestid = :testid and lhistudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from lwwritefromdictationanswers where lwwtestid = :testid and lwwstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//    $s = $conn->prepare("delete from mocktestscores where moctestid = :testid and mocstudid = :studid");
//    $s->bindValue(':testid', $_SESSION['testid']);
//    $s->bindValue(':studid', $_SESSION['id']);
//    $s->execute();
//} catch (PDOException $e) {
//    echo '<br>Error fetching question: ' . $e->getMessage();
//    exit();
//}

?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Practice Test - Introduction</title>
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
        
        <div class="heading">Read the prompt below. In 25 seconds, you must reply in your own words, as naturally 
        and clearly as possible. You have 30 seconds to record your response. Your response will be sent together with your 
        score report to the institutions selected by you.</div>
        
        <div class="content">
            <p>Please introduce yourself. For example, you could talk about one or more of the following.</p>
            <ul>
                <li>Your interests</li>
                <li>Your plans for future study</li>
                <li>Why you want to study abroad</li>
                <li>Why you need to learn English</li>
                <li>Why you chose this </li>
            </ul>
        </div>
  
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
<div id="footer" class="bottom1"><a href="samplereadaloud.php">Next</a></div>
</div>
</div>
	
  <script>
      
      timer(60, "timer");
      
    document.oncontextmenu = document.body.oncontextmenu = function() {return false;} //disables right click on mouse
    document.body.oncopy = function() { return false; }  //disables copy
    document.body.oncut = function() { return false; }   //disables cut
        
function timer(x, elem){
    var t = setInterval(function(){
        var minutes = Math.floor(x/60);
        var seconds = Math.floor(x - minutes * 60);
        var y = minutes + ' : ' + seconds;
        var elemContent = document.getElementById(elem);
            elemContent.innerHTML = y
            x--;
            if(x < 0) {
                clearInterval(t);
            }
    }, 1000);
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
//    createDownloadLink();

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
   
  <script src="mylibs/introrecordmp3.js"></script>

</body>
</html>