<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: index.php");
    exit;
}

// Database connection
require 'connection.php'; // Update with your actual database connection script

// Fetch enquiries from the database
$query = "SELECT * FROM hw_enquiry ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Enquiries</title>
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
            <li><a href="admin_dashboard.php">Dashboard</a></li>
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
            <h1>Submitted Enquiries</h1>
        </div>

        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Tutorial</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= htmlspecialchars($row['first_name']); ?></td>
                            <td><?= htmlspecialchars($row['last_name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td>
                                <?= htmlspecialchars($row['street_address']); ?>, 
                                <?= htmlspecialchars($row['city']); ?>, 
                                <?= htmlspecialchars($row['state']); ?>, 
                                <?= htmlspecialchars($row['postcode']); ?>
                            </td>
                            <td><?= htmlspecialchars($row['phone_number']); ?></td>
                            <td><?= htmlspecialchars($row['tutorial']); ?></td>
                            <td><?= htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No enquiries found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
