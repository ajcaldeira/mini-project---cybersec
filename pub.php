<?php
    session_start();
    include "api.php";
    $topic = $_POST['topic'];
    pub($topic);
    
?>