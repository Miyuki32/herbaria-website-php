<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: index.php");
    exit;
}

// Database connection
require 'connection.php';

// Fetch all enquiries from the database
$query = "SELECT * FROM hw_enquiry ORDER BY created_at DESC";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    // Set headers for Excel export
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=enquiries.xls");

    // Output column headers
    echo "ID\tFirst Name\tLast Name\tEmail\tAddress\tPhone\tTutorial\tSubmitted At\n";

    // Output rows
    while ($row = $result->fetch_assoc()) {
        $address = $row['street_address'] . ', ' . $row['city'] . ', ' . $row['state'] . ', ' . $row['postcode'];
        echo $row['id'] . "\t" .
             $row['first_name'] . "\t" .
             $row['last_name'] . "\t" .
             $row['email'] . "\t" .
             $address . "\t" .
             $row['phone_number'] . "\t" .
             $row['tutorial'] . "\t" .
             $row['created_at'] . "\n";
    }
} else {
    echo "No data to export.";
}
?>