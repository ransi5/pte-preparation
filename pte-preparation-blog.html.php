<?php
ob_start();
session_start();
include_once 'php/includes/connect.php';

// set default category for side menu

if (!isset($_GET['category'])) {
    header('location: ?category=1');
}
// get category id and name for category list in side menu

$query = 'select * from category';
$result = $conn->query($query);
$category = $result->fetchAll();

//get category name
$sql = "select * from category where id = :category";
$s = $conn->prepare($sql);
$s->bindValue(':category', $_GET['category']);
$s->execute();
$categoryname = $s->fetch();
$name = $categoryname['name'];

// to get blogs from database
if (isset($_GET['category'])) {
    //pagination
    $perpage = 10;
    $page = isset($_GET['page']) && $_GET['page'] >= 1 ? (int)$_GET['page'] : 1;
    $limit = ($page * $perpage) - $perpage;
    $sql = "select blog.id, blog.id, blog.title, blog.description, blog.blogfile, "
            . "blog.authorid, blog.date, members.name from blog inner join members on "
            . "members.id = blog.authorid where blog.categoryid = :category limit $limit, $perpage";
    $s = $conn->prepare($sql);
    $s->bindValue(':category', $_GET['category']);
    $s->execute();
    $blog = $s->fetchAll();
    $query = $conn->query("select count(*) from blog where categoryid = '".$_GET['category']."'");
    $total = $query->fetch();
    $pages = ceil($total[0]/$perpage);    
}

