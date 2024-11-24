<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: index.php");
    exit;
}

// Database connection
require 'include/db_connect.php'; // Update with your actual database connection script

// Check if an ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the enquiry from the database
    $query = "DELETE FROM enquiries WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: view_enquiry.php");
        exit;
    } else {
        echo "Error deleting enquiry.";
    }
} else {
    header("Location: view_enquiry.php");
    exit;
}
?>
