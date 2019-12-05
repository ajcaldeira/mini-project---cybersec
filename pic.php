<?php
    $command = escapeshellcmd('sudo python3 main.py');
    $output = exec($command);
    echo $output;
?>