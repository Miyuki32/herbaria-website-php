<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    sleep(5);
    header("Location: index.php");
    exit;
}

include 'connection.php';
include 'database.php';

// Initialize variables
$message = "";

// Handle deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $userId = $_POST['user_id'];

    // Delete the user from the database
    $deleteSql = "DELETE FROM User_Register WHERE id = ?";
    $deleteStmt = mysqli_prepare($conn, $deleteSql);
    if ($deleteStmt) {
        mysqli_stmt_bind_param($deleteStmt, "i", $userId);
        if (mysqli_stmt_execute($deleteStmt)) {
            $message = "User deleted successfully.";
        } else {
            $message = "Error deleting user: " . mysqli_error($conn);
        }
        mysqli_stmt_close($deleteStmt);
    } else {
        $message = "Error preparing SQL statement: " . mysqli_error($conn);
    }
}

// Handle user creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_user'])) {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $profilePicture = null; // Assume no picture for simplicity, or handle file upload here

    // Insert the new user into the database
    $insertSql = "INSERT INTO User_Register (first_name, last_name, email, password, profile_picture) VALUES (?, ?, ?, ?, ?)";
    $insertStmt = mysqli_prepare($conn, $insertSql);

    if ($insertStmt) {
        mysqli_stmt_bind_param($insertStmt, "sssss", $firstName, $lastName, $email, $password, $profilePicture);
        if (mysqli_stmt_execute($insertStmt)) {
            $message = "User created successfully.";
        } else {
            $message = "Error creating user: " . mysqli_error($conn);
        }
        mysqli_stmt_close($insertStmt);
    } else {
        $message = "Error preparing SQL statement: " . mysqli_error($conn);
    }
}

// Fetch all users
$sql = "SELECT id, first_name, last_name, email, profile_picture FROM User_Register";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching users: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
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
            <h1>Manage Users</h1>
        </div>
        <div class="create-user-form">
            <h2>Create New User</h2>
            <form action="manage_user.php" method="POST">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" required>

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <button type="submit" name="create_user">Create User</button>
            </form>
        </div>
        <div class="popup-overlay <?= $message ? 'active' : '' ?>"></div>
        <div class="popup <?= $message ? 'active' : '' ?>">
            <p><?= htmlspecialchars($message) ?></p>
            <form action="manage_user.php" method="GET">
                <button type="submit">Close</button>
            </form>
        </div>

        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Profile Picture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['first_name']) ?></td>
                            <td><?= htmlspecialchars($row['last_name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td>
                                <?php if ($row['profile_picture']): ?>
                                    <img src="<?= htmlspecialchars($row['profile_picture']) ?>" alt="Profile Picture" class="profile-img">
                                <?php else: ?>
                                    No Image
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="manage_user.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($row['id']) ?>">
                                    <button type="submit" name="delete" class="delete-button">Delete</button>
                                </form>
                                <a href="edit_user.php?id=<?= htmlspecialchars($row['id']) ?>" class="edit-button">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No users found.</td>
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
