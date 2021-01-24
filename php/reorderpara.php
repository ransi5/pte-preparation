<?php 
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/PTE web/PTE/php/includes/connect.php';

$list = $_POST['list'];
$output = array();
$list = parse_str($list, $output);
$a = implode(',', $output['opt']);
echo $a;

try {
        $sql = 'insert into reorderparagraphanswers (reotestid, reostudid, reoanswer) values (:test, :studid, :content)';
        $s = $conn->prepare($sql);
        $s->bindValue(':test', $_SESSION['testid']);
        $s->bindValue(':studid', $_SESSION['id']);
        $s->bindValue(':content', $a);
        $s->execute();
        exit();
    } catch (PDOException $e) {
        echo '<br> error updating database: ' . $e->getMessage();
        exit();
    }

?>

