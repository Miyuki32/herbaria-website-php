<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash the password
    $role = $_POST['role'];

    $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $username, $email, $password, $role);

    if ($stmt->execute()) {
        header('Location: manage_user.php?success=1'); // Redirect back to manage users page
        exit();
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/admin.css">
    <title>Add New User</title>
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
            <h1>Add New User</h1>
        </div>
        <form action="add_user.php" method="POST" class="form-container">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" class="button">Add User</button>
        </form>
    </div>
</body>
</html>
