<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: index.php");
    exit; // Stop further execution
}

// Database connection
require 'connection.php'; // Update with your actual database connection script

// Fetch the current date
date_default_timezone_set("Asia/Seoul"); // Time zone
$current_date = date("l, F j, Y");

// Fetch statistics from the database
// Total enquiries
$enquiry_query = "SELECT COUNT(*) AS total_enquiries FROM hw_enquiry";
$enquiry_result = mysqli_query($conn, $enquiry_query);
$total_enquiries = ($enquiry_result && $row = mysqli_fetch_assoc($enquiry_result)) ? $row['total_enquiries'] : 0;

// Total contributions
$contribution_query = "SELECT COUNT(*) AS total_contributions FROM plant_contributions";
$contribution_result = mysqli_query($conn, $contribution_query);
$total_contributions = ($contribution_result && $row = mysqli_fetch_assoc($contribution_result)) ? $row['total_contributions'] : 0;

// Total users
$user_query = "SELECT COUNT(*) AS total_users FROM User_Register";
$user_result = mysqli_query($conn, $user_query);
$total_users = ($user_result && $row = mysqli_fetch_assoc($user_result)) ? $row['total_users'] : 0;

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./style/admin.css">
     
</head>
<body class="admin">
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="index.php">
            <img src="images/logo.png" alt="Logo">
        </a>
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="view_contribution.php">Contribute</a></li>
            <li><a href="view_enquiry.php">Enquiry</a></li>
            <li><a href="manage_user.php">Manage User</a></li>
        </ul>
        <div class="logout">
            <a href="logout.php">Log Out</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
            <div class="welcome">
                Welcome, Admin! <span><?php echo $current_date; ?></span>
            </div>
        </div>
        
        <!-- Dashboard Stats -->
        <div class="stats">
            <a href="./view_enquiry.php">
                <div class="stat-box">
                    <h3>Total Enquiries</h3>
                    <p><?php echo $total_enquiries; ?></p>
                </div>
            </a>
            <a href="./view_contribution.php">
                <div class="stat-box">
                    <h3>Total Contributions</h3>
                    <p><?php echo $total_contributions; ?></p>
                </div>
            </a>
            <a href="./manage_user.php">
                <div class="stat-box">
                    <h3>Total Users</h3>
                    <p><?php echo $total_users; ?></p>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
