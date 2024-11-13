<?php
session_start(); // Start the session
include 'connection.php'; // Include your database connection

$message = ""; // Initialize a variable to hold the message

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['pwd'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['pwd']);

    // Check if the input is an admin login (username)
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Admin login
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['is_admin'] = true; // Set is_admin to true for admin users
            $_SESSION['logged_in'] = true; // Set logged_in to true for admin
            header("Location: admin_dashboard.php"); // Redirect to admin area
            exit();
        } else {
            $message = "Invalid password for admin.";
        }
    } else {
        // Check if it's a user login (email)
        $sql = "SELECT * FROM User_Register WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // User login
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['profile_picture'] = $row['profile_picture'];
                $_SESSION['logged_in'] = true; // Set logged_in to true for regular users
                header("Location: index.php"); // Redirect to user area
                exit();
            } else {
                $message = "Invalid password for user.";
            }
        } else {
            $message = "No user found with that email.";
        }
    }

    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <h1>Login</h1>
    <?php if ($message): ?>
        <div class="alert">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <label for="email">Email / Username:</label>
        <input type="text" id="email" name="email" required>
        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd" required>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register now.</a></p>
</body>
</html>