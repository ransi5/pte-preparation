<?php
include_once 'php/includes/connect.php';
include_once 'php/includes/access.php';

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
$weak = array();
$weaks = array();
$reatotal = $reptotal = $destotal = $rettotal = $shototal = $sumtotal = $esstotal = $smctotal = '';
$mmctotal = $reototal = $rfitotal = $rwftotal = $lwstotal = $lmctotal = $lwftotal = $lrhtotal = '';
$lsmtotal = $lsetotal = $lhitotal = $lwwtotal = $listen = $read = $speak = $write = $overall = '';

if (isset($_POST['action']) && $_POST['action'] == 'View') {
    $_SESSION['testid'] = $_POST['moctestid'];
    $_SESSION['mocid'] = $_POST['mocid'];
    header('location: gmicroanalytics.html.php');
    exit();
}

try {
    $sql = "select * from mocktestscores where mocid = :id and mocstudid = :studid";
        $s = $conn->prepare($sql);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->execute();
        $result = $s->fetch();
        $listen = ($result['replisten'] + $result['retlisten'] + $result['sholisten']
            + $result['lwslisten'] + $result['lmclisten'] +  $result['lwflisten'] + $result['lrhlisten']
            + $result['lsmlisten'] + $result['lselisten'] + $result['lhilisten']
            + $result['lwwlisten'])/(30 + 15 + 10 + 4 + $result['lmcblank']/2 + 2 + 2 + 2 + 3 + $result['lwfblanks']/2 
            + $result['lhiblank']/2) * 90; 
        $read = ($result['reareading'] + $result['sumread'] + $result['smcread']
            + $result['mmcread'] + $result['reoread'] + $result['rfiread'] + 
            $result['rwfread'] + $result['lrhread'] + $result['lhiread'])/
            (30 + 4 + 2 + $result['mmcblank']/2 + 8 + 2 + $result['rfiblanks'] + $result['rwfblanks']/2 + $result['lhiblank']/2) *90;
        $speak = ($result['reaspeaking'] + $result['repspeak'] + $result['desspeak'] + $result['retspeak'] + 
             $result['shospeak'])/(60 + 100 + 90 + 30 + 10)*90;
        $write = ($result['sumwrite'] + $result['esswrite'] + $result['rwfwrite'] + $result['lwswrite']
             + $result['lwfwrite'] + $result['lwwwrite'])/(10 + 15 + 16 + 3 + $result['rwfblanks']/2 
             + $result['lwfblanks']/2) * 90;
        $content = ($result['reacontent'] + $result['repcontent'] + $result['descontent'] +
             $result['retcontent'] + $result['sumcontent'] + $result['esscontent']
              + $result['lwscontent'])/(30 + 30 + 30 + 15 + 4 + 3 +4) * 90;
        $gram = ($result['sumgrammar'] + $result['essgrammar'] + $result['lwsgrammar'])/(4 + 2 + 4) * 90;
        $oral = ($result['reafluency'] + $result['repfluency'] + $result['desfluency'] + $result['retfluency'])
             /(30 + 50 + 30 + 15) * 90;
        $pronounce = ($result['reapronounce'] + $result['reppronounce'] + $result['despronounce'] + 
                $result['retpronounce'])/(30 + 50 + 30 + 15) * 90;
        $spell = ($result['essspell'] + $result['lwsspell'])/(2 + 4) * 90;
        $vocab = ($result['sumvocab'] + $result['essvocab'] + $result['lwsvocab'])/(4 + 2 + 4) * 90;
        $writdisc = ($result['sumwritdisc'] + $result['esswritdisc'] + $result['lwswritdisc'])/(2 + 6 + 4) * 90;
        $overall = ($listen + $speak + $read + $write)/4;
        $reatotal = $result['readaloudscore']/180*90; 
        $reptotal = $result['repsentscore']/260*90;
        $destotal = $result['descimgscore']/180*90;
        $rettotal = $result['retlectscore'];
        $shototal = $result['shoquesscore']/20*90;
        $sumtotal = $result['sumquesscore']/28*90;
        $esstotal = $result['essquesscore']/30*90;
        $smctotal = $result['smcquesscore']/2*90;
        $mmctotal = $result['mmcquesscore']/$result['mmcblank']*90;
        $reototal = $result['reoquesscore']/8*90;
        $rfitotal = $result['rfiquesscore']/$result['rfiblanks']*90;
        $rwftotal = $result['rwfquesscore']/$result['rwfblanks']*90;
        $lwstotal = $result['lwsquesscore']/40*90;
        $lmctotal = $result['lmcquesscore']/$result['lmcblank']*90;
        $lwftotal = $result['lwfquesscore']/$result['lwfblanks']*90;
        $lrhtotal = $result['lrhquesscore']/4*90;
        $lsmtotal = $result['lsmquesscore']/2*90;
        $lsetotal = $result['lsequesscore']/2*90;
        $lhitotal = $result['lhiquesscore']/$result['lhiblank']*90;
        $lwwtotal = $result['lwwquesscore']/6*90;
        $reacont = $result['reacontent']/180*90;
        $reapron = $result['reapronounce']/180*90;
        $reaoral = $result['reafluency']/180*90;
        $rearead = $result['reareading']/180*90;
        $reaspeak = $result['reaspeaking']/180*90;
        $repcont = $result['repcontent']/260*90;
        $reppron = $result['reppronounce']/260*90;
        $reporal = $result['repfluency']/260*90;
        $replisten = $result['replisten']/260*90;
        $repspeak = $result['repspeak']/260*90;
        $descont = $result['descontent']/180*90;
        $despron = $result['despronounce']/180*90;
        $desoral = $result['desfluency']/180*90;
        $desspeak = $result['desspeak']/180*90;
        $retcont = $result['retcontent'];
        $retpron = $result['retpronounce'];
        $retoral = $result['retfluency'];
        $retlisten = $result['retlisten'];
        $retspeak = $result['retspeak'];
        $sholisten = $result['sholisten']/20*90;
        $shospeak = $result['shospeak']/20*90;
        $sumcont = $result['sumcontent']/28*90;
        $sumgram = $result['sumgrammar']/28*90;
        $sumvocab = $result['sumvocab']/28*90;
        $sumwrit = $result['sumwritdisc']/28*90;
        $sumread = $result['sumread']/28*90;
        $sumwrite = $result['sumwrite']/28*90;
        $esscont = $result['esscontent']/30*90;
        $essgram = $result['essgrammar']/30*90;
        $essvocab = $result['essvocab']/30*90;
        $essspell = $result['essspell']/30*90;
        $esswrit = $result['esswritdisc']/30*90;
        $esswrite = $result['esswrite']/30*90;
        $smcread = $result['smcread']/2*90;
        $mmcread = $result['mmcread']/$result['mmcblank']*90;
        $reoread = $result['reoread']/8*90;
        $rfiread = $result['rfiread']/$result['rfiblanks']*90;
        $rwfread = $result['rwfread']/$result['rwfblanks']*90;
        $rwfwrite = $result['rwfwrite']/$result['rwfblanks']*90;
        $lwscont = $result['lwscontent']/40*90;
        $lwsgram = $result['lwsgrammar']/40*90;
        $lwsvocab = $result['lwsvocab']/40*90;
        $lwsspell = $result['lwsspell']/40*90;
        $lwswrit = $result['lwswritdisc']/40*90;
        $lwslisten = $result['lwslisten']/40*90;
        $lwswrite = $result['lwswrite']/40*90;
        $lmclisten = $result['lmclisten']/$result['lmcblank']*90;
        $lwflisten = $result['lwflisten']/$result['lwfblanks']*90;
        $lwfwrite = $result['lwfwrite']/$result['lwfblanks']*90;
        $lrhlisten = $result['lrhlisten']/4*90;
        $lrhread = $result['lrhread']/4*90;
        $lsmlisten = $result['lsmlisten']/2*90;
        $lselisten = $result['lselisten']/2*90;
        $lhilisten = $result['lhilisten']/$result['lhiblank']*90;
        $lhiread = $result['lhiread']/$result['lhiblank']*90;
        $lwwlisten = $result['lwwlisten']/6*90;
        $lwwwrite = $result['lwwwrite']/6*90;
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}


if (isset($_POST['weak'])) {
    $w = $_POST['weak'];
    if ($reatotal < $w){
        $weak[] = 'readaloud: ' . '<span class="red">' . round($reatotal) . '</span>'; 
    }
    if ($reptotal < $w) {
        $weak[] = 'Repeat Sentence: ' . '<span class="red">' . round($reptotal) . '</span>';
    }
    if ($destotal < $w) {
        $weak[] = 'Describe Image: ' . '<span class="red">' . round($destotal) . '</span>';
    }
    if ($rettotal < $w) {
        $weak[] = 'Re-Tell Lecture: ' . '<span class="red">' . round($rettotal) . '</span>';
    }
    if ($shototal < $w) {
        $weak[] = 'Answer Short Question: ' . '<span class="red">' . round($shototal) . '</span>';
    }
    if ($sumtotal < $w) {
        $weak[] = 'Summarize Written Text: ' . '<span class="red">' . round($sumtotal) . '</span>';
    }
    if ($esstotal < $w) {
        $weak[] = 'Essay: ' . '<span class="red">' . round($esstotal) . '</span>';
    }
    if ($smctotal < ($w-30) && $smctotal != 90) {
        $weak[] = 'MCQ Choose Single Answer: ' . '<span class="red">' . round($smctotal) . '</span>';
    }
    if ($mmctotal < ($w-20) && $mmctotal != 90) {
        $weak[] = 'MCQ Choose Multiple Answer: ' . '<span class="red">' . round($mmctotal) . '</span>';
    }
    if ($reototal < ($w-12) && $reototal != 90) {
        $weak[] = 'Re-order Paragraph: ' . '<span class="red">' . round($reototal) . '</span>';
    }    
    if ($rfitotal < ($w-5)) {
        $weak[] = 'Reading, Fill in the Blanks: ' . '<span class="red">' . round($rfitotal) . '</span>';
    }
    if ($rwftotal < $w) {
        $weak[] = 'Reading & Writing, Fill in the Blanks: ' . '<span class="red">' . round($rwftotal) . '</span>';
    }
    if ($lwstotal < $w) {
        $weak[] = 'Summarize Spoken Text: ' . '<span class="red">' . round($lwstotal) . '</span>';
    }
    if ($lmctotal < ($w-20) && $lmctotal != 90) {
        $weak[] = 'Listening, MCQ Choose Multiple Answers: ' . '<span class="red">' . round($lmctotal) . '</span>';
    }
    if ($lwftotal < ($w-5) && $lwftotal != 90) {
        $weak[] = 'Listening & Writing, Fill in the Blank: ' . '<span class="red">' . round($lwftotal) . '</span>';
    }
    if ($lrhtotal < ($w-20) && $lrhtotal != 90) {
        $weak[] = 'Highlight Correct Summary: ' . '<span class="red">' . round($lrhtotal) . '</span>';
    }
    if ($lsmtotal < ($w-30) && $lsmtotal != 90) {
        $weak[] = 'MCQ Choose Single Answer: ' . '<span class="red">' . round($lsmtotal) . '</span>';
    }
    if ($lsetotal < ($w-30) && $lsetotal != 90) {
        $weak[] = 'Select Missing Word: ' . '<span class="red">' . round($lsetotal) . '</span>';
    }
    if ($lhitotal < ($w-5) && $lhitotal != 90) {
        $weak[] = 'Highlight Incorrect Word: ' . '<span class="red">' . round($lhitotal) . '</span>';
    }
    if ($lwwtotal < ($w-12) && $lwwtotal != 90) {
        $weak[] = 'Write from Dictation: ' . '<span class="red">' . round($lwwtotal) . '</span>';
    }
}

if (isset($_POST['weak2'])) {
    $w = $_POST['weak2'];
    if ($content < $w){
        $weaks[] = 'Content: ' . '<span class="red">' . round($content) . '</span>'; 
    }
    if ($gram < $w) {
        $weaks[] = 'Grammar: ' . '<span class="red">' . round($gram) . '</span>';
    }
    if ($oral < $w) {
        $weaks[] = 'Oral Fluency: ' . '<span class="red">' . round($oral) . '</span>';
    }
    if ($pronounce < $w) {
        $weaks[] = 'Pronunciation: ' . '<span class="red">' . round($pronounce) . '</span>';
    }
    if ($spell < $w) {
        $weaks[] = 'Spelling: ' . '<span class="red">' . round($spell) . '</span>';
    }
    if ($vocab < $w) {
        $weaks[] = 'Vocabulary: ' . '<span class="red">' . round($vocab) . '</span>';
    }
    if ($writdisc < $w) {
        $weaks[] = 'Written Discourse: ' . '<span class="red">' . round($writdisc) . '</span>';
    }    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Micro G-Analytics</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/comstyle.css">
    <link rel="stylesheet" type="text/css" href="css/ganalyticsstyle.css">
    <link rel="stylesheet" type="text/css" href="css/studentportal.css">
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
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('visualization', '1', {packages: ['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
        ['Skill', 'Score', { role: 'style' } ],
        ['Communicative Skills', 0, ''],
        ['Listening ' + <?php echo round($listen); ?>, <?php echo round($listen); ?>, 'rgb(51, 102, 204)'],
        ['Reading ' + <?php echo round($read); ?>, <?php echo round($read); ?>, 'rgb(51, 102, 204)'],
        ['Speaking ' + <?php echo round($speak); ?>, <?php echo round($speak); ?>, 'rgb(51, 102, 204)'],
        ['Writing ' + <?php echo round($write); ?>, <?php echo round($write); ?>, 'rgb(51, 102, 204)'],
        ['Enabling Skills', 0, ''],
        ['Grammar ' + <?php echo round($gram); ?>, <?php echo round($gram); ?>, 'rgb(66, 133, 244)'],
        ['Oral Fluency ' + <?php echo round($oral); ?>, <?php echo round($oral); ?>, 'rgb(66, 133, 244)'],
        ['Pronunciation ' + <?php echo round($pronounce); ?>, <?php echo round($pronounce); ?>, 'rgb(66, 133, 244)'],
        ['Spelling ' + <?php echo round($spell); ?>, <?php echo round($spell); ?>, 'rgb(66, 133, 244)'],
        ['Vocabulary ' + <?php echo round($vocab); ?>, <?php echo round($vocab); ?>, 'rgb(66, 133, 244)'],
        ['Written Discourse ' + <?php echo round($writdisc); ?>, <?php echo round($writdisc); ?>, 'rgb(66, 133, 244)'],
      ]);
            
        var options = {'title':'Skills Portfolio',
                       'width':800,
                       'height':500,
                       hAxis: {gridlines: {count: 10}, viewWindowMode:'explicit', viewWindow:{max:90,min:0}},
                       titleTextStyle: {fontSize: 24},
                       legend: {position: 'none'},
                       animation: {duration: 1000, easing: 'out', startup: true},
                   };

        var chart = new google.visualization.BarChart(document.getElementById('chart_1'));
        chart.draw(data, options);

      }
    </script>
    <script type="text/javascript">

      google.charts.load('visualization', '1', {packages: ['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
        ['Question Type', 'Listening', 'Reading', 'Speaking', 'Writing', 'Grammar', 'Oral Fluency', 'Pronunciation', 'Spelling', 'Vocabulary', 'Content', 'Written Discourse', { role: 'style' } ],
        ['Read Aloud ' + <?php echo round($reatotal); ?> + '/90', 0, <?php echo round($rearead); ?>, <?php echo round($reaspeak); ?>, 0, 0, <?php echo round($reaoral); ?>, <?php echo round($reapron); ?>, 0, 0, <?php echo round($reacont); ?>, 0, ''],
        ['Repeat Sentence ' + <?php echo round($reptotal); ?> + '/90', <?php echo round($replisten); ?>, 0, <?php echo round($repspeak); ?>, 0, 0, <?php echo round($reporal); ?>, <?php echo round($reppron); ?>, 0, 0, <?php echo round($repcont); ?>, 0, ''],
        ['Describe Image ' + <?php echo round($destotal); ?> + '/90', 0, 0, <?php echo round($desspeak); ?>, 0, 0, <?php echo round($desoral); ?>, <?php echo round($despron); ?>, 0, 0, <?php echo round($descont); ?>, 0, ''],
        ['Re-Tell Lecture ' + <?php echo round($rettotal); ?> + '/90', <?php echo round($retlisten); ?>, 0, <?php echo round($retspeak); ?>, 0, 0, <?php echo round($retoral); ?>, <?php echo round($retpron); ?>, 0, 0, <?php echo round($retcont); ?>, 0, ''],
        ['Short Question ' + <?php echo round($shototal); ?> + '/90', <?php echo round($sholisten); ?>, 0, <?php echo round($shospeak); ?>, 0, 0, 0, 0, 0, 0, 0, 0, ''],
        ['Summarize Text ' + <?php echo round($sumtotal); ?> + '/90', 0, <?php echo round($sumread); ?>, 0, <?php echo round($sumwrite); ?>, <?php echo round($sumgram); ?>, 0, 0, 0, <?php echo round($sumvocab); ?>, <?php echo round($sumcont); ?>, <?php echo round($sumwrit); ?>, ''],
        ['Essay ' + <?php echo round($esstotal); ?> + '/90', 0, 0, 0, <?php echo round($esswrite);  ?>, <?php echo round($essgram);  ?>, 0, 0, <?php echo round($essspell);  ?>, <?php echo round($essvocab);  ?>, <?php echo round($esscont);  ?>, <?php echo round($esswrit);  ?>, ''],        
      ]);
//        var view = new google.visualization.DataView(data);
            
        var options = {'title':'Speaking & Writing',
                       'width':800,
                       'height':500,
                       vAxis: {gridlines: {count: 10}, viewWindowMode:'explicit', viewWindow:{max:90,min:0}},
                       titleTextStyle: {fontSize: 24},                       
                       legend: { position: 'right', maxLines: 3 },
                       bar: { groupWidth: '75%' },
                       isStacked: true,
                       backgroundColor: '#E4E4E4',
                       colors: ['#ff4c4c', '#3b5998', '#6dc066', '#008000', '#e5e500', '#ffa500', '#e53fe5', '#fd0081', '#f09609', '#00aba9', '#bf9a00'],
                       animation: {duration: 1000, easing: 'out', startup: true},
                   };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_2'));
        chart.draw(data, options);
     }
    </script>
    <script type="text/javascript">

      google.charts.load('visualization', '1', {packages: ['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
        ['Question Type', 'Listening', 'Reading', 'Speaking', 'Writing', 'Grammar', 'Oral Fluency', 'Pronunciation', 'Spelling', 'Vocabulary', 'Content', 'Written Discourse', { role: 'style' } ],
        ['MCQ, Choose Single Answer ' + <?php echo round($smctotal); ?> + '/90', 0, <?php echo round($smcread);?>, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''],
        ['MCQ, Choose Multiple Answers ' + <?php echo round($mmctotal); ?> + '/90', 0, <?php echo round($mmcread);?>, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''],
        ['Re-order Paragraph ' + <?php echo round($reototal); ?> + '/90', 0, <?php echo round($reoread);?>, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''],
        ['Fill Blanks ' + <?php echo round($rfitotal); ?> + '/90', 0, <?php echo round($rfiread);?>, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''],
        ['Reading & Writing, Fill Blanks ' + <?php echo round($rwftotal); ?> + '/90', 0, <?php echo round($rwfread);?>, 0, <?php echo round($rwfwrite);?>, 0, 0, 0, 0, 0, 0, 0, ''],                
      ]);
//        var view = new google.visualization.DataView(data);
            
        var options = {'title':'Reading',
                       'width':800,
                       'height':500,
                       vAxis: {gridlines: {count: 10}, viewWindowMode:'explicit', viewWindow:{max:90,min:0}},
                       titleTextStyle: {fontSize: 24},
                       colors: ['#ff4c4c', '#3b5998', '#6dc066', '#008000', '#e5e500', '#ffa500', '#e53fe5', '#fd0081', '#f09609', '#00aba9', '#bf9a00'],
                       legend: { position: 'right', maxLines: 3 },
                       backgroundColor: '#E4E4E4',
                       bar: { groupWidth: '75%' },
                       isStacked: true,
                       animation: {duration: 1000, easing: 'out', startup: true},
                   };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_3'));
        chart.draw(data, options);
     }
    </script>
    <script type="text/javascript">

      google.charts.load('visualization', '1', {packages: ['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
        ['Question Type', 'Listening', 'Reading', 'Speaking', 'Writing', 'Grammar', 'Oral Fluency', 'Pronunciation', 'Spelling', 'Vocabulary', 'Content', 'Written Discourse', { role: 'style' } ],
        ['Summarize Spoken Text ' + <?php echo round($lwstotal); ?> + '/90', <?php echo round($lwslisten); ?>, 0, 0, <?php echo round($lwswrite); ?>, <?php echo round($lwsgram); ?>, 0, 0, <?php echo round($lwsspell); ?>, <?php echo round($lwsvocab); ?>, <?php echo round($lwscont); ?>, <?php echo round($lwswrit); ?>, ''],
        ['MCQ, Multiple Choice ' + <?php echo round($lmctotal); ?> + '/90', <?php echo round($lmclisten); ?>, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''],
        ['Listening & Writing, Fill Blank ' + <?php echo round($lwftotal); ?> + '/90', <?php echo round($lwflisten); ?>, 0, 0, <?php echo round($lwfwrite); ?>, 0, 0, 0, 0, 0, 0, 0, ''],
        ['Highlight Correct Summary ' + <?php echo round($lrhtotal); ?> + '/90', <?php echo round($lrhlisten); ?>, <?php echo round($lrhread); ?>, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''],
        ['MCQ, Single answer ' + <?php echo round($lsmtotal); ?> + '/90', <?php echo round($lsmlisten); ?>, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''],
        ['Select Missing Word ' + <?php echo round($lsetotal); ?> + '/90', <?php echo round($lselisten); ?>, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''],
        ['Highlight Incorrect Word ' + <?php echo round($lhitotal); ?> + '/90', <?php echo round($lhilisten); ?>, <?php echo round($lhiread); ?>, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''],
        ['Write From Dictation ' + <?php echo round($lwwtotal); ?> + '/90', <?php echo round($lwwlisten); ?>, 0, 0, <?php echo round($lwwwrite); ?>, 0, 0, 0, 0, 0, 0, 0, ''],
      ]);
//        var view = new google.visualization.DataView(data);
            
        var options = {'title':'Listening',
                       'width':800,
                       'height':500,
                       vAxis: {gridlines: {count: 10}, viewWindowMode:'explicit', viewWindow:{max:90,min:0}},
                       titleTextStyle: {fontSize: 24},
                       backgroundColor: '#E4E4E4',
                       colors: ['#ff4c4c', '#3b5998', '#6dc066', '#008000', '#e5e500', '#ffa500', '#e53fe5', '#fd0081', '#f09609', '#00aba9', '#bf9a00'],
                       legend: { position: 'right', maxLines: 3 },
                       bar: { groupWidth: '75%' },
                       isStacked: true,
                       animation: {duration: 1000, easing: 'out', startup: true},
                   };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_4'));
        chart.draw(data, options);
     }
    </script>
    
</head>
<body>
<div class="container-fluid">
<div class="gill">
<?php include_once 'php/includes/navbar.html.php';?>

<!--Start side navigation-->
<div class="container-fluid sidenav">
    <div class="row">
        <div class="col-md-2">
            <div class="sidebox">
                <ul class="navmenu">
                    <div>yarsg</div>
                    <ul class="navmenu">
                        <p>Welcome</p>
                        <h4 class="center"><?php echo $_SESSION['name']; ?></h4>
                        <li><a href="studdashboard.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-dashboard"></span> &nbsp;Dashboard</a></li>
                        <li><a href="practiceques.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-question-sign"></span> &nbsp;Practice Questions</a></li>
                        <li><a href="mocktest.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-edit"></span> &nbsp;Mock Tests</a></li>
                        <li><a href="mocktestanskey.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-wrench"></span> &nbsp;Answer Key</a></li>
                        <li class="dropdown active">
                            <a href="#"><span class="hovanim"></span><span class="glyphicon glyphicon-stats"></span> &nbsp;G-Analytics &nbsp;<span class="glyphicon glyphicon-menu-down pull-right"></span></a>
                            <ul class="dropdownmenu">
                                <li><a href="mocktestchecked.html.php"><span class="movanim"></span>Results & Micro Analysis</a></li>
                                <li><a href="gmacroanalytics.html.php"><span class="movanim"></span>Macro Analysis</a></li>
                            </ul></li>
                        <li><a href="studfeedbackappt.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-earphone"></span> &nbsp;Feedback Appointment</a></li>
                        <li><a href="upgradeprogram.html.php"><span class="hovanim"></span><span class="glyphicon glyphicon-level-up"></span> &nbsp;Upgrade Program</a></li>
                    </ul>
            </div>
        </div>
        <div class="col-md-8 mid">
            <h3>Mock Test Result and G-Micro Analytics</h3>
            <p class="half"><span class="hfont">Please Note:</span> The scoring for each question type is done strictly 
             according to the official 'PTE Score Guide'. However, since Pearson keeps the criteria relating to 
             allocation of scores and calculation of skill type and overall scores, secret; these scores have been
             calculated using a complex algorithm constructed by us after careful research. These scores  are useful for 
             analytical and preparation purposes only and do not reflect actual PTE scores.</p>
            <h3 style="margin-top: 20px;">Overall Score: <?php echo round($overall); ?></h3>
            <div id="chart_1">
                
            </div>
            <div id="chart_2" class="box">
                
            </div>
            <div id="chart_3" class="box">
                
            </div>
            <div id="chart_4" class="box">
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="half">
                        <form action="" method="post">
                            <h4>Get areas of improvement by question type for this test</h4>
                            <select name="weak">
                                <option>Choose Target Score</option>
                                <option value="55">55</option>
                                <option value="60">60</option>
                                <option value="65">65</option>
                                <option value="70">70</option>
                                <option value="75">75</option>
                                <option value="80">80</option>
                                <option value="85">85</option>
                                <option value="90">90</option>
                            </select>
                            <input type="submit" name="action" value="Submit">
                        </form>
                        <div> <?php foreach ($weak as $meek) {echo $meek . '<span class="red">/90</span>' . '<br>';} ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="half">
                        <form action="" method="post">
                            <h4>Get areas of improvement by Enabling Skill type for this test</h4>
                            <select name="weak2">
                                <option>Choose Target Score</option>
                                <option value="55">55</option>
                                <option value="60">60</option>
                                <option value="65">65</option>
                                <option value="70">70</option>
                                <option value="75">75</option>
                                <option value="80">80</option>
                                <option value="85">85</option>
                                <option value="90">90</option>
                                <option value="100">100</option>
                            </select>
                            <input type="submit" name="action1" value="Submit">
                        </form>
                        <div> <?php foreach ($weaks as $meek) {echo $meek . '<span class="red">/90</span>' . '<br>';} ?></div>
                    </div>
                    
                </div>
            </div>
            
        </div>
        <div class="col-md-2 right">
            
        </div>
    </div>
</div>

</div>
</div>
<!--End side navigation-->





<script type="text/javascript">
$(document).ready(function() {
  $('.dropdown').click(function(){
      $('.dropdownmenu').slideToggle();
  });
});

//$(window).load(function() {
//   
//   var docHeight = $(window).height();
//   var footerHeight = $('.footer').height();
//   var footerTop = $('.gill').height();
//   
//   if (footerTop < docHeight) {
//        $('.footer').removeClass('bottom1');
//        $('.footer').addClass('bottom');
//   }
//   if ((footerTop) >= docHeight) {
//        $('.footer').removeClass('bottom');
//        $('.footer').addClass('bottom1');
//   }
//});

//$(window).load(function() {
//    y = $(window).position();
//    console.log(y);    
//    $('.navmenu').css('height', y.top);
//});

</script>
</body>
</html>