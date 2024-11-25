<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: index.php");
    exit;
}

include 'connection.php'; // Ensure this connects to your database

// Fetch all contributions
$sql = "SELECT id, plant_name, scientific_name, family, genus, location, date_collected, description, image1, image2 FROM plant_contributions";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching contributions: " . mysqli_error($conn));
}

// Set headers for the Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=contributions.xls");

// Output column headers
echo "ID\tPlant Name\tScientific Name\tFamily\tGenus\tLocation\tDate Collected\tDescription\t Image 1 Location\tImage 2 Location\n";

// Output rows
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['id'] . "\t" .
         $row['plant_name'] . "\t" .
         $row['scientific_name'] . "\t" .
         $row['family'] . "\t" .
         $row['genus'] . "\t" .
         $row['location'] . "\t" .
         $row['date_collected'] . "\t" .
         $row['description'] . "\t" .
         $row['image1'] . "\t" . // Include image1 path
         $row['image2'] . "\n";  // Include image2 path
}

// Close the database connection
mysqli_close($conn);
?>
