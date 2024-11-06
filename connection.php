<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS Herbaria_Database";
if (mysqli_query($conn, $sql)) {
    // Select the database
    mysqli_select_db($conn, "Herbaria_Database");
} else {
    die("Error creating database: " . mysqli_error($conn));
}

// Return the connection object
return $conn;
?>