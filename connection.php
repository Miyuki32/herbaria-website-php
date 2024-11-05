<?php
    $severname = "localhost";
    $username = "root";
    $password = "";

    //connection
    $conn = mysqli_connect($severname, $username, $password);

    $sql = "CREATE DATABASE IF NOT EXISTS Herbaria_Database";

    mysqli_query($conn, $sql);
    mysqli_close($conn);

?>