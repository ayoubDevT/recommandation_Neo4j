<?php


    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'ecom';

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo 'Connection Error ' . $conn->connect_error;
    }
    

?>