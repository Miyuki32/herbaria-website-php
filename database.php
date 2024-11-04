<?php

include 'connection.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Herbaria_Database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to create the HW_Enquiry table if it doesn't exist
function createEnquiryTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS HW_Enquiry (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(25) NOT NULL,
        last_name VARCHAR(25) NOT NULL,
        email VARCHAR(100) NOT NULL,
        street_address VARCHAR(40) NOT NULL,
        city VARCHAR(20) NOT NULL,
        state VARCHAR(50) NOT NULL,
        postcode VARCHAR(10) NOT NULL,
        phone_number VARCHAR(15) NOT NULL,
        tutorial VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Table HW_Enquiry created successfully.<br>";
    } else {
        echo "Error creating table HW_Enquiry: " . mysqli_error($conn) . "<br>";
    }
}

// Function to create the Plant_Contributions table if it doesn't exist
function createPlantContributionsTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS Plant_Contributions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        plant_name VARCHAR(255) NOT NULL,
        scientific_name VARCHAR(255) NOT NULL,
        family VARCHAR(255),
        genus VARCHAR(255),
        location ENUM('east_malaysia', 'west_malaysia', 'other'),
        date_collected DATE,
        description TEXT,
        image1 VARCHAR(255),
        image2 VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Table Plant_Contributions created successfully.<br>";
    } else {
        echo "Error creating table Plant_Contributions: " . mysqli_error($conn) . "<br>";
    }
}

// Call the functions to create the tables
createEnquiryTable($conn);
createPlantContributionsTable($conn);

// Close the connection
mysqli_close($conn);
?>