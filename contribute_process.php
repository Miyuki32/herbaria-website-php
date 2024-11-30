<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contribute Submitted Successfully</title>
    <meta name="author" content="Elijah">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" href="./images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<?php
        include 'include/header.inc';
?>

<div class="bg_login">
            <div class="login_content">
                <section class="contribute_process_form_container">
                    <section class="login_intro">
                        <img  class="login_logo" src="./images/logo.png" alt="logo">

<?php
session_start(); // Start the session


// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php"); // Redirect to the login page
    exit();
}

include 'database.php';
require 'connection.php';

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $plantName = mysqli_real_escape_string($conn, $_POST['plantName']);
    $scientificName = mysqli_real_escape_string($conn, $_POST['scientificName']);
    $family = mysqli_real_escape_string($conn, $_POST['family']);
    $genus = mysqli_real_escape_string($conn, $_POST['genus']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Handle file uploads
    $image1 = $_FILES['image1'];
    $image2 = $_FILES['image2'];

    // Validate and move uploaded files
    $targetDir = "uploads/";
    $image1Path = $targetDir . basename($image1["name"]);
    $image2Path = $targetDir . basename($image2["name"]);

    // Check file types and sizes, then move files
    if (move_uploaded_file($image1["tmp_name"], $image1Path) && move_uploaded_file($image2["tmp_name"], $image2Path)) {
        // Prepare SQL query to insert data
        $sql = "INSERT INTO Plant_Contributions (plant_name, scientific_name, family, genus, location, date_collected, description, image1, image2) 
                VALUES ('$plantName', '$scientificName', '$family', '$genus', '$location', '$date', '$description', '$image1Path', '$image2Path')";

        if (mysqli_query($conn, $sql)) {
            echo "Contribution submitted successfully. Your contributions will be reviewed by the admins. Thank you for providing more info for the website.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading images.";
    }
}

// Close the connection
mysqli_close($conn);
?>
   
                    </section>
                </section>
            </div>
        </div>
        <?php 
            include 'include/footer.inc';
        ?>
</body>
</html>