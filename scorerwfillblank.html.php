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
$row = $row1 = $row2 = $row3 = $row4 = $ansrow = $ansrow1 =$ansrow2 = $ansrow3 = $ansrow4 = $blanks = NULL;

try {
    $sql = "select * from rwfillblankanswers where rwfstudid = :studid and rwftestid = :testid";
        $s = $conn->prepare($sql);
        $s->bindValue(':studid', $_SESSION['mocstudid']);
        $s->bindValue(':testid', $_SESSION['moctestid']);
        $s->execute();
        $results = $s->fetchAll();        
} catch (PDOException $e) {
    echo '<br>Error fetching question: ' . $e->getMessage();
    exit();
}

if (isset($_POST['score1'])) {
    try {
        $sql = "select * from rwfillblankques where rwfmid = :mid and rwfqno = 1";
            $s = $conn->prepare($sql);
            $s->bindValue(':mid', $_SESSION['moctestid']);
            $s->execute();
            $result1 = $s->fetch();
            $row = trim($result1['rwfanswera']);
            $row1 = trim($result1['rwfanswerb']);
            $row2 = trim($result1['rwfanswerc']);
            $row3 = trim($result1['rwfanswerd']);            
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }

    try {
        $sql = "select * from rwfillblankanswers where rwfstudid = :studid and rwftestid = :testid and rwfquesno = 1";
            $s = $conn->prepare($sql);
            $s->bindValue(':studid', $_SESSION['mocstudid']);
            $s->bindValue(':testid', $_SESSION['moctestid']);
            $s->execute();
            $result2 = $s->fetch();
            $ansrow = trim($result2['rwfansa']);
            $ansrow1 = trim($result2['rwfansb']);
            $ansrow2 = trim($result2['rwfansc']);
            $ansrow3 = trim($result2['rwfansd']);            
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
    if (!empty($row)) {
        $blanks = 2;
        if (strcasecmp($row, $ansrow) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row1)) {
        $blanks = 2;
        if (strcasecmp($row1, $ansrow1) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row2)) {
        $blanks = 2;
        if (strcasecmp($row2, $ansrow2) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row3)) {
        $blanks = 2;
        if (strcasecmp($row3, $ansrow3) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                 
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    } 
    header('location: scorerwfillblank.html.php?x=1');
    exit();
}

if (isset($_POST['score2'])) {
    try {
        $sql = "select * from rwfillblankques where rwfmid = :mid and rwfqno = 2";
            $s = $conn->prepare($sql);
            $s->bindValue(':mid', $_SESSION['moctestid']);
            $s->execute();
            $result1 = $s->fetch();
            $row = trim($result1['rwfanswera']);
            $row1 = trim($result1['rwfanswerb']);
            $row2 = trim($result1['rwfanswerc']);
            $row3 = trim($result1['rwfanswerd']);            
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }

    try {
        $sql = "select * from rwfillblankanswers where rwfstudid = :studid and rwftestid = :testid and rwfquesno = 2";
            $s = $conn->prepare($sql);
            $s->bindValue(':studid', $_SESSION['mocstudid']);
            $s->bindValue(':testid', $_SESSION['moctestid']);
            $s->execute();
            $result2 = $s->fetch();
            $ansrow = trim($result2['rwfansa']);
            $ansrow1 = trim($result2['rwfansb']);
            $ansrow2 = trim($result2['rwfansc']);
            $ansrow3 = trim($result2['rwfansd']);            
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
    if (!empty($row)) {
        $blanks = 2;
        if (strcasecmp($row, $ansrow) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row1)) {
        $blanks = 2;
        if (strcasecmp($row1, $ansrow1) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row2)) {
        $blanks = 2;
        if (strcasecmp($row2, $ansrow2) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row3)) {
        $blanks = 2;
        if (strcasecmp($row3, $ansrow3) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                 
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    } 
    header('location: scorerwfillblank.html.php?x=2');
    exit();
}

if (isset($_POST['score3'])) {
    try {
        $sql = "select * from rwfillblankques where rwfmid = :mid and rwfqno = 3";
            $s = $conn->prepare($sql);
            $s->bindValue(':mid', $_SESSION['moctestid']);
            $s->execute();
            $result1 = $s->fetch();
            $row = trim($result1['rwfanswera']);
            $row1 = trim($result1['rwfanswerb']);
            $row2 = trim($result1['rwfanswerc']);
            $row3 = trim($result1['rwfanswerd']);            
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }

    try {
        $sql = "select * from rwfillblankanswers where rwfstudid = :studid and rwftestid = :testid and rwfquesno = 3";
            $s = $conn->prepare($sql);
            $s->bindValue(':studid', $_SESSION['mocstudid']);
            $s->bindValue(':testid', $_SESSION['moctestid']);
            $s->execute();
            $result2 = $s->fetch();
            $ansrow = trim($result2['rwfansa']);
            $ansrow1 = trim($result2['rwfansb']);
            $ansrow2 = trim($result2['rwfansc']);
            $ansrow3 = trim($result2['rwfansd']);            
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
    if (!empty($row)) {
        $blanks = 2;
        if (strcasecmp($row, $ansrow) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row1)) {
        $blanks = 2;
        if (strcasecmp($row1, $ansrow1) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row2)) {
        $blanks = 2;
        if (strcasecmp($row2, $ansrow2) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row3)) {
        $blanks = 2;
        if (strcasecmp($row3, $ansrow3) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                 
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }  
    header('location: scorerwfillblank.html.php?x=3');
    exit();
}

if (isset($_POST['score4'])) {
    try {
        $sql = "select * from rwfillblankques where rwfmid = :mid and rwfqno = 4";
            $s = $conn->prepare($sql);
            $s->bindValue(':mid', $_SESSION['moctestid']);
            $s->execute();
            $result1 = $s->fetch();
            $row = trim($result1['rwfanswera']);
            $row1 = trim($result1['rwfanswerb']);
            $row2 = trim($result1['rwfanswerc']);
            $row3 = trim($result1['rwfanswerd']);            
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }

    try {
        $sql = "select * from rwfillblankanswers where rwfstudid = :studid and rwftestid = :testid and rwfquesno = 4";
            $s = $conn->prepare($sql);
            $s->bindValue(':studid', $_SESSION['mocstudid']);
            $s->bindValue(':testid', $_SESSION['moctestid']);
            $s->execute();
            $result2 = $s->fetch();
            $ansrow = trim($result2['rwfansa']);
            $ansrow1 = trim($result2['rwfansb']);
            $ansrow2 = trim($result2['rwfansc']);
            $ansrow3 = trim($result2['rwfansd']);            
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
    if (!empty($row)) {
        $blanks = 2;
        if (strcasecmp($row, $ansrow) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row1)) {
        $blanks = 2;
        if (strcasecmp($row1, $ansrow1) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row2)) {
        $blanks = 2;
        if (strcasecmp($row2, $ansrow2) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row3)) {
        $blanks = 2;
        if (strcasecmp($row3, $ansrow3) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }   
    header('location: scorerwfillblank.html.php?x=4');
    exit();
}

if (isset($_POST['score5'])) {
    try {
        $sql = "select * from rwfillblankques where rwfmid = :mid and rwfqno = 5";
            $s = $conn->prepare($sql);
            $s->bindValue(':mid', $_SESSION['moctestid']);
            $s->execute();
            $result1 = $s->fetch();
            $row = trim($result1['rwfanswera']);
            $row1 = trim($result1['rwfanswerb']);
            $row2 = trim($result1['rwfanswerc']);
            $row3 = trim($result1['rwfanswerd']);            
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }

    try {
        $sql = "select * from rwfillblankanswers where rwfstudid = :studid and rwftestid = :testid and rwfquesno = 5";
            $s = $conn->prepare($sql);
            $s->bindValue(':studid', $_SESSION['mocstudid']);
            $s->bindValue(':testid', $_SESSION['moctestid']);
            $s->execute();
            $result2 = $s->fetch();
            $ansrow = trim($result2['rwfansa']);
            $ansrow1 = trim($result2['rwfansb']);
            $ansrow2 = trim($result2['rwfansc']);
            $ansrow3 = trim($result2['rwfansd']);            
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
    if (!empty($row)) {
        $blanks = 2;
        if (strcasecmp($row, $ansrow) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row1)) {
        $blanks = 2;
        if (strcasecmp($row1, $ansrow1) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row2)) {
        $blanks = 2;
        if (strcasecmp($row2, $ansrow2) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    }
    if (!empty($row3)) {
        $blanks = 2;
        if (strcasecmp($row3, $ansrow3) == 0) {
             try {
                 $read = 1;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                 
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } else {
             $blanks = 2;
             try {
                 $read = 0;
                 $write = $read;
                 $rwfques = $read + $write;        
                 $sql = 'update mocktestscores set rwfread = rwfread + :read, rwfwrite = rwfwrite + :write, rwfquesscore = rwfquesscore + :rwfques, rwfblanks = rwfblanks + :blanks where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':write', $write);
                 $s->bindValue(':rwfques', $rwfques);
                 $s->bindValue(':blanks', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();             
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
         } 
    } 
    header('location: scorerwfillblank.html.php?x=5');
    exit();
}

try {
    $sql = 'select rwfquesscore, rwfblanks from mocktestscores where mocid = :id';
    $s = $conn->prepare($sql);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        $col = $s->fetch();
        $rfiscore = $col['rwfquesscore']; 
        $rfiblanks = $col['rwfblanks'];
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
    <title>PTE Preparation - Reading & Writing, Fill in the Blank</title>
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
                                
                <h3>Answers by student</h3>
                <table class="quest" style="width: 100%">
                    <tr>
                        <th>Mock Test Id</th>
                        <th>Item No</th>
                        <th>Answer</th>  
                        <th>Score</th>
                    </tr>
                    
                    <?php foreach ($results as $row) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row['rwftestid']; ?></td>
                        <td style="text-align: center"><?php echo $row['rwfquesno']; ?></td>
                        <td><ul style="list-style-type: none">
                                <li><?php echo $row['rwfansa']; ?></li>
                                <li><?php echo $row['rwfansb']; ?></li>
                                <li><?php echo $row['rwfansc']; ?></li>
                                <li><?php echo $row['rwfansd']; ?></li>                                
                            </ul></td> 
                        <td>
                            <form action="" method="post" name="MyForm">
                                <input type="submit" name="score<?php echo $row['rwfquesno']; ?>" value="submit" id="score<?php echo $row['rwfquesno']; ?>">
                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </table>
                <h3>Score: <?php echo $rfiscore; ?>/<?php echo $rfiblanks; ?></h3>
                                                  
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
       window.location = 'scorelwsummarizetext.html.php?x=';
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