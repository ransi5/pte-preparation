<?php
ob_start();
include_once 'php/includes/connect.php';
include 'php/includes/tutoraccess.php';

if (!userIsLoggedIn())
{
include 'ptetutorlogin.html.php';
exit();
}
if (!userHasRole('Admin') && !userHasRole('Tutor'))
{
$error = 'Only Admin may access this page.';
include 'tutoraccessdenied.html.php';
exit();
}

try {
    $sql = "select * from shortanswerques where shomid = :mid";
        $s = $conn->prepare($sql);
        $s->bindValue(':mid', $_SESSION['moctestid']);
        $s->execute();
        $result = $s->fetchAll();        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

try {
    $sql = "select * from shortquestionanswers where shostudid = :studid and shotestid = :testid";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_SESSION['mocstudid']);
        $s->bindValue(':testid', $_SESSION['moctestid']);
        $s->execute();
        $results = $s->fetchAll();        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if (isset($_POST['content1'])){
    $cont1 = valid($_POST['content1']);
    $listen = $cont1;
    $speak = $cont1;
    $shoques = $listen + $speak;
    try {
        $sql = 'update mocktestscores set sholisten = sholisten + :listen, shospeak = shospeak + :speak, shoquesscore = shoquesscore + :shoques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':shoques', $shoques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreshortanswer.html.php?x=1');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content2'])){
    $cont1 = valid($_POST['content2']);
    $listen = $cont1;
    $speak = $cont1;
    $shoques = $listen + $speak;
    try {
        $sql = 'update mocktestscores set sholisten = sholisten + :listen, shospeak = shospeak + :speak, shoquesscore = shoquesscore + :shoques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':shoques', $shoques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreshortanswer.html.php?x=2');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content3'])){
    $cont1 = valid($_POST['content3']);
    $listen = $cont1;
    $speak = $cont1;
    $shoques = $listen + $speak;
    try {
        $sql = 'update mocktestscores set sholisten = sholisten + :listen, shospeak = shospeak + :speak, shoquesscore = shoquesscore + :shoques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':shoques', $shoques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreshortanswer.html.php?x=3');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content4'])){
    $cont1 = valid($_POST['content4']);
    $listen = $cont1;
    $speak = $cont1;
    $shoques = $listen + $speak;
    try {
        $sql = 'update mocktestscores set sholisten = sholisten + :listen, shospeak = shospeak + :speak, shoquesscore = shoquesscore + :shoques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':shoques', $shoques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreshortanswer.html.php?x=4');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content5'])){
    $cont1 = valid($_POST['content5']);
    $listen = $cont1;
    $speak = $cont1;
    $shoques = $listen + $speak;
    try {
        $sql = 'update mocktestscores set sholisten = sholisten + :listen, shospeak = shospeak + :speak, shoquesscore = shoquesscore + :shoques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':shoques', $shoques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreshortanswer.html.php?x=5');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content6'])){
    $cont1 = valid($_POST['content6']);
    $listen = $cont1;
    $speak = $cont1;
    $shoques = $listen + $speak;
    try {
        $sql = 'update mocktestscores set sholisten = sholisten + :listen, shospeak = shospeak + :speak, shoquesscore = shoquesscore + :shoques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':shoques', $shoques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreshortanswer.html.php?x=6');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content7'])){
    $cont1 = valid($_POST['content7']);
    $listen = $cont1;
    $speak = $cont1;
    $shoques = $listen + $speak;
    try {
        $sql = 'update mocktestscores set sholisten = sholisten + :listen, shospeak = shospeak + :speak, shoquesscore = shoquesscore + :shoques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':shoques', $shoques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreshortanswer.html.php?x=7');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content8'])){
    $cont1 = valid($_POST['content8']);
    $listen = $cont1;
    $speak = $cont1;
    $shoques = $listen + $speak;
    try {
        $sql = 'update mocktestscores set sholisten = sholisten + :listen, shospeak = shospeak + :speak, shoquesscore = shoquesscore + :shoques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':shoques', $shoques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreshortanswer.html.php?x=8');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content9'])){
    $cont1 = valid($_POST['content9']);
    $listen = $cont1;
    $speak = $cont1;
    $shoques = $listen + $speak;
    try {
        $sql = 'update mocktestscores set sholisten = sholisten + :listen, shospeak = shospeak + :speak, shoquesscore = shoquesscore + :shoques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':shoques', $shoques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreshortanswer.html.php?x=9');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

if (isset($_POST['content10'])){
    $cont1 = valid($_POST['content10']);
    $listen = $cont1;
    $speak = $cont1;
    $shoques = $listen + $speak;
    try {
        $sql = 'update mocktestscores set sholisten = sholisten + :listen, shospeak = shospeak + :speak, shoquesscore = shoquesscore + :shoques where mocid = :id';
        $s = $conn->prepare($sql);
        $s->bindValue(':listen', $listen);
        $s->bindValue(':speak', $speak);
        $s->bindValue(':shoques', $shoques);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        header('location: scoreshortanswer.html.php?x=10');
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }
}

try {
    $sql = 'select shoquesscore from mocktestscores where mocid = :id';
    $s = $conn->prepare($sql);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        $col = $s->fetch();
        $score = $col['shoquesscore'];
} catch (PDOException $e) {
            echo '<br> error updating database: ' . $e->getMessage();
            exit();
}
ob_flush();?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Answer Short Question Check</title>
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/scorestyle.css" rel="stylesheet" type="text/css" />
    <style>
        table, th, td{border: 1px solid black; border-collapse: collapse;}
        th{text-align: center;}
        th{color: white; background-color: #f55959;}
        table.quest tr:nth-child(even) {background-color: #eee;}
        table.quest tr:nth-child(odd) {background-color: #fff;}
        table.quest{margin-bottom: 20px;}
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
</head>
<body>
    <div class="container-fluid">
        <div class="gill">
            <div class="container">
                <p>Student Id: <?php echo $_SESSION['mocstudid']; ?></p>
                <table class="quest" style="width: 100%">
                    <tr>
                        <th>Mock Test Id</th>
                        <th>Item No</th>
                        <th>Answer Short Question Text</th>
                        <th>Answer Key</th>
                    </tr>
                    <?php foreach ($result as $row) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['shomid']; ?></td>
                        <td style="text-align: center"><?php echo $row['shoqno']; ?></td>
                        <td><?php echo $row['shotext']; ?></td>
                        <td><?php echo $row['shoanskey']; ?></td>
                    </tr>
                    <?php }?>
                </table>   
                
                <p>Answers by student</p>
                <table class="quest" style="width: 100%">
                    <tr>
                        <th>Mock Test Id</th>
                        <th>Item No</th>
                        <th>Answer</th>
                        <th>Score</th>
                    </tr>
                    
                    <?php foreach ($results as $row) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['shotestid']; ?></td>
                        <td style="text-align: center"><?php echo $row['shoquesno']; ?></td>
                        <td>
                            <audio controls>
                                <source src="myphpuploaders/clientuploads/shortanswer/<?php echo $row['shofile']; ?>" type="audio/mpeg">
                            </audio>
                        </td>
                        <td>
                            <form action="" method="post" name="MyForm<?php echo $row['shoquesno'];?>">
                            Score: <select name="content<?php echo $row['shoquesno'];?>">
                                    <option>Choose Marks</option>
                                    <option value="1">correct</option>
                                    <option value="0">incorrect</option>
                                </select><br>
                                
                                <input type="submit" name="score" value="submit" id="score<?php echo $row['shoquesno'];?>">
                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </table>
                <h3>Score: <?php echo $score; ?>/20</h3>
                <table class="quest" style="width: 100%">
                    <tr>
                        <th colspan="3">Score Guide</th>
                    </tr>
                    <tr>
                        <th>Score</th>
                        <th>Criteria</th>                                                
                    </tr>
                    <tr>
                        <td style="text-align: center">1</td>
                        <td>Appropriate word choice in response</td>
                    </tr> 
                    <tr>
                        <td style="text-align: center">0</td>
                        <td>Inappropriate word choice in response</td>                        
                    </tr>                      
                </table>                                  
            </div>
            <div id="footer" class="bottom1"><button type="button" class="btn btn-default btn-md" id="next">Next</button></div>
        </div>
    </div>
  <script>
$(document).ready(function() {
    $('#score<?php echo $_GET['x']; ?>').attr('disabled', 'disabled');        
});
    
$(document).ready(function() {
   $('#next').click(function(){
       window.location = 'scoresummarizetext.html.php?x=';
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

</body>
</html>