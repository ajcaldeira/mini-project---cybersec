<?php

function ValidateSession(){
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        return true;
    }
    else{
        return false; //user is not logged in
    }
}

function sub($topic){
    if(!ValidateSession()){echo "No session"; return 0;}
    $topic = htmlspecialchars($topic);
    $topic = stripcslashes($topic);
    $command = escapeshellcmd('sudo python3 ../controller/subscribe.py ' . htmlspecialchars($topic) . ' sub');
    exec($command . ' > /dev/null 2>/dev/null &');
}

function pub($topic){
    if(!ValidateSession()){echo "No session"; return 0;}
    $topic = htmlspecialchars($topic);
    $topic = stripcslashes($topic);
    $command = escapeshellcmd('sudo python3 ../controller/publisher.py ' . htmlspecialchars($topic));
    $output = shell_exec($command);
    return $output;
}

function alarmoff(){
    if(!ValidateSession()){echo "No session"; return 0;}
    $command = escapeshellcmd('sudo python3 ../controller/ac_int.py listen ' . htmlspecialchars($topic));
    exec($command);
   
}

function alarmon(){
    if(!ValidateSession()){echo "No session"; return 0;}
    $command = escapeshellcmd('sudo python3 ../controller/ac_int.py listen ' . htmlspecialchars($topic));
    exec($command . ' > /dev/null 2>/dev/null &');
}

function pic(){
    if(!ValidateSession()){echo "No session"; return 0;}
    //take the pic
    $command = escapeshellcmd('sudo python3 ../controller/main.py');
    $output = shell_exec($command);
    //upload to s3 bucket
    //echo $output;
    $url = uploadToS3($output);
    removeLocalImage($output);
    echo $url;
}

function login_user($email)
{
    $command = escapeshellcmd('sudo python3 ../controller/dynamo.py ' . htmlspecialchars($email));
    $output = shell_exec($command);
    return $output;
}

function uploadToS3($filename){
    $command = escapeshellcmd("sudo python3 ../controller/uploads3.py " . htmlspecialchars($filename));
    $output = shell_exec($command);
    return $output;
}
function removeLocalImage($filename){
    $command = escapeshellcmd("sudo rm ../" . htmlspecialchars($filename));
    $output = exec($command);
}
?>