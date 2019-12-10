<?php
    session_start();
    include "../model/api.php";

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
        
        $cookie_name = "session";
        $cookie_value = "Angelo";
        setcookie($cookie_name, $cookie_value, time() + (1200), "/"); // 20 mins
        $_SESSION["user"] = $_COOKIE['session'];
        session_start();
        echo true;
    }
    else
    {
        //Failure
        echo false;
    }
    
?>