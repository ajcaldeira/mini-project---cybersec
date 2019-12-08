<?php
    session_start();
    include "api.php";

    $email = $_POST['emailinput'];
    $email = htmlspecialchars($email);
    $email = stripcslashes($email);

    $pass = $_POST['passinput'];
    $pass = htmlspecialchars($pass);
    $pass = stripcslashes($pass);

    $login = login_user($email);
    $checkEmail = json_decode($login);
    $hashed = $checkEmail->password;
    
    if (password_verify($pass, $hashed))
    {
        //Success
        echo true;
        $cookie_name = "session";
        $cookie_value = "Angelo";
        setcookie($cookie_name, $cookie_value, time() + (1200), "/"); // 20 mins
        $_SESSION["user"] = $_COOKIE['session'];
        
        
    }
    else
    {
        //Failure
        echo false;
    }
    
?>