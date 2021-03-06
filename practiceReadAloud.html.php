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
unset($_SESSION['rstatus']);
if(!isset($_SESSION['testid']) || $_SESSION['testid'] != 111){
    $_SESSION['testid'] = 111;    
}
$_SESSION['quesno'] = $_GET['page'];

if ($_GET['page'] == 1) {
    try {
        $sql = "select * from readaloudanswers where reatestid = :testid and reastudid = :studid";
        $s = $conn->prepare("$sql");
        $s->bindValue(':testid', $_SESSION['testid']);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->execute();
        $result = $s->fetchAll();
        foreach ($result as $row) {
            unlink('myphpuploaders/clientuploads/readaloud/'.$row['reafile']);
        }
        $s = $conn->prepare("delete from readaloudanswers where reatestid = :testid and reastudid = :studid");
        $s->bindValue(':testid', $_SESSION['testid']);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->execute();
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
}

try {
    //pagination
    $perpage = 1;
    $page = isset($_GET['page']) && $_GET['page'] >= 1 ? (int)$_GET['page'] : 1;
    $limit = ($page * $perpage) - $perpage;
    $sql = "select * from readaloudques where reamid = :mid limit $limit, $perpage";
    $s = $conn->prepare($sql);
    $s->bindValue(':mid', $_SESSION['testid']);
    $s->execute();
    $result = $s->fetchAll();
    $query = $conn->query("select count(*) from readaloudques where reamid = '".$_SESSION['testid']."'");
    $total = $query->fetch();
    $pages = ceil($total[0]/$perpage);    
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}
        
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Practice Read Aloud</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
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
    <?php foreach ($result as $row) {?>
    <div class="container-fluid">
    <div class="gill">
        <div class="header">
            <p> PTE Read Aloud Practice Questions - <?php echo $_SESSION['name'];?></p>
            <div id="cover">
                <p class="glyphicon glyphicon-time"> Time Remaining </p><div id="timer"></div>
            </div>                
        </div>
        <div class="topper">Question <?php echo $_GET['page']; ?> of <?php echo $total[0]; ?></div>
        
        <div class="heading">Look at the text below. In 40 seconds, you must read this text aloud as clearly and naturally
        as possible. You have 40 seconds to read aloud.</div>
        
        
    <div class="container">
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
        <br>
    <div class="row">
        <p id="passage" class="text-justify"><?php echo $row['reaquestion']; ?></p>
        <form action="" method="post" name="MyForm">
            <input type="hidden" id="time" name="time" value="">
         </form>
    </div>

    <div class="row" style="display:none">
        <h2>Log</h2>
        <pre id="log"></pre>
    </div>

    </div>
        <div id="footer" class="bottom"><a href="practiceReadAloud.html.php?page=<?php echo $_GET['page']+1; ?>">Next</a></div>
    </div>
</div>
 
  <script>
  
var time = 76;
    
    document.oncontextmenu = document.body.oncontextmenu = function() {return false;} //disables right click on mouse
    document.body.oncopy = function() { return false; }  //disables copy
    document.body.oncut = function() { return false; }   //disables cut
    
    timer(time, "timer");
    remainingtime(time);
       
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
    y = $('#status').text();
    if (y.trim() != 'Complete') {
        $('a').click('click', false);
        $('a').prepend('<span></span> ');
        $('a span').addClass('glyphicon glyphicon-lock');
        $('a span').css('font-size','14px');
//        $('bottom a, bottom1 a').css('margin','88%');
    }     
});

$(document).ready(function(){    
    $('#status').bind('DOMSubtreeModified', function(){
        y = $('#status').text();
        if (y.trim() == 'Complete') {
            setTimeout(function () {
                $('a').unbind('click', false);
                $('a span').removeClass('glyphicon glyphicon-lock');
//                $('bottom a, bottom1 a').css('margin','90%');                
            }, 2000)            
        }
    });
});

<?php 
if ($_GET['page'] == $total[0]) {
    echo "$(document).ready(function(){    
        $('.bottom a, .bottom1 a').attr('href','javascript:window.close()');
        $('.bottom a, .bottom1 a').text('Close');
});";
}
?>
function remainingtime(time) {
    var t = setInterval(function(){
        document.getElementById('time').value = time;
        time--;
        if(time < 0) {
            clearInterval(t);
        }
    },1000)
}

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
<script src="mylibs/gumadapter.js"></script>
<script>  
	var prepare_time = 30;    //enter prepare time
	var recording_time = 40;  //enter recording time
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
		
		
		
		setTimeout(shortSound,inSeconds+1000);		
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
		
		var x=prepareTime;
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
		var beepsource="serveruploads/shortsound/shortsound.wav";
		
		function initShortSound()
		{
			beep=new Audio();
			beep.src=beepsource;
			beep.play();
		}
	
	
		initShortSound();
	}  
    var blob;    

function successCallback(stream){
    setTimeout(strtrecording,prepare_time*1000+2000);    
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

            xhr('myphpuploaders/readaloud11uploader.php', formData, function (fName) {
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
    <?php } ?>  
</body>
</html>