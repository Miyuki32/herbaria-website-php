<?php
$conn = include 'connection.php';

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
        profile_picture VARCHAR(255), 
        otp VARCHAR(6), -- Column to store OTP
        otp_expiry DATETIME -- Column to store OTP expiry time
    )";
    if (!mysqli_query($conn, $sql)) {
        die("Error creating User_Register table: " . mysqli_error($conn));
    }
}

// Function to create the admin table if it doesn't exist
function createAdminTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS admin (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        profile_picture VARCHAR(255) -- Add profile_picture column here
    )";
    if (!mysqli_query($conn, $sql)) {
        echo "Error creating admin table: " . mysqli_error($conn) . "<br>";
    }
}

// Call the functions to create the tables
createEnquiryTable($conn);
createPlantContributionsTable($conn);
createUserRegistrationsTable($conn);
createAdminTable($conn);

// Insert default admin credentials if the table is empty
$result = mysqli_query($conn, "SELECT * FROM admin");
if (mysqli_num_rows($result) == 0) {
    $default_username = 'Admin';
    $default_password = password_hash('Admin', PASSWORD_DEFAULT); // Hash the password
    $default_profile_picture = './images/logo.png'; // Set default profile picture path
    $sql = "INSERT INTO admin (username, password, profile_picture) VALUES ('$default_username', '$default_password', '$default_profile_picture')";
    if (!mysqli_query($conn, $sql)) {
        echo "Error inserting default admin: " . mysqli_error($conn) . "<br>";
    }
}

// Function to set OTP for a user
function setOTP($conn, $email, $otp, $expiry) {
    $sql = "UPDATE User_Register SET otp = ?, otp_expiry = ? WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $otp, $expiry, $email);
    return mysqli_stmt_execute($stmt);
}

// Function to verify OTP for a user
function verifyOTP($conn, $email, $otp) {
    // Prepare and execute the statement
    $sql = "SELECT otp, otp_expiry FROM User_Register WHERE email = ? AND otp = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $otp);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $storedOtp, $expiry);

    // Check if the statement fetches a valid result
    $isValid = false;
    if (mysqli_stmt_fetch($stmt)) {
        $isValid = (strtotime($expiry) > time()); // Check if OTP is valid and not expired
    }

    // Free the result and close the statement to avoid "Commands out of sync" error
    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);

    return $isValid;
}

// Function to update profile picture
function updateProfilePicture($conn, $email, $profilePicturePath) {
    $sql = "UPDATE User_Register SET profile_picture = ? WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $profilePicturePath, $email);
    return mysqli_stmt_execute($stmt);
}

?>
