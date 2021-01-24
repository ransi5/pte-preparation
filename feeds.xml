<?php 
ob_start();
session_start();
include_once 'php/includes/connect.php';
header('Content-Type: application/xml');
$rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
$rssfeed .= '<rss version="2.0">';
$rssfeed .= '<channel>';
$rssfeed .= '<title>pte-preparation.com RSS feed</title>';
$rssfeed .= '<link>https://www.pte-preparation.com.com</link>';
$rssfeed .= '<description>PTE preparation study material with free PTE tips and strategies</description>';
$rssfeed .= '<language>en-us</language>';
$rssfeed .= '<copyright>Copyright (C) 2009 mywebsite.com</copyright>';

$sql = "select blog.id, blog.id, blog.title, blog.description, blog.blogfile, "
            . "blog.authorid, blog.date, members.name from blog inner join members on "
            . "members.id = blog.authorid order by date DESC";
$s = $conn->prepare($sql);
$s->execute();
$rows = $s->fetchAll();

foreach ($rows as $row) {
    $rssfeed .= '<item>';
    $rssfeed .= '<title>' . trim($row['title']) . '</title>';
    $rssfeed .= '<description>' . trim($row['description']) . '</description>';
    $rssfeed .= '<link>https://www.pte-preparation.com/pte-blog-reader.html.php?blogid=' . trim($row['id']) . '</link>';
    $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($row['date'])) . '</pubDate>';
    $rssfeed .= '</item>';    
}

$rssfeed .= '</channel>';
$rssfeed .= '</rss>';

echo $rssfeed;

ob_flush();?>

