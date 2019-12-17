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
    
    //compare the entered password with the hash from dynamodb
    if (password_verify($pass, $hashed))
    {
        //Success
        $_SESSION['user'] = true;
        session_start();
    }
    else
    {
        //Failure
        return false;
    }
    
?>