<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'database.php';
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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $first_name = mysqli_real_escape_string($conn, $_POST['first-name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last-name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $street_address = mysqli_real_escape_string($conn, $_POST['street-address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone-number']);
    $tutorial = mysqli_real_escape_string($conn, $_POST['tutorial']);

    // Prepare SQL query to insert data
    $sql = "INSERT INTO HW_Enquiry (first_name, last_name, email, street_address, city, state, postcode, phone_number, tutorial) 
            VALUES ('$first_name', '$last_name', '$email', '$street_address', '$city', '$state', '$postcode', '$phone_number', '$tutorial')";

    // Execute the query and check for errors
    if (mysqli_query($conn, $sql)) {
        echo "Enquiry submitted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>