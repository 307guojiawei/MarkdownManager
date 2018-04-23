<?php session_start(); 
    if(isset($_SESSION['usr']))
    {
        $_SESSION['usr']=NULL;
    }
    //username
    $usr_correct = "admin";
    //password
    $pwd_correct = "admin";
    
    

    $userName = $_POST["username"];
    $pwd = $_POST["password"];
    
    if($userName == $usr_correct&&$pwd==$pwd_correct)
    {
        $_SESSION['usr']="admin";
        ?>
            <meta http-equiv="refresh" content="0.1;url=../">
        <?php
    }
?>

<meta http-equiv="refresh" content="0.3;url=./signin.html">

