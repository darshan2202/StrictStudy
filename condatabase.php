<?php
    $servername = "localhost";
    $username = "id20217719_root";
    $password = "Miniphosting_123";
    $database = "id20217719_login";
    $conn = mysqli_connect($servername,$username,$password,$database);
    if(!$conn){
        die("Error". mysqli_connect_error());
    }
?>