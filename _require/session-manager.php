<?php
#this file is really needed?
#-maybe not but is quite cool have a lot of files and just call one function on the main files
function tryRemember(){
    if(isset($_COOKIE['session_hash']) &&
       isset($_COOKIE['username'])){
        require 'connect.php';

        $username = $_COOKIE['username'];
        $cookiehash = $_COOKIE['session_hash'];
        
        $query = "SELECT * FROM `user` WHERE username='$username' session_hash='$cookiehash'";
        $result = $mysqli->query($query);

        if(!$result){
            return true;
        }
    }
    return false;
}

function setLogin($username = "GUEST", $role = "GUEST", $remember = false){
    $_SESSION['USERNAME'] = $username;
    $_SESSION['ROLE'] = $role;

    if($remember){
        require 'connect.php';
        $method = 'aes-256-ctr';
        $iv1 = random_bytes(16);
        $iv2 = random_bytes(16);
        $cookiehash = openssl_encrypt($username, $method, $iv1, 0, $iv2);

        setcookie("username", $username, time()+3600*24*365, '/', 'localhost');
        setcookie("session_hash", $cookiehash, time()+3600*24*365, '/', 'localhost');

        $query = "UPDATE `user` SET `session_hash`='$cookiehash' WHERE username='$username'";
        $mysqli->query($query);
    }
}

function unsetLogin(){
    require 'connect.php';

    $username = $_SESSION['USERNAME'];
    $query = "UPDATE `user` SET `session_hash`='NULL' WHERE username='$username'";
    $mysqli->query($query);

    if(isset($_SESSION)){
        session_destroy();        
    }

    unset($_COOKIE['username']); 
    unset($_COOKIE['session_hash']); 
    setcookie('username', null, -1, '/'); 
    setcookie('session_hash', null, -1, '/'); 

}

function isLogged(){
    if(isset($_SESSION['USERNAME']) &&
       isset($_SESSION['ROLE'])){
        return true;
    }
    return false;
}

#Red stands for redirect
function notLoggedRed(){
    if(!isset($_SESSION['USERNAME']) &&
       !isset($_SESSION['ROLE'])){
        header('location: ./');
    }
}
