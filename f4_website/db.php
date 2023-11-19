<?php
    $host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $dbname = 'f4';

    $conn = mysqli_connect($host, $db_user, $db_pass, $dbname);

    if(!$conn){
        die();
    }
