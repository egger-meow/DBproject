<?php
    
    $dbservername='localhost';
    $dbname='acdb';
    $dbusername='jonhou1203';
    $dbpassword='pass9704';
    $conn = new PDO("mysql:host=$dbservername; dbname=$dbname", $dbusername, $dbpassword);
    # set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
?>
