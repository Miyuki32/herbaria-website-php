<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // If not logged in or not an admin, redirect to index.php or login page
    echo '<h1>Access Denied</h1>';
    echo '<p>You must be logged in as an admin to access this page.</p>';
    echo '<p>You will be redirected to the homepage in 5 seconds.</p>';
    
    
    // Redirect to the index page
    header("Location: index.php");
    exit; // Stop further execution
}

// If the user is an admin, proceed with the dashboard
echo '<h1>Welcome to the admin dashboard!</h1>';
echo '<p><a href="./view_enquiry.php">View Enquiries </a></p>';
echo '<br>';
echo '<p><a href="./view_contribution.php">View Contributions </a></p>';
echo '<br>';
echo '<p><a href="./index.php">Back to Index</a></p>'
?>