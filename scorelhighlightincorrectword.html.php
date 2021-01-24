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

$key = $key1 = $ans = $ans1 = 0;

try {
    $sql = "select * from lhighlightincorrectwordanswers where lhistudid = :studid and lhitestid = :testid";
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
        $sql = "select * from lhighlightincorrectwordques where lhimid = :mid and lhiqno = 1";
            $s = $conn->prepare($sql);
            $s->bindValue(':mid', $_SESSION['moctestid']);
            $s->execute();
            $result1 = $s->fetch();
            $result1 = explode(',', $result1['lhicorrectanswer']);
            if (!empty($result1['0'])) {$key = $result1['0'];} else {$key1 = '';}
            if (!empty($result1['1'])) {$key2 = $result1['1'];} else {$key2 = '';}
            if (!empty($result1['2'])) {$key3 = $result1['2'];} else {$key3 = '';}
            if (!empty($result1['3'])) {$key4 = $result1['3'];} else {$key4 = '';}
            if (!empty($result1['4'])) {$key5 = $result1['4'];} else {$key5 = '';}
            if (!empty($result1['5'])) {$key6 = $result1['5'];} else {$key6 = '';}
            if (!empty($result1['6'])) {$key7 = $result1['6'];} else {$key7 = '';}
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }

    try {
        $sql = "select * from lhighlightincorrectwordanswers where lhistudid = :studid and lhitestid = :testid and lhiquesno = 1";
            $s = $conn->prepare($sql);
            $s->bindValue(':studid', $_SESSION['mocstudid']);
            $s->bindValue(':testid', $_SESSION['moctestid']);
            $s->execute();
            $result2 = $s->fetch();
            $ans = $result2['lhianswer'];
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
    
    if (!empty($key)) {
        $blanks = 2;
        if (stripos($ans, $key) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    if (!empty($key2)) {
        $blanks = 2;
        if (stripos($ans, $key2) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    if (!empty($key3)) {
        $blanks = 2;
        if (stripos($ans, $key3) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    if (!empty($key4)) {
        $blanks = 2;
        if (stripos($ans, $key4) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    if (!empty($key5)) {
        $blanks = 2;
        if (stripos($ans, $key5) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    if (!empty($key6)) {
        $blanks = 2;
        if (stripos($ans, $key6) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    if (!empty($key7)) {
        $blanks = 2;
        if (stripos($ans, $key7) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    header('location: scorelhighlightincorrectword.html.php?x=1');
    exit();
}

if (isset($_POST['score2'])) {
    try {
        $sql = "select * from lhighlightincorrectwordques where lhimid = :mid and lhiqno = 2";
            $s = $conn->prepare($sql);
            $s->bindValue(':mid', $_SESSION['moctestid']);
            $s->execute();
            $result1 = $s->fetch();
            $result1 = explode(',', $result1['lhicorrectanswer']);
            if (!empty($result1['0'])) {$key = $result1['0'];} else {$key1 = '';}
            if (!empty($result1['1'])) {$key2 = $result1['1'];} else {$key2 = '';}
            if (!empty($result1['2'])) {$key3 = $result1['2'];} else {$key3 = '';}
            if (!empty($result1['3'])) {$key4 = $result1['3'];} else {$key4 = '';}
            if (!empty($result1['4'])) {$key5 = $result1['4'];} else {$key5 = '';}
            if (!empty($result1['5'])) {$key6 = $result1['5'];} else {$key6 = '';}
            if (!empty($result1['6'])) {$key7 = $result1['6'];} else {$key7 = '';}
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }

    try {
        $sql = "select * from lhighlightincorrectwordanswers where lhistudid = :studid and lhitestid = :testid and lhiquesno = 2";
            $s = $conn->prepare($sql);
            $s->bindValue(':studid', $_SESSION['mocstudid']);
            $s->bindValue(':testid', $_SESSION['moctestid']);
            $s->execute();
            $result2 = $s->fetch();
            $ans = $result2['lhianswer'];
    } catch (PDOException $e) {
        echo '<br>Error fetching question: ' . $e->getMessage();
        exit();
    }
    
    if (!empty($key)) {
        $blanks = 2;
        if (stripos($ans, $key) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    if (!empty($key2)) {
        $blanks = 2;
        if (stripos($ans, $key2) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    if (!empty($key3)) {
        $blanks = 2;
        if (stripos($ans, $key3) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    if (!empty($key4)) {
        $blanks = 2;
        if (stripos($ans, $key4) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    if (!empty($key5)) {
        $blanks = 2;
        if (stripos($ans, $key5) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    if (!empty($key6)) {
        $blanks = 2;
        if (stripos($ans, $key6) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    if (!empty($key7)) {
        $blanks = 2;
        if (stripos($ans, $key7) !== FALSE) {
             try {
                 $listen = 1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        } else {
            try {
                 $listen = -1;
                 $read = $listen;
                 $lhiques = $listen + $read;        
                 $sql = 'update mocktestscores set lhilisten = lhilisten + :listen, lhiread = lhiread + :read, lhiquesscore = lhiquesscore + :ques, lhiblank = lhiblank + :blank where mocid = :id';
                 $s = $conn->prepare($sql);
                 $s->bindValue(':listen', $listen);
                 $s->bindValue(':read', $read);
                 $s->bindValue(':ques', $lhiques);
                 $s->bindValue(':blank', $blanks);
                 $s->bindValue(':id', $_SESSION['mocid']);
                 $s->execute();                  
             } catch (PDOException $e) {
                 echo '<br> error updating database: ' . $e->getMessage();
                 exit();
             }
        }
    }
    header('location: scorelhighlightincorrectword.html.php?x=2');
    exit();
}

try {
    $sql = 'select lhiquesscore, lhiblank from mocktestscores where mocid = :id';
    $s = $conn->prepare($sql);
        $s->bindValue(':id', $_SESSION['mocid']);
        $s->execute();
        $row = $s->fetch();
        $lhiscore = $row['lhiquesscore'];
        $lhiblank = $row['lhiblank'];        
} catch (PDOException $e) {
            echo '<br> error updating database: ' . $e->getMessage();
            exit();
}

if ($lhiscore < 0) {            
    $listen = 0;
    $read = $listen;
    $lhiques = $listen + $read;        
    $sql = 'update mocktestscores set lhilisten = :listen, lhiread = :read, lhiquesscore = :ques where mocid = :id';
    $s = $conn->prepare($sql);
    $s->bindValue(':listen', $listen);
    $s->bindValue(':read', $read);
    $s->bindValue(':ques', $lhiques);
    $s->bindValue(':id', $_SESSION['mocid']);
    $s->execute();            
}
ob_flush();?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTE Preparation - Highlight Incorrect Word Check</title>
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
                        <td style="text-align: center"><?php echo $row['lhitestid']; ?></td>
                        <td style="text-align: center"><?php echo $row['lhiquesno']; ?></td>
                        <td><?php echo $row['lhianswer']; ?></td> 
                        <td>
                            <form action="" method="post" name="MyForm">
                                <input type="submit" name="score<?php echo $row['lhiquesno']; ?>" value="submit" id="score<?php echo $row['lhiquesno']; ?>">
                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </table>
                <h3>Score: <?php echo $lhiscore; ?>/<?php echo $lhiblank; ?></h3>
                                                  
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
       window.location = 'scorelwwritedictation.html.php?x=';
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