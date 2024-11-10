<?php
$conn = include 'connection.php'; // This should connect to the Herbaria_Database

// Check if the connection was successful
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

    if (!mysqli_query($conn, $sql)) {
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

    if (!mysqli_query($conn, $sql)) {
        echo "Error creating table Plant_Contributions: " . mysqli_error($conn) . "<br>";
    }
}

// Function to create the User_Register table if it doesn't exist
function createUserRegistrationsTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS User_Register (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        profile_picture VARCHAR(255)  -- Profile picture column
    )";

    if (!mysqli_query($conn, $sql)) {
        die("Error creating table: " . mysqli_error($conn));
    }
}

// Function to add the profile_picture column if it doesn't exist
function addProfilePictureColumn($conn) {
    $result = mysqli_query($conn, "SHOW COLUMNS FROM User_Register LIKE 'profile_picture'");
    if (mysqli_num_rows($result) == 0) {
        $sql = "ALTER TABLE User_Register ADD profile_picture VARCHAR(255)";
        if (!mysqli_query($conn, $sql)) {
            die("Error altering table: " . mysqli_error($conn));
        }
    }
}

function createAdminTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS admin (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )";

    if (!mysqli_query($conn, $sql)) {
        echo "Error creating table admin: " . mysqli_error($conn) . "<br>";
    }
}

// Call the functions to create the tables
createEnquiryTable($conn);
createPlantContributionsTable($conn);
createUserRegistrationsTable($conn);
addProfilePictureColumn($conn);
createAdminTable($conn);

//Insert default admin credentials if the table is empty
$result = mysqli_query($conn, "SELECT * FROM admin");
if (mysqli_num_rows($result) == 0) {
    $default_username = 'Admin';
    $default_password = password_hash('Admin', PASSWORD_DEFAULT); // Hash the password
    $sql = "INSERT INTO admin (username, password) VALUES ('$default_username', '$default_password')";
    if (!mysqli_query($conn, $sql)) {
        echo "Error inserting default admin: " . mysqli_error($conn) . "<br>";
    }
}

?>