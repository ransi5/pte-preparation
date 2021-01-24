<?php
ob_start();
session_start();
include_once 'php/includes/connect.php';
include 'php/includes/access.php';


$id = $description = $title = $name = $date = $success1 = '';
$blog = array();
$errors = array();

// get category id and name for category list in side menu

$query = 'select * from category';
$result = $conn->query($query);
$category = $result->fetchAll();

// Read More button
if (isset($_GET['vblog'])) {
    $id = $_GET['vblog'];
    
    // to get blogs from database
    $sql = "select * from videoblog where vidid = :id";
    $s = $conn->prepare($sql);
    $s->bindValue(':id', $id);
    $s->execute();
    $row = $s->fetch();
    $id = $row['vidid'];
    $title = $row['vidtitle'];
    $description = $row['viddescription'];
    $links = $row['vidlinks'];
    $vimeo = $row['vidvimeo'];
    $thumbnail = $row['vidthumbnail'];
    $duration = $row['vidduration'];
    $date = $row['viddate'];    
    
    // Read comments
    $sql = "SELECT * from videocomments WHERE vcovblog = :id and vcostatus = :status order by vcodate desc";
    $s = $conn->prepare($sql);
    $s->bindValue(':id', $id);
    $s->bindValue('status', 'Approved');
    $s->execute();
    $result = $s->fetchAll();
}

//Post Comments

if (isset($_POST['action']) && $_POST['action'] == 'Add Comment') {
    $comment = valid($_POST['comment']);
    $name = valid($_POST['name']);
    $email = valid($_POST['email']);
    $id = $_POST['id'];
   
    if (strlen($comment) < 140) {
        try{            
            $sql = "insert into videocomments (vcovblog, vconame, vcoemail, vcostatus, vcocomment, vcodate) values (:id, :name, :email, :status, :comment, now())";
            $s = $conn->prepare($sql);
            $s->bindValue(':id', $id);
            $s->bindValue(':name', $name);
            $s->bindValue(':email', $email);
            $s->bindValue(':status', 'unapproved');
            $s->bindValue(':comment', $comment);
            $s->execute();
            $success1 = 'Your comment will be posted within 25 hrs subject to approval.';
        } catch (PDOException $e) {
            $errors[] = '<br> Error posting Comment' . $e->getMessage();
            exit();
        }
    } else {
        $errors[] = "<br>you have exceeded the character limit of 140. "
                . "Kindly rephrase your comment to within 140 characters";
        
    }
}
ob_flush();?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title;?></title>
    <meta name="description" content="<?php echo $description;?>">
    <meta itemprop="name" content="<?php echo $title;?>">
    <meta itemprop="description" content="<?php echo $description;?>">
    <meta itemprop="image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg">
    <meta name="twitter:site" content="@ptepreparations">
    <meta name="twitter:title" content="<?php echo $title;?>">
    <meta name="twitter:description" content="<?php echo $description;?>">
    <meta name="twitter:image:src" content="https://pte-preparation.com/images/ptepreparation-twitter.jpg">
    <meta property="og:url" content="https://www.pte-preparation.com/pte-blog-reader.html.php?blogid=<?php echo trim($_GET['blogid']);?>">
    <meta property="og:title" content="<?php echo $title;?>">
    <meta property="og:description" content="<?php echo $description;?>">
    <meta property="og:image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg" />
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/blogcomstyle.css">
    <link rel="stylesheet" type="text/css" href="css/blogstyle.css">
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
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58cbd51eca94e100119e5566&product=inline-share-buttons"></script>
    <script>
    
    </script>
</head>
<body>
    <div class="gill">
<!--Start navbar-->
<div class="container-fluid common">    
    <nav class="nav navbar-default">
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="myNavbar">
                <div class="row">
                    <ul class="nav navbar-nav">                    
                            <div class="col-sm-2">
                                <li><div class="hovanim"></div><a href="https://www.pte-preparation.com/"><span class="glyphicon glyphicon-home"></span></a></li>
                            </div>
                            <div class="col-sm-2">
                                <li><div class="hovanim"></div><a href="pte-courses-online.html.php">Courses</a></li>
                            </div>
                            <div class="col-sm-2">
                                <li><div class="hovanim"></div><a href="pte-courses-enrolment.html.php">Enrol</a></li>
                            </div>
                            <div class="col-sm-2 active">
                                <li><div class="hovanim"></div><a href="pte-preparation-blog.html.php">Blog</a></li>
                            </div>
                            <div class="col-sm-2">
                                <li><div class="hovanim"></div><a href="pte-preparation-contact.html.php">Contact</a></li>
                            </div>
                            <div class="col-sm-2">
                                
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != FALSE) { 
                            echo '<li><div class="hovanim"></div><a href="php/ptelogout.php"><span class="glyphicon glyphicon-log-out"> </span> Logout</a></li>'; 
                        } else { 
                            echo '<li><div class="hovanim"></div><a href="pte-preparation-login.html.php"><span class="glyphicon glyphicon-log-in"> </span> Login</a></li>'; 
                        }?> 
                            </div>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