if (isset($_GET['category'])) {
    //pagination
    $vidperpage = 10;
    $page = isset($_GET['page']) && $_GET['page'] >= 1 ? (int)$_GET['page'] : 1;
    $vidlimit = ($page * $vidperpage) - $vidperpage;
    $sql = "select * from videoblog where vidcategory = :category limit $vidlimit, $vidperpage";
    $s = $conn->prepare($sql);
    $s->bindValue(':category', $_GET['category']);
    $s->execute();
    $vidblog = $s->fetchAll();
    $vidquery = $conn->query("select count(*) from videoblog where vidcategory = '".$_GET['category']."'");
    $vidtotal = $query->fetch();
    $vidpages = ceil($vidtotal[0]/$vidperpage);    
}
ob_flush();?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation Blog - Get Free Tips & Strategies</title>
    <meta name="description" content="Get free PTE tips and strategies for all skill and question types - engage with PTE community">
    <meta name="keywords" content="">
    <meta itemprop="name" content="PTE Preparation Blog - Get Free Tips & Strategies">
    <meta itemprop="description" content="Get free PTE tips and strategies for all skill and question types - engage with PTE community">
    <meta itemprop="image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg">
    <meta name="twitter:site" content="@ptepreparations">
    <meta name="twitter:title" content="PTE Preparation Blog - Get Free Tips & Strategies">
    <meta name="twitter:description" content="Get free PTE tips and strategies for all skill and question types - engage with PTE community">
    <meta name="twitter:image:src" content="https://pte-preparation.com/images/ptepreparation-twitter.jpg">
    <meta property="og:url" content="https://www.pte-preparation.com/pte-preparation-blog.html.php?category=<?php echo trim($_GET['category']);?>">
    <meta property="og:title" content="PTE Preparation Blog - Get Free Tips & Strategies">
    <meta property="og:description" content="Get free PTE tips and strategies for all skill and question types - engage with PTE community">
    <meta property="og:image" content="https://pte-preparation.com/images/ptepreparation-social-media.jpg" />
    <meta name="author" content="Gillan Learning Solutions LLP" />
    <meta name="copyright" content="Gillan Learning Solutions LLP" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/blogcomstyle.css">
    <link rel="stylesheet" type="text/css" href="css/blogstyle.css">
    <link rel="alternate" href="feed.xml" title="pte-preparation.com RSS feed" type="application/rss+xml" />
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
        <div class="col-sm-3 col-md-2 fix">
            <ul class="sidebox">
                <h4>Blog Menu</h4>
                <?php foreach ($category as $row) {?>
                <li class="sp"><span class="hovanim"></span><a href="pte-preparation-blog.html.php?category=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-sm-9 col-md-8 mid">
            <div class="well">
                <h2>Free <?php echo $name; ?> tips</h2>
            </div>
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a data-toggle="tab" href="#articles">Click for Articles</a></li>
                <li><a data-toggle="tab" href="#video">Click for Videos</a></li>
            </ul>
            <div class="tab-content">
                <div id="articles" class="tab-pane fade active in">
                    <?php foreach ($blog as $row) {?>
                    <div class="jumbotron">
                        <h3><?php echo $row['title'];?></h3>
                        <h4><?php echo $row['description'];?></h4>
                        <h5>Author: <span class="label label-primary"><?php echo $row['name'];?></span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: <span class="label label-success"><?php echo date('d-m-Y', strtotime($row['date']));?></span></h5>
                            <div class="reader">
                                <a href="pte-blog-reader.html.php?blogid=<?php echo $row['id']; ?>">Read More!</a>
                            </div>
                    </div>
                    <?php } ?>
                    <ul class="pagination">
                        <?php for ($i=1; $i <= $pages; $i++) {?>
                        <li><a href="?category=<?php echo $_GET['category'];?>&page=<?php echo $i?>"><?php echo $i?></a></li>
                        <?php } ?>
                    </ul>                                    
                </div>
                <div id="video" class="tab-pane fade">
                    <?php foreach ($vidblog as $row) {?>
                    <div class="jumbotron">
                        <div class="row">
                            <div class="col-xs-3">
                                <img src="videoblog/thumbnails/<?php echo trim($row['vidthumbnail']);?>" class="img-responsive">
                            </div>
                            <div class="col-xs-7">
                                <h3><?php echo $row['vidtitle'];?></h3>
                                <!--<h4><?php echo $row['viddescription'];?></h4>-->
                                <div class="reader">
                                    <a href="pte-video-blog.html.php?vblog=<?php echo $row['vidid']; ?>">Watch!</a>
                                    &nbsp;&nbsp;&nbsp;<?php if (!empty($row['vidyoutube'])) {echo '<a target="_blank" href="' . $row['vidyoutube'] . '">Watch on Youtube</a>';} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <ul class="pagination">
                        <?php for ($i=1; $i <= $vidpages; $i++) {?>
                        <li><a href="?category=<?php echo $_GET['category'];?>&page=<?php echo $i?>"><?php echo $i?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>            
        </div>
        <div class=" col-sm-0 col-md-2 right" style="color:black;">
            <a target="_blank" href="https://feeds.feedburner.com/Pte-preparationcomRssFeed" title="Subscribe to my feed" rel="alternate" type="application/rss+xml" style="color: royalblue; font-size: 15px; text-align: left;"><img src="//feedburner.google.com/fb/images/pub/feed-icon32x32.png" alt="" style="border:0;"/> &nbsp;&nbsp;Subscribe to RSS feed</a><br><br>
            <a target="_blank" href="https://feedburner.google.com/fb/a/mailverify?uri=Pte-preparationcomRssFeed&amp;loc=en_US" style="color: royalblue; font-size: 15px; text-align: left;"><img src="//feedburner.google.com/fb/images/pub/feed-icon32x32.png" alt="" style="border:0"/> &nbsp;&nbsp;Subscribe by Email</a><br><br>
            <!-- start feedwind code --> <script type="text/javascript" src="https://feed.mikle.com/js/fw-loader.js" data-fw-param="23481/"></script> <!-- end feedwind code -->
        </div>
    </div>    
</div>
<div class="beh">
    <?php include_once 'php/includes/footer.html.php'; ?>        
</div>
<!--End side navigation-->





<script type="text/javascript">
$(document).ready(function() {
    $("[href]").each(function() {
    if (this.href == window.location.href) {
        $(this).closest('li').addClass("active");
        }
    });
});

$(document).ready(function() {
  
   var docHeight = $(window).height();
   var footerHeight = $('.footer').height();
   var footerTop = $('.sidenav').height() + footerHeight;
   
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
    }
});

$(document).ready(function() {
    y = $(window).height();
    y = y-25;
    $('.sidebox').css('height', y);
});


//$(window).load(function() {
//    y = $('.footer').position();
//    $('.sidebox').css('height', y.top);
//});


</script>
<script type='text/javascript'>var fc_JS=document.createElement('script');fc_JS.type='text/javascript';fc_JS.src='https://assets1.freshchat.io/production/assets/widget.js?t='+Date.now();(document.body?document.body:document.getElementsByTagName('head')[0]).appendChild(fc_JS); window._fcWidgetCode='JM7L66MO2E';window._fcURL='https://gillanlearningsolutions.freshchat.io';</script>
</body>
</html>