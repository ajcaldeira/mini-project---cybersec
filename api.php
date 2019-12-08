<?php

function ValidateSession(){
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        return true; //user is logged in
    }
    else{
        return false; //user is not logged in
    }
}

function sub($topic){
    if(!ValidateSession()){echo "No session"; return 0;}
    $topic = htmlspecialchars($topic);
    $topic = stripcslashes($topic);
    $command = escapeshellcmd('sudo python3 subscribe.py ' . $topic);
    $output = exec($command);
    //echo $output;
}

function pub($topic){
    if(!ValidateSession()){echo "No session"; return 0;}
    $topic = htmlspecialchars($topic);
    $topic = stripcslashes($topic);
    $command = escapeshellcmd('sudo python3 publisher.py ' . $topic);
    $output = exec($command);
}

function alarmoff(){
    if(!ValidateSession()){echo "No session"; return 0;}
    $command = escapeshellcmd('sudo python3 ac_int.py listen');
    $output = exec($command);
   // echo $output;
}

function alarmon(){
    if(!ValidateSession()){echo "No session"; return 0;}
    $command = escapeshellcmd('sudo python3 ac_int.py listen');
    $output = exec($command);
   // echo $output;
}

function pic(){
    if(!ValidateSession()){echo "No session"; return 0;}
    $command = escapeshellcmd('sudo python3 main.py');
    $output = shell_exec($command);
    return $output;
}

function login_user($email)
{
    $command = escapeshellcmd('sudo python3 dynamo.py ' . $email);
    $output = shell_exec($command);
    return $output;
}


?>