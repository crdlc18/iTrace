<?php
/*--------------DATABASE CONNECTION----------------*/
    
    session_start();
    
    define('LOCALHOST','localhost:3306');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','itracedb');

    $conn = new mysqli(LOCALHOST, DB_USERNAME , DB_PASSWORD, DB_NAME)
    or die("Error" . mysqli_error($conn));
?>