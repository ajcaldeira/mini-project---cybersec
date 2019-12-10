<?php
    session_start();
    include "../model/api.php";
    $topic = $_POST['topic'];
    pub($topic);
    
?>