<div class="container-fluid mobile">
    <nav class="nav navbar-default">
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sidebar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="sidebar">
                <div class="row">
                    <ul class="nav navbar-nav">
                        <?php foreach ($category as $row) {?>
                        <div class="col-sm-2">
                            <li><span class="hovanim"></span><a href="pte-preparation-blog.html.php?category=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>

                        </div>
                        <?php } ?>                           
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
<!--End Navbar-->

<!--Start side navigation-->
<div class="container-fluid sidenav">
    <div class="row">
        <div class="col-xs-0 col-sm-2 fix">
            <div class="sidebox">
                <h4>Blog Menu</h4>
                <?php foreach ($category as $row) {?>
                <div class="sp"><div class="hovanim"></div><a href="pte-preparation-blog.html.php?category=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></div><br>
                <?php } ?>
            </div>
        </div>
        <div class="col-sm-8 mid">
            <div class="well">
                <h1>PTE Preparation Video Blog</h1>
            </div>
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-10">
                    <div itemprop="video" itemscope itemtype="http://schema.org/VideoObject" style="width: 100%; margin: 0 auto;">
                        <h2><span itemprop="name"><?php echo trim($title);?></span></h2>
                        <meta itemprop="duration" content="<?php echo trim($duration);?>" />
                        <meta itemprop="thumbnailUrl" content="https://www.pte-preparation.com/videoblog/thumbnails/<?php echo trim($thumbnail);?>" />
                        <meta itemprop="embedURL" content="<?php echo trim($vimeo);?>" />
                        <meta itemprop="uploadDate" content="<?php echo trim($date);?>" />
                        <meta itemprop="height" content="405" />
                        <meta itemprop="width" content="720" />
                        <div class="flex-video vimeo">
                            <embed src="<?php echo trim($vimeo);?>" width="640" height="360" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                        </div>
                        <span itemprop="description" style="margin-top: 50px; font-size: 16px; color: black;"><?php echo trim($description);?></span>
                    </div>
                    <p style="font-size: 16px; color: black;"><?php echo trim($links);?></p>
                </div>
                <div class="col-xs-1"></div>
            </div>
        </div>
        <div class="col-xs-0 col-sm-2 right">
            <a target="_blank" href="http://www.copyscape.com/"><img src="images/copyscape-seal-blue-120x100.png" class="responsive" width="120" height="100" border="0" alt="Protected by Copyscape" title="Protected by Copyscape Plagiarism Checker - Do not copy content from this page." /></a><br><br>
            
        </div>
    </div>
    <div class="comments">
        <div class="row">
<!--            <div class="col-sm-2"></div>-->
            <div class="col-sm-10">
                <h3>Comments</h3>
                <div class="jumbotron">
                    <h4>Add Comment</h4>
                    <h6>Note: Comments are restricted to 140 characters. Rude and abusive comments 
                    will not be approved.</h6>
                    <h6><?php foreach ($errors as $error) { echo $error; } ?><?php if (empty($errors)){echo trim($success1);}?></h6>
                    <form method="post" action="" role="form">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control" 
                                      placeholder="Type Name (not more than 12 characters)" required>
                        </div>
                        <div class="form-group">
                            <input name="email" type="email" class="form-control" 
                                      placeholder="Type email" required>
                        </div>
                        <div class="form-group">
                            <textarea name="comment" rows="3" cols="114" class="form-control" 
                                      placeholder="type comment here" required></textarea>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="action" value="Add Comment">                        
                    </form>
                </div>
                <?php foreach ($result as $row) {?>
                <div class="jumbotron">
                    <p><?php echo $row['vconame']; ?> says: &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['vcocomment']; ?></p>
                </div>
                <?php } ?>
            <div class="col-sm-2"></div>
        </div>
    </div>
</div>
<!--End side navigation-->
<div class="beh">
        <?php include_once 'php/includes/footer.html.php'; ?>        
    </div>

</div>


<script type="text/javascript">
$(document).ready(function() {
    $("[href]").each(function() {         
    if (this.href === document.referrer) {
        $(this).closest('li').addClass("active");
        }
    });
});

$(document).ready(function() {
  
   var docHeight = $(window).height();
   var footerHeight = $('#footer').height();
   var footerTop = $('.sidenav').height();
   
   if (footerTop < docHeight) {
        $('.footer').removeClass('bottom1');
        $('.footer').addClass('bottom');
   }
   if ((footerTop) >= docHeight) {
        $('.footer').removeClass('bottom');
        $('.footer').addClass('bottom1');
   }
});

$(document).ready(function() {
    if ($(window).width() > 700){
        y = $('.sidebox').width();
        y = y;
        $('.mid').css('margin-left', y);
        $('.comments').css('margin-left', y);
    }
});

$(document).ready(function() {
    y = $(window).height();
    y = y-25;
    $('.sidebox').css('height', y);
});

</script>
<script type='text/javascript'>var fc_JS=document.createElement('script');fc_JS.type='text/javascript';fc_JS.src='https://assets1.freshchat.io/production/assets/widget.js?t='+Date.now();(document.body?document.body:document.getElementsByTagName('head')[0]).appendChild(fc_JS); window._fcWidgetCode='JM7L66MO2E';window._fcURL='https://gillanlearningsolutions.freshchat.io';</script>
</body>
</html>