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
$weak = $weaks = $overall = $overallavg = $listen = array();
$reatotal = $reptotal = $destotal = $rettotal = $shototal = $sumtotal = $esstotal = $smctotal = '';
$mmctotal = $reototal = $rfitotal = $rwftotal = $lwstotal = $lmctotal = $lwftotal = $lrhtotal = '';
$lsmtotal = $lsetotal = $lhitotal = $lwwtotal = '';
$listen = $read = $speak = $write = array();
$overallsum = 0;
try {
    $sql = "select Count(*) from mocktestscores where mocstudid = :studid and mocstatus = 'checked'";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->execute();
        $result = $s->fetch(); 
        $count = $result['0'];        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if ($count >= 3) {
    try {
        $sql = "select * from mocktestscores where mocstudid = :studid";
            $s = $conn->prepare($sql);
            $s->bindValue(':studid', $_SESSION['id']);
            $s->execute();
            $result = $s->fetchAll();
            for ($i = 0; $i < $count; $i++) {
                $listen[$i] = ($result[$i]['replisten'] + $result[$i]['retlisten'] + $result[$i]['sholisten']
                    + $result[$i]['lwslisten'] + $result[$i]['lmclisten'] +  $result[$i]['lwflisten'] + $result[$i]['lrhlisten']
                    + $result[$i]['lsmlisten'] + $result[$i]['lselisten'] + $result[$i]['lhilisten']
                    + $result[$i]['lwwlisten'])/(30 + 15 + 10 + 4 + $result[$i]['lmcblank']/2 + 2 + 2 + 2 + 3 + $result[$i]['lwfblanks']/2 
                    + $result[$i]['lhiblank']/2) * 90; 
                $read[$i] = ($result[$i]['reareading'] + $result[$i]['sumread'] + $result[$i]['smcread']
                    + $result[$i]['mmcread'] + $result[$i]['reoread'] + $result[$i]['rfiread'] + 
                    $result[$i]['rwfread'] + $result[$i]['lrhread'] + $result[$i]['lhiread'])/
                    (30 + 4 + 2 + $result[$i]['mmcblank']/2 + 8 + 2 + $result[$i]['rfiblanks'] + $result[$i]['rwfblanks']/2 + $result[$i]['lhiblank']/2) *90;
                $speak[$i] = ($result[$i]['reaspeaking'] + $result[$i]['repspeak'] + $result[$i]['desspeak'] + $result[$i]['retspeak'] + 
                     $result[$i]['shospeak'])/(60 + 100 + 90 + 30 + 10)*90;
                $write[$i] = ($result[$i]['sumwrite'] + $result[$i]['esswrite'] + $result[$i]['rwfwrite'] + $result[$i]['lwswrite']
                     + $result[$i]['lwfwrite'] + $result[$i]['lwwwrite'])/(10 + 15 + 16 + 3 + $result[$i]['rwfblanks']/2 
                     + $result[$i]['lwfblanks']/2) * 90;
                $content[$i] = ($result[$i]['reacontent'] + $result[$i]['repcontent'] + $result[$i]['descontent'] +
                     $result[$i]['retcontent'] + $result[$i]['sumcontent'] + $result[$i]['esscontent']
                      + $result[$i]['lwscontent'])/(30 + 30 + 30 + 15 + 4 + 3 +4) * 90;
                $gram[$i] = ($result[$i]['sumgrammar'] + $result[$i]['essgrammar'] + $result[$i]['lwsgrammar'])/(4 + 2 + 4) * 90;
                $oral[$i] = ($result[$i]['reafluency'] + $result[$i]['repfluency'] + $result[$i]['desfluency'] + $result[$i]['retfluency'])
                     /(30 + 50 + 30 + 15) * 90;
                $pronounce[$i] = ($result[$i]['reapronounce'] + $result[$i]['reppronounce'] + $result[$i]['despronounce'] + 
                        $result[$i]['retpronounce'])/(30 + 50 + 30 + 15) * 90;
                $spell[$i] = ($result[$i]['essspell'] + $result[$i]['lwsspell'] + 4)/(2 + 4 + 4) * 90;
                $vocab[$i] = ($result[$i]['sumvocab'] + $result[$i]['essvocab'] + $result[$i]['lwsvocab'])/(4 + 2 + 4) * 90;
                $writdisc[$i] = ($result[$i]['sumwritdisc'] + $result[$i]['esswritdisc'] + $result[$i]['lwswritdisc'])/(2 + 6 + 4) * 90;
                $overall[$i] = ($listen[$i] + $speak[$i] + $read[$i] + $write[$i])/4;
                $reatotal[$i] = $result[$i]['readaloudscore']; 
                $reptotal[$i] = $result[$i]['repsentscore'];
                $destotal[$i] = $result[$i]['descimgscore'];
                $rettotal[$i] = $result[$i]['retlectscore'];
                $shototal[$i] = $result[$i]['shoquesscore'];
                $sumtotal[$i] = $result[$i]['sumquesscore'];
                $esstotal[$i] = $result[$i]['essquesscore'];
                $smctotal[$i] = $result[$i]['smcquesscore'];
                $mmctotal[$i] = $result[$i]['mmcquesscore'];
                $reototal[$i] = $result[$i]['reoquesscore'];
                $rfitotal[$i] = $result[$i]['rfiquesscore'];
                $rwftotal[$i] = $result[$i]['rwfquesscore'];
                $lwstotal[$i] = $result[$i]['lwsquesscore'];
                $lmctotal[$i] = $result[$i]['lmcquesscore'];
                $lwftotal[$i] = $result[$i]['lwfquesscore'];
                $lrhtotal[$i] = $result[$i]['lrhquesscore'];
                $lsmtotal[$i] = $result[$i]['lsmquesscore'];
                $lsetotal[$i] = $result[$i]['lsequesscore'];
                $lhitotal[$i] = $result[$i]['lhiquesscore'];
                $lwwtotal[$i] = $result[$i]['lwwquesscore'];
                $reacont[$i] = $result[$i]['reacontent']/180*90;
                $reapron[$i] = $result[$i]['reapronounce']/180*90;
                $reaoral[$i] = $result[$i]['reafluency']/180*90;
                $rearead[$i] = $result[$i]['reareading']/180*90;
                $reaspeak[$i] = $result[$i]['reaspeaking']/180*90;
                $repcont[$i] = $result[$i]['repcontent']/260*90;
                $reppron[$i] = $result[$i]['reppronounce']/260*90;
                $reporal[$i] = $result[$i]['repfluency']/260*90;
                $replisten[$i] = $result[$i]['replisten']/260*90;
                $repspeak[$i] = $result[$i]['repspeak']/260*90;
                $descont[$i] = $result[$i]['descontent']/180*90;
                $despron[$i] = $result[$i]['despronounce']/180*90;
                $desoral[$i] = $result[$i]['desfluency']/180*90;
                $desspeak[$i] = $result[$i]['desspeak']/180*90;
                $retcont[$i] = $result[$i]['retcontent'];
                $retpron[$i] = $result[$i]['retpronounce'];
                $retoral[$i] = $result[$i]['retfluency'];
                $retlisten[$i] = $result[$i]['retlisten'];
                $retspeak[$i] = $result[$i]['retspeak'];
                $sholisten[$i] = $result[$i]['sholisten']/20*90;
                $shospeak[$i] = $result[$i]['shospeak']/20*90;
                $sumcont[$i] = $result[$i]['sumcontent']/28*90;
                $sumgram[$i] = $result[$i]['sumgrammar']/28*90;
                $sumvocab[$i] = $result[$i]['sumvocab']/28*90;
                $sumwrit[$i] = $result[$i]['sumwritdisc']/28*90;
                $sumread[$i] = $result[$i]['sumread']/28*90;
                $sumwrite[$i] = $result[$i]['sumwrite']/28*90;
                $esscont[$i] = $result[$i]['esscontent']/30*90;
                $essgram[$i] = $result[$i]['essgrammar']/30*90;
                $essvocab[$i] = $result[$i]['essvocab']/30*90;
                $essspell[$i] = $result[$i]['essspell']/30*90;
                $esswrit[$i] = $result[$i]['esswritdisc']/30*90;
                $esswrite[$i] = $result[$i]['esswrite']/30*90;
                $smcread[$i] = $result[$i]['smcread']/2*90;
                $mmcread[$i] = $result[$i]['mmcread']/$result[$i]['mmcblank']*90;
                $reoread[$i] = $result[$i]['reoread']/8*90;
                $rfiread[$i] = $result[$i]['rfiread']/$result[$i]['rfiblanks']*90;
                $rfiblank[$i] = $result[$i]['rfiblanks'];
                $rwfread[$i] = $result[$i]['rwfread']/$result[$i]['rwfblanks']*90;
                $rwfwrite[$i] = $result[$i]['rwfwrite']/$result[$i]['rwfblanks']*90;
                $rwfblank[$i] = $result[$i]['rwfblanks'];
                $lwscont[$i] = $result[$i]['lwscontent']/40*90;
                $lwsgram[$i] = $result[$i]['lwsgrammar']/40*90;
                $lwsvocab[$i] = $result[$i]['lwsvocab']/40*90;
                $lwsspell[$i] = $result[$i]['lwsspell']/40*90;
                $lwswrit[$i] = $result[$i]['lwswritdisc']/40*90;
                $lwslisten[$i] = $result[$i]['lwslisten']/40*90;
                $lwswrite[$i] = $result[$i]['lwswrite']/40*90;
                $lmclisten[$i] = $result[$i]['lmclisten']/$result[$i]['lmcblank']*90;
                $lwflisten[$i] = $result[$i]['lwflisten']/$result[$i]['lwfblanks']*90;
                $lwfwrite[$i] = $result[$i]['lwfwrite']/$result[$i]['lwfblanks']*90;
                $lwfblank[$i] = $result[$i]['lwfblanks'];
                $lrhlisten[$i] = $result[$i]['lrhlisten']/4*90;
                $lrhread[$i] = $result[$i]['lrhread']/4*90;
                $lsmlisten[$i] = $result[$i]['lsmlisten']/2*90;
                $lselisten[$i] = $result[$i]['lselisten']/2*90;
                $lhilisten[$i] = $result[$i]['lhilisten']/$result[$i]['lhiblank']*90;
                $lhiread[$i] = $result[$i]['lhiread']/$result[$i]['lhiblank']*90;
                $lhiblank[$i] = $result[$i]['lhiblank'];
                $lwwlisten[$i] = $result[$i]['lwwlisten']/6*90;
                $lwwwrite[$i] = $result[$i]['lwwwrite']/6*90;
            }        
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }

    function avg($x) {
        $xavg = array();
        $xsum = '';
        foreach ($x as $key => $value) {
            $xsum = round($xsum + $value);
            $average = round($xsum/($key+1));
            array_push($xavg, $average);
        }
        return $xavg;
    };

    foreach ($overall as $key => $value) {
        $overallsum = round($overallsum + $value);
        $average = round($overallsum/($key+1));
        array_push($overallavg, $average);
    }
    $reaavg = round(array_sum($reatotal)/($count*180)*90);
    $repavg = round(array_sum($reptotal)/($count*260)*90);
    $desavg = round(array_sum($destotal)/($count*180)*90);
    $retavg = round(array_sum($rettotal)/($count*180)*90);
    $shoavg = round(array_sum($shototal)/($count*20)*90);
    $sumavg = round(array_sum($sumtotal)/($count*28)*90);
    $essavg = round(array_sum($esstotal)/($count*30)*90);
    $smcavg = round(array_sum($smctotal)/($count*2)*90);
    $mmcavg = round(array_sum($mmctotal)/(array_sum($mmcblank))*90);
    $reoavg = round(array_sum($reototal)/($count*8)*90);
    $rfiavg = round(array_sum($rfitotal)/(array_sum($rfiblank))*90);
    $rwfavg = round(array_sum($rwftotal)/(array_sum($rwfblank))*90);
    $lwsavg = round(array_sum($lwstotal)/($count*40)*90);
    $lmcavg = round(array_sum($lmctotal)/(array_sum($lmcblank))*90);
    $lwfavg = round(array_sum($lwftotal)/(array_sum($lwfblank))*90);
    $lrhavg = round(array_sum($lrhtotal)/($count*4)*90);
    $lsmavg = round(array_sum($lsmtotal)/($count*2)*90);
    $lseavg = round(array_sum($lsetotal)/($count*2)*90);
    $lhiavg = round(array_sum($lhitotal)/(array_sum($lhiblank))*90);
    $lwwavg = round(array_sum($lwwtotal)/($count*6)*90);
    $listenavg = round(array_sum($listen)/$count);
    $readavg = round(array_sum($read)/$count);
    $speakavg = round(array_sum($speak)/$count);
    $writeavg = round(array_sum($listen)/$count);
    $contentavg = round(array_sum($content)/$count);
    $grammaravg = round(array_sum($gram)/$count);
    $oralavg = round(array_sum($oral)/$count);
    $pronounceavg = round(array_sum($pronounce)/$count);
    $spellavg = round(array_sum($spell)/$count);
    $vocabavg = round(array_sum($vocab)/$count);
    $writdiscavg = round(array_sum($writdisc)/$count);
}

if (isset($_POST['weak'])) {
    $w = $_POST['weak'];
    if ($reaavg < $w){
        $weak[] = 'Read Aloud average score: ' . '<span class="red">' . round($reaavg) . '/90</span>'; 
    }
    if ($repavg < $w){
        $weak[] = 'Repeat Sentence average score: ' . '<span class="red">' . round($repavg) . '/90</span>'; 
    }
    if ($desavg < $w){
        $weak[] = 'Describe Image average score: ' . '<span class="red">' . round($desavg) . '/90</span>'; 
    }
    if ($retavg < $w){
        $weak[] = 'Re-tell Lecture average score: ' . '<span class="red">' . round($retavg) . '/90</span>'; 
    }
    if ($shoavg < $w){
        $weak[] = 'Answer Short Question average score: ' . '<span class="red">' . round($shoavg) . '/90</span>'; 
    }
    if ($sumavg < $w){
        $weak[] = 'Summarize Text average score: ' . '<span class="red">' . round($sumavg) . '/90</span>'; 
    }
    if ($essavg < $w){
        $weak[] = 'Essay average score: ' . '<span class="red">' . round($essavg) . '/90</span>'; 
    }
    if ($smcavg < $w){
        $weak[] = 'MCQ, Single Choice average score: ' . '<span class="red">' . round($smcavg) . '/90</span>'; 
    }
    if ($mmcavg < $w){
        $weak[] = 'MCQ, Multiple Choice average score: ' . '<span class="red">' . round($mmcavg) . '/90</span>'; 
    }
    if ($reoavg < $w){
        $weak[] = 'Re-order Paragraph average score: ' . '<span class="red">' . round($reoavg) . '/90</span>'; 
    }
    if ($rfiavg < $w){
        $weak[] = 'Fill Blank average score: ' . '<span class="red">' . round($rfiavg) . '/90</span>'; 
    }
    if ($rwfavg < $w){
        $weak[] = 'Reading & Writing, Fill Blank average score: ' . '<span class="red">' . round($rwfavg) . '/90</span>'; 
    }
    if ($lwsavg < $w){
        $weak[] = 'Summarize Spoken Text average score: ' . '<span class="red">' . round($lwsavg) . '/90</span>'; 
    }
    if ($lmcavg < $w){
        $weak[] = 'MCQ, Multiple Choice average score: ' . '<span class="red">' . round($lmcavg) . '/90</span>'; 
    }
    if ($lwfavg < $w){
        $weak[] = 'Fill Blank average score: ' . '<span class="red">' . round($lwfavg) . '/90</span>'; 
    }
    if ($lrhavg < $w){
        $weak[] = 'Highlight Correct Summary average score: ' . '<span class="red">' . round($lrhavg) . '/90</span>'; 
    }
    if ($lsmavg < $w){
        $weak[] = 'MCQ, Single Choice average score: ' . '<span class="red">' . round($lsmavg) . '/90</span>'; 
    }
    if ($lseavg < $w){
        $weak[] = 'Select Missing Word average score: ' . '<span class="red">' . round($lseavg) . '/90</span>'; 
    }
    if ($lhiavg < $w){
        $weak[] = 'Highlight Incorrect Word average score: ' . '<span class="red">' . round($lhiavg) . '/90</span>'; 
    }
    if ($lwwavg < $w){
        $weak[] = 'Write from Dictation average score: ' . '<span class="red">' . round($lwwavg) . '/90</span>'; 
    }
}

if (isset($_POST['weak2'])) {
    $w = $_POST['weak2'];
    if ($listenavg < $w){
        $weaks[] = 'Listening average score: ' . '<span class="red">' . round($listenavg) . '</span>'; 
    }
    if ($readavg < $w){
        $weaks[] = 'Reading average score: ' . '<span class="red">' . round($readavg) . '</span>'; 
    }
    if ($speakavg < $w){
        $weaks[] = 'Speaking average score: ' . '<span class="red">' . round($speakavg) . '</span>'; 
    }
    if ($writeavg < $w){
        $weaks[] = 'Writing average score: ' . '<span class="red">' . round($writeavg) . '</span>'; 
    }
    if ($contentavg < $w){
        $weaks[] = 'Content average score: ' . '<span class="red">' . round($contentavg) . '</span>'; 
    }
    if ($grammaravg < $w) {
        $weaks[] = 'Grammar average score: ' . '<span class="red">' . round($grammaravg) . '</span>';
    }
    if ($oralavg < $w) {
        $weaks[] = 'Oral Fluency average score: ' . '<span class="red">' . round($oralavg) . '</span>';
    }
    if ($pronounceavg < $w) {
        $weaks[] = 'Pronunciation average score: ' . '<span class="red">' . round($pronounceavg) . '</span>';
    }
    if ($spellavg < $w) {
        $weaks[] = 'Spelling average score: ' . '<span class="red">' . round($spellavg) . '</span>';
    }
    if ($vocabavg < $w) {
        $weaks[] = 'Vocabulary average score: ' . '<span class="red">' . round($vocabavg) . '</span>';
    }
    if ($writdiscavg < $w) {
        $weaks[] = 'Written Discourse average score: ' . '<span class="red">' . round($writdiscavg) . '</span>';
    }    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Macro G-Analytics</title>
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
    <script>
    $(document).ready(function() {
    <?php 
    if (userHasRole('Silver')) {
        echo "$('.mid h3, .half, .mid #chart_1, .mid .box').hide();";
        echo "$('#spec').show();";
        echo "$('#spec').html('Please, upgrade to Gold or Diamond course to access this report');";
    }
    ?>
    });
    </script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      var count;
      count = <?php echo $count; ?>;
      if (count >= 3) {
        google.charts.load('visualization', '1', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);
        function drawVisualization() {

          var data = google.visualization.arrayToDataTable([
          ['Mock Test', 'Overall Score', 'Overall Average',{ role: 'style' } ],
          <?php for ($i = 0; $i < $count; $i++){
              echo "['Mock Test ' + ($i+1) + ' ' + Math.round($overall[$i]) + '/90', $overall[$i], $overallavg[$i], '']," . "\n";
               } ?>       
        ]);

          var options = {'title':'Overall Score & Average Overall Score Trend',
                         'width':800,
                         'height':500,
                         titleTextStyle: {fontSize: 20},
  //                       vAxis.viewWindowMode.min: {0,100},
                         vAxis: {gridlines: {count: 10}, viewWindowMode:'explicit', viewWindow:{max:100,min:0}},
                         seriesType: 'bars',
                         series: {1: {type: 'line'}},                                             
                     };

          var chart = new google.visualization.ComboChart(document.getElementById('chart_1'));
          chart.draw(data, options);

        }
      }
    </script>
    <script type="text/javascript">
      if (count >= 3) { 
        google.charts.load('visualization', '1', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

          var data = google.visualization.arrayToDataTable([
          ['Mock Test', 'Read Aloud', 'Repeat Sentence', 'Describe Image', 'Re-Tell Lecture', 'Short Question', 'Summarize Text', 'Essay', { role: 'style' } ],
          ['Ideal Mock Test', Math.round(180/788*100), Math.round(260/788*100), Math.round(180/788*100), Math.round(90/788*100), Math.round(20/788*100), Math.round(28/788*100), Math.round(30/788*100), ''],
          <?php for ($i = 0; $i < $count; $i++){
          echo "['Mock Test ' + ($i+1) + ' ' + Math.round(($reatotal[$i] + $reptotal[$i] + $destotal[$i] + $rettotal[$i] + $shototal[$i] + $sumtotal[$i] + $esstotal[$i])/788*100) + '%', Math.round($reatotal[$i]/788*100), Math.round($reptotal[$i]/788*100), Math.round($destotal[$i]/788*100), Math.round($rettotal[$i]/788*100), Math.round($shototal[$i]/788*100), Math.round($sumtotal[$i]/788*100), Math.round($esstotal[$i]/788*100), '']," . "\n";        
          } ?>         
        ]);


          var options = {'title':'Speaking & Writing',
                         vAxis: {title:'percentage'},
                         'width':800,
                         'height':500,
                         titleTextStyle: {fontSize: 24}, 
                         vAxis: {gridlines: {count: 10}, viewWindowMode:'explicit', viewWindow:{max:100,min:0}},
                         legend: { position: 'right', maxLines: 3 },
                         bar: { groupWidth: '75%' },
                         isStacked: true,
                         backgroundColor: '#E4E4E4',
                         colors: ['#ff4c4c', '#3b5998', '#6dc066', '#008000', '#e5e500', '#ffa500', '#e53fe5', '#fd0081'],
                         animation: {duration: 1000, easing: 'out', startup: true},
                     };

          var chart = new google.visualization.ColumnChart(document.getElementById('chart_2'));
          chart.draw(data, options);
       }
     }
    </script>
    <script type="text/javascript">
      if (count >= 3) {
        google.charts.load('visualization', '1', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

          var data = google.visualization.arrayToDataTable([
          ['Mock Test', 'MCQ, Single Answer', 'MCQ, Multiple Answer', 'Re-order Paragraph', 'Fill Blanks', 'Read & Write Fill Blanks', { role: 'style' } ],
          ['Ideal Mock Test', Math.round(2/(14+<?php echo ($result['0']['rfiblanks']+$result['0']['rwfblanks']); ?>)*100), Math.round(4/(14+<?php echo ($result['0']['rfiblanks']+$result['0']['rwfblanks']); ?>)*100), Math.round(8/(14+<?php echo ($result['0']['rfiblanks']+$result['0']['rwfblanks']); ?>)*100), Math.round(<?php echo ($result['0']['rfiblanks']); ?>/(14+<?php echo ($result['0']['rfiblanks']+$result['0']['rwfblanks']); ?>)*100), Math.round(<?php echo ($result['0']['rwfblanks']); ?>/(14+<?php echo ($result['0']['rfiblanks']+$result['0']['rwfblanks']); ?>)*100), ''],
          <?php for ($i = 0; $i < $count; $i++){
          echo "['Mock Test ' + ($i+1) + ' ' + Math.round(($smctotal[$i] + $mmctotal[$i] + $reototal[$i] + $rfitotal[$i] + $rwftotal[$i])/(14+$rfiblank[$i]+$rwfblank[$i])*100) + '%', Math.round($smctotal[$i]/(14+($rfiblank[$i]+$rwfblank[$i]))*100), Math.round($mmctotal[$i]/(14+($rfiblank[$i]+$rwfblank[$i]))*100), Math.round($reototal[$i]/(14+($rfiblank[$i]+$rwfblank[$i]))*100), Math.round($rfitotal[$i]/(14+($rfiblank[$i]+$rwfblank[$i]))*100), Math.round($rwftotal[$i]/(14+($rfiblank[$i]+$rwfblank[$i]))*100), '']," . "\n";        
          } ?>         
        ]);

          var options = {'title':'Reading',
                         vAxis: {title:'percentage'},
                         'width':800,
                         'height':500,
                         titleTextStyle: {fontSize: 24}, 
                         vAxis: {gridlines: {count: 10}, viewWindowMode:'explicit', viewWindow:{max:100,min:0}},
                         legend: { position: 'right', maxLines: 3 },
                         bar: { groupWidth: '75%' },
                         isStacked: true,
                         backgroundColor: '#E4E4E4',
                         animation: {duration: 1000, easing: 'out', startup: true},
                     };

          var chart = new google.visualization.ColumnChart(document.getElementById('chart_3'));
          chart.draw(data, options);
       }
    }
    </script>
    <script type="text/javascript">
      if (count >= 3) {
        google.load('visualization', '1', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

          var data = google.visualization.arrayToDataTable([
          ['Mock Test', 'Summarize Spoken Text', 'MCQ, Multiple Answer', 'Fill Blanks', 'Highlight Correct Suummary', 'MCQ, Single Answer', 'Select Missing Word', 'Highlight Incorrect Word', 'Write From Dictation',{ role: 'style' } ],
          ['Ideal Mock Test', Math.round(40/(58+<?php echo ($lwfblank[0]+$lhiblank[0]); ?>)*100), Math.round(4/(58+<?php echo ($lwfblank[0]+$lhiblank[0]); ?>)*100), Math.round(<?php echo $lwfblank[0]; ?>/(58+<?php echo ($lwfblank[0]+$lhiblank[0]); ?>)*100), Math.round(4/(58+<?php echo ($lwfblank[0]+$lhiblank[0]); ?>)*100), Math.round(2/(58+<?php echo ($lwfblank[0]+$lhiblank[0]); ?>)*100), Math.round(2/(58+<?php echo ($lwfblank[0]+$lhiblank[0]); ?>)*100), Math.round(<?php echo $lhiblank[0]; ?>/(58+<?php echo ($lwfblank[0]+$lhiblank[0]); ?>)*100), Math.round(6/(58+<?php echo ($lwfblank[0]+$lhiblank[0]); ?>)*100), ''],
          <?php for ($i = 0; $i < $count; $i++){
          echo "['Mock Test ' + ($i+1) + ' ' + Math.round(($lwstotal[$i] + $lmctotal[$i] + $lwftotal[$i] + $lhitotal[$i] + $lsmtotal[$i] + $lsetotal[$i] + $lrhtotal[$i] + $lwwtotal[$i])/(58+$lwfblank[$i]+$lhiblank[$i])*100) + '%', Math.round($lwstotal[$i]/(58+($lwfblank[$i]+$lhiblank[$i]))*100), Math.round($lmctotal[$i]/(58+($lwfblank[$i]+$lhiblank[$i]))*100), Math.round($lwftotal[$i]/(58+($lwfblank[$i]+$lhiblank[$i]))*100), Math.round($lrhtotal[$i]/(58+($lwfblank[$i]+$lhiblank[$i]))*100), Math.round($lsmtotal[$i]/(58+($lwfblank[$i]+$lhiblank[$i]))*100), Math.round($lsetotal[$i]/(58+($lwfblank[$i]+$lhiblank[$i]))*100), Math.round($lhitotal[$i]/(58+($lwfblank[$i]+$lhiblank[$i]))*100), Math.round($lwwtotal[$i]/(58+($lwfblank[$i]+$lhiblank[$i]))*100), '']," . "\n";        
          } ?>         
        ]);

          var options = {'title':'Listening',
                         'width':800,
                         'height':500,
                         vAxis: {title:'percentage'},
                         vAxis: {gridlines: {count: 10}, viewWindowMode:'explicit', viewWindow:{max:100,min:0}},
                         titleTextStyle: {fontSize: 24},
                         backgroundColor: '#E4E4E4',
                         legend: { position: 'right', maxLines: 3 },
                         bar: { groupWidth: '75%' },
                         isStacked: true,
                         animation: {duration: 1000, easing: 'out', startup: true},
                     };

          var chart = new google.visualization.ColumnChart(document.getElementById('chart_4'));
          chart.draw(data, options);
       }
    }
    </script>
    <script type="text/javascript">
      if (count >= 3) {
        google.charts.load('visualization', '1', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

          var data = google.visualization.arrayToDataTable([
          ['Mock Test', 'Listening', 'Reading', 'Speaking', 'Writing', { role: 'style' } ],
          <?php for ($i = 0; $i < $count; $i++){
          echo "['Mock Test' + ' ' + ($i+1), Math.round($listen[$i]), Math.round($read[$i]), Math.round($speak[$i]), Math.round($write[$i]), '']," . "\n";        
          } ?>         
        ]);

          var options = {'title':'Communicative Skills Score Trends',
                         'width':800,
                         'height':500,
                         vAxis: {title:'Score'},
                         vAxis: {gridlines: {count: 10}, viewWindowMode:'explicit', viewWindow:{max:90,min:0}},
                         titleTextStyle: {fontSize: 24},
                         backgroundColor: '#E4E4E4',
                         colors: ['#ff4c4c', '#3b5998', '#6dc066', '#008000'],
                         legend: { position: 'right', maxLines: 3 },                       
                         animation: {duration: 1000, easing: 'out', startup: true},
                     };

          var chart = new google.visualization.LineChart(document.getElementById('chart_5'));
          chart.draw(data, options);
       }
    }
    </script>
    <script type="text/javascript">
      if (count >= 3) {
        google.charts.load('visualization', '1', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

          var data = google.visualization.arrayToDataTable([
          ['Mock Test', 'Content', 'Grammar', 'Oral Fluency', 'Pronunciation', 'Spelling', 'Written Discourse', { role: 'style' } ],
          <?php for ($i = 0; $i < $count; $i++){
          echo "['Mock Test' + ' ' + ($i+1), Math.round($content[$i]), Math.round($gram[$i]), Math.round($oral[$i]), Math.round($pronounce[$i]), Math.round($spell[$i]), Math.round($writdisc[$i]), '']," . "\n";        
          } ?>         
        ]);

          var options = {'title':'Enabling Skills Score Trends',
                         'width':800,
                         'height':500,
                         vAxis: {title:'Score'},
                         vAxis: {gridlines: {count: 10}, viewWindowMode:'explicit', viewWindow:{max:90,min:0}},
                         titleTextStyle: {fontSize: 24},
                         backgroundColor: '#E4E4E4',
                         colors: ['#ff4c4c', '#3b5998', '#6dc066', '#008000', '#e5e500', '#ffa500'],
                         legend: { position: 'right', maxLines: 3 },
                         bar: { groupWidth: '75%' },
                         animation: {duration: 1000, easing: 'out', startup: true},
                     };

          var chart = new google.visualization.LineChart(document.getElementById('chart_6'));
          chart.draw(data, options);
       }
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
            <h3>Macro Analysis of attempted tests</h3>
            <h3 id="spec" style="display: none;"></h3>
            <p class="half"><span class="hfont">Please Note:</span> The scoring for each question type is done strictly 
             according to the official 'PTE Score Guide'. However, since Pearson keeps the criteria relating to 
             allocation of scores and calculation of skill type and overall scores, secret; these scores have been
             calculated using a complex algorithm constructed by us after careful research. These scores  are useful for 
             analytical and preparation purposes only and do not reflect actual PTE scores.</p>
            
            <div id="chart_1">
                
            </div>
            <div id="chart_2" class="box">
                
            </div>
            <div id="chart_3" class="box">
                
            </div>
            <div id="chart_4" class="box">
                
            </div>
            <div id="chart_5" class="box">
                
            </div>
            <div id="chart_6" class="box">
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="half">
                        <form action="" method="post">
                            <h4>Get areas of improvement by target score</h4>
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
                                <option value="100">100</option>
                            </select>
                            <input type="submit" name="action" value="Submit">
                        </form>
                        <div> <?php foreach ($weak as $meek) {echo $meek . '<br>';} ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="half">
                        <form action="" method="post">
                            <h4>Get areas of improvement by Skill type</h4>
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
<?php include_once 'php/includes/footer.html.php';?>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {    
<?php 
if (!userHasRole('Silver')) {
    if ($count < 3){
        echo "$('.mid h3, .half, .mid #chart_1, .mid .box').hide();";
        echo "$('#spec').show();";
        echo "$('#spec').html('You have to attempt atleast 3 practice tests to see this G-Analytics report');";
    }
}
?>
});

$(document).ready(function() {
  $('.dropdown').click(function(){
      $('.dropdownmenu').slideToggle();
  });
});

$(window).load(function() {
   
   var docHeight = $(window).height();
   var footerHeight = $('.footer').height();
   var footerTop = $('.gill').height();
   
   if (footerTop < docHeight) {
        $('.footer').removeClass('bottom');
        $('.footer').addClass('bottom1');
   }
   if ((footerTop) >= docHeight) {
        $('.footer').removeClass('bottom1');
        $('.footer').addClass('bottom');
   }
});

$(window).load(function() {
    y = $('.footer').position();
    $('.navmenu').css('height', y.top);    
});

</script>
</body>
</html>