<?php
session_start(); // Start the session


// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php"); // Redirect to the login page
    exit();
}

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
            echo "Contribution submitted successfully.";
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