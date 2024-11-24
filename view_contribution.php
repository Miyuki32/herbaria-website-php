<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: index.php");
    exit;
}

include 'connection.php'; // Ensure this file connects to the database

// Fetch all contributions
$sql = "SELECT id, plant_name, scientific_name, family, genus, location, date_collected, description, image1, image2 FROM plant_contributions";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching contributions: " . mysqli_error($conn));
}

// Get total contributions
$totalContributions = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Contributions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/admin.css">
</head>
<body class="admin">
    <div class="sidebar">
        <a href="index.php">
            <img src="./images/logo.png" alt="Herbaria Logo">
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

    <div class="main-content">
        <div class="header">
            <h1>View Contributions</h1>
        </div>

        <!-- Display total contributions -->
        <div class="summary">
            <p><strong>Total Contributions:</strong> <?= $totalContributions ?></p>
        </div>

        <!-- Display contributions in a table -->
        <table class="contribution-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Plant Name</th>
                    <th>Scientific Name</th>
                    <th>Family</th>
                    <th>Genus</th>
                    <th>Location</th>
                    <th>Date Collected</th>
                    <th>Description</th>
                    <th>Image 1</th>
                    <th>Image 2</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($totalContributions > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['plant_name']) ?></td>
                            <td><?= htmlspecialchars($row['scientific_name']) ?></td>
                            <td><?= htmlspecialchars($row['family']) ?></td>
                            <td><?= htmlspecialchars($row['genus']) ?></td>
                            <td><?= htmlspecialchars($row['location']) ?></td>
                            <td><?= htmlspecialchars($row['date_collected']) ?></td>
                            <td><?= htmlspecialchars($row['description']) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($row['image1']) ?>" alt="Image 1" class="image-preview">
                            </td>
                            <td>
                                <img src="<?= htmlspecialchars($row['image2']) ?>" alt="Image 2" class="image-preview">
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" style="text-align: center;">No contributions found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
