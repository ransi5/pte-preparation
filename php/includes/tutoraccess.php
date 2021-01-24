<?php
include_once 'connect.php';

function userIsLoggedIn() {
    include 'connect.php';
    if (isset($_POST['action']) && $_POST['action'] == 'login') {
        if (!empty($_POST['email']) || !empty($_POST['password'])) {
            $email = valid($_POST['email']);
            $password = valid($_POST['password']);
            $sql = "select * from tutors where tutemail = :email";
            $s = $conn->prepare($sql);
            $s->bindValue(':email', $email);
            $s->execute();
            $row = $s->fetch();
            $id = $row['tutid'];
            $name = $row['tutname'];
        }
                
        if (databaseContainsAuthor($email, $password)) {
            session_start();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['testid'] = '';
            return TRUE;
        } else {
            session_start();
            unset($_SESSION['loggedin']);
            unset($_SESSION['email']);
            unset($_SESSION['password']);
            unset($_SESSION['id']);
            unset($_SESSION['name']);
            unset($_SESSION['testid']);
            $GLOBALS['loginError'] = 'The specified email address or password was inorrect.';
            return FALSE;
        }
    }
    
    if (isset($_POST['action']) && $_POST['action'] == 'logout') {
        session_start();
        unset($_SESSION['loggedin']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        header('location: '. $_POST['goto']);
        exit();
    }
    session_start();
    if (isset($_SESSION['loggedin'])) {
        return databaseContainsAuthor($_SESSION['email'], $_SESSION['password']);
    }
}

function databaseContainsAuthor($email, $password) {
    include 'connect.php';
    
    try {
        $sql = 'select COUNT(*) from tutors where tutemail = :email and PASSWORD = :password';
        $s = $conn->prepare($sql);
        $s->bindValue(':email', $email);
        $s->bindValue(':password', $password);
        $s->execute();
    } catch (PDOException $e) {
        $errors[] = '<br> Error searcching database: ' . $e->getMessage();
        exit();
    }
    $row = $s->fetch();
    
    if ($row[0] > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function userHasRole($role) {
    include 'connect.php';
    
    try {
        $sql = "select COUNT(*) from tutors inner join tutorrole on tutorid = tutors.tutid inner join role on role.id = tutorrole.tutorroleid where tutors.tutemail = :email and role.permission = :roleid";
        $s = $conn->prepare($sql);
        $s->bindValue(':email', $_SESSION['email']);
        $s->bindValue(':roleid', trim($role));
        $s->execute();        
    } catch (PDOException $e) {
        $errors[] = '<br> error fetching author role: ' . $e->getMessage();
        exit();
    }
    $row = $s->fetch();
    
    if ($row[0] > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function valid($x){
        trim($x);
        stripslashes($x);
        htmlspecialchars($x);
    return $x;
}

?>
