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
    $sql = 'select * from lhighlightincorrectwordques where lhimid = :testid and lhiqno = :qno';
    $s = $conn->prepare($sql);
    $s->bindValue(':testid', $_SESSION['testid']);
    $s->bindValue(':qno', '1');
    $s->execute();
    while ($row = $s->fetch()) {
        $file = $row['lhifile'];
        $content = $row['lhicontent'];        
    }
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if (isset($_POST['time'])) {
    try {
        $words = valid($_POST['words']);
        $sql = 'insert into lhighlightincorrectwordanswers (lhitestid, lhiquesno,  lhistudid, lhianswer) values (:test, :quesno, :studid, :content)';
        $s = $conn->prepare($sql);
        $s->bindValue(':test', $_SESSION['testid']);
        $s->bindValue(':quesno', '1');
        $s->bindValue(':studid', $_SESSION['id']);
        $s->bindValue(':content', $words);
        $s->execute();
        if ($_POST['time'] < 0) {
            try {
                header('location: mocktestend.php');       
                exit();
            } catch (PDOException $e) {
                echo '<br> error updating database: ' . $e->getMessage();
                exit();
            }
        } else {
            try {
                header('location: lhighlightincorrectword2.php?x=' . $_POST['time'] . '&y=' . $_POST['ftime']);       
                exit();
            } catch (PDOException $e) {
                echo '<br> error updating database: ' . $e->getMessage();
                exit();
            }
        }
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}
ob_flush();?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Practice Test - Highlight Incorrect Word Question 1</title>
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
    <p id ="khan" style="display: none;">My name is khan</p>
    <p id ="sultan" style="display: none;">My name is sultan</p>
    <div class="container-fluid">
        <div class="gill">
        <div class="header">
            <p> Pearson Test of English Academic (Mock Test) - <?php echo $_SESSION['name'];?></p>
            <div id="cover">
                <p class="glyphicon glyphicon-time"> Time Remaining </p><div id="timer"></div>
            </div>                
        </div>
        <div class="topper"></div>
        
        <div class="heading">You will hear a recording. Below is a transcript of the recording.
         Some words in the transcript differ from what the speaker(s) said. Please click on the 
         words that are different.</div>

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
    <div class="container">
        	
        <div class="row">
            <div class="col-md-11">
                <div class="content"><?php echo trim($content)?></div>
                <form action="" method="post" name="MyForm">
                    <input type="hidden" id="words" name="words" value="">
                    <input type="hidden" id="time" name="time" value="">
                    <input type="hidden" id="ftime" name="ftime" value="">
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
                                    
    </div>
        <div id="footer" class="bottom1" id="btn"><a href="javascript:document.MyForm.submit();">Next</a></div>
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
        if(time <= 0) {
            $('#words').attr('disabled','disabled');           
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

$(document).ready(function(){
    $("input[type=radio]").click(function(){
        $(".high").removeClass('highlight');
        $(this).next().addClass('highlight');
    });
});

$(document).ready(function(){
   var words = $(".content").text().split(" ");
    $(".content").empty();
    $.each(words, function(i, v) {
        $(".content").append($("<span>").text(v));
        $('span').append(' ');
        $("span").click(function(){
            y = $(this).hasClass('highlight');
            if (y === false) {
                $(this).addClass('highlight'); 
            } else {
                $(".highlight").click(function(){
                    $(this).removeAttr('class');
                });
            }
        });        
    });
});

$(document).ready(function(){
    $('.content').click(function(){
        x = $('.highlight').text().replace(/ /g,'');
        $('#words').val(x);
    });
    
});
  
  </script>
  <script>
  var preparetime = 11;											//	Prepare time variable
  var audiosource = "serveruploads/questions/lhighlightincorrectword/<?php echo trim($file); ?>";		//	Audio source
  
  var audiostatus=document.getElementById("audiostatus");
  audiostatus.style.color="black";
var audio;
audio=new Audio();
audio.src=audiosource;
audio.addEventListener('durationchange',setDurat);
function setDurat() {
    document.getElementById("khan").innerHTML=audio.duration;
}
    
  var counter=preparetime;
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
		  
		  main();
	  }
  }
  
  function clearaudiostartinterval()
  {
	  clearInterval(audiostartinterval);
  }
  
  function main()
  {
//	var audio;
	initAudioPlayer();
	function initAudioPlayer()
	{
//		audio=new Audio();
//		audio.src=audiosource;
//		audio.addEventListener('loadedmetadata',setDuration);	
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
			var downstring=Math.ceil(trackDuration);
			function downCounter()
			{
				if (downstring>0)
				{
					downstring--;
					var toDisplay=downstring;
				}
				else
				{
					clearDownInterval();
					audiostatus.innerHTML="<strong>Stopped</strong>";
					document.getElementById("progressbar2").className="progress-bar progress-bar-primary";
					audiostatus.style.color="black";
				}
			}
			function clearDownInterval()
			{
				clearInterval(countDownInterval);
			}
		}
					
		function setDuration() 
		{
//			document.getElementById("khan").innerHTML=audio.duration;
			audio.play(); 
		}
					
	}
	
  }
  
   
  </script>

   <script type='text/javascript' > var statustag = document.getElementById("status"); statustag.innerHTML="Not Recording"; </script>
     
</body>
</html>