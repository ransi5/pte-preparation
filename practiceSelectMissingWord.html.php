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

if(!isset($_SESSION['testid']) || $_SESSION['testid'] != 111){
    $_SESSION['testid'] = 111;    
}
$_SESSION['quesno'] = $_GET['page'];

if ($_GET['page'] == 1) {
    try {
        $s = $conn->prepare("delete from lselectmissingwordanswers where lsetestid = :testid and lsestudid = :studid");
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
    $sql = "select * from lselectmissingwordques where lsemid = :mid limit $limit, $perpage";
    $s = $conn->prepare($sql);
    $s->bindValue(':mid', $_SESSION['testid']);
    $s->execute();
    $result = $s->fetchAll();
    $query = $conn->query("select count(*) from lselectmissingwordques where lsemid = '".$_SESSION['testid']."'");
    $total = $query->fetch();
    $pages = ceil($total[0]/$perpage);    
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

$next = $_SESSION['quesno']+1;
$url = "practiceSelectMissingWord.html.php?page=".$next;

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Practice Select Missing Word</title>
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
<?php 
if (isset($_POST['time'])) {
    try {
        $sql = 'insert into lselectmissingwordanswers (lsetestid, lsequesno,  lsestudid, lseanswer) values (:test, :quesno, :studid, :content)';
        $s = $conn->prepare($sql);
        $s->bindValue(':test', $_SESSION['testid']);
        $s->bindValue(':quesno', $_SESSION['quesno']);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->bindValue(':content', $_POST['options']);
        $s->execute();
        if ($_GET['page'] < $total[0]) {
            header('location: '.$url);
        } else {
            echo '<script>window.close();</script>';
        }     
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}
ob_flush();?>
</head>
<body>
    <?php foreach ($result as $row) {?>
    <p id ="khan" style="display: none;">My name is khan</p>
    <p id ="sultan" style="display: none;">My name is sultan</p>
    <div class="container-fluid">
        <div class="gill">
        <div class="header">
            <p> PTE Select Missing Word Practice Questions - <?php echo $_SESSION['name'];?></p>
            <div id="cover">
                <p class="glyphicon glyphicon-time"> Time Remaining </p><div id="timer"></div>
            </div>                
        </div>
        <div class="topper">Question <?php echo $_GET['page']; ?> of <?php echo $total[0]; ?></div>
        
        <div class="heading">You will hear a recording. At the end of the recording the last word or group of words
            has been replaced by the word 'blank'. Select the correct option to complete the recording.</div>

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
                    <form action="" method="post" name="MyForm">
                        <input type="radio" name="options" value="a"><span class="high"> &nbsp;<?php echo trim($row['lseoptiona']);?></span><br><br>
                        <input type="radio" name="options" value="b"><span class="high"> &nbsp;<?php echo trim($row['lseoptionb']);?></span><br><br>
                        <input type="radio" name="options" value="c"><span class="high"> &nbsp;<?php echo trim($row['lseoptionc']);?></span><br><br>
                        <input type="radio" name="options" value="d"><span class="high"> &nbsp;<?php echo trim($row['lseoptiond']);?></span><br><br>
                        <input type="radio" name="options" value="e"><span class="high"> &nbsp;<?php echo trim($row['lseoptione']);?></span><br><br>
                        <input type="hidden" id="time" name="time" value="">
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
                                    
    </div>
        <div id="footer" class="bottom1" id="btn"><a href="javascript:document.MyForm.submit();">Next</a></div>
    </div>
    </div>

  <script>
      
    var time = 90;
    
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

function remainingtime(time) {
    var t = setInterval(function(){
        document.getElementById('time').value = time;
        time--;
        if(time < 0) {
            clearInterval(t);
            document.MyForm.submit();
        }
    },1000)
}

$(document).ready(function(){
    $("#cover").click(function(){
        $("#timer").toggle();
    });
});

<?php 
if ($_GET['page'] == $total[0]) {
    echo "$(document).ready(function(){    
        $('.bottom a, .bottom1 a').text('Close');
});";
}
?>

$(document).ready(function() {
   
   var docHeight = $(window).height();
   var footerHeight = $('#footer').height();
   var footerTop = $('.gill').height();
     
   if (footerTop < docHeight) {
        $('#footer').removeClass('bottom1');
        $('#footer').addClass('bottom');
   }
   if (footerTop >= docHeight) {
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
  
  </script>
  <script>
  var preparetime = 8;											//	Prepare time variable
  var audiosource = "serveruploads/questions/lselectmissingword/<?php echo trim($row['lsefile']); ?>";		//	Audio source
  
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
			var trackDuration=Math.ceil(audio.duration);
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

   
  <?php } ?>
</body>
</html>