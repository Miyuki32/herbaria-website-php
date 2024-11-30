<?php
session_start();
include 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Assume user ID is stored in session
$is_admin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;

$message = ""; // Message for feedback

// Handle change password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($is_admin) {
        $sql = "SELECT password FROM admin WHERE id = ?";
    } else {
        $sql = "SELECT password FROM User_Register WHERE id = ?";
    }

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($current_password, $row['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                if ($is_admin) {
                    $update_sql = "UPDATE admin SET password = ? WHERE id = ?";
                } else {
                    $update_sql = "UPDATE User_Register SET password = ? WHERE id = ?";
                }

                $update_stmt = mysqli_prepare($conn, $update_sql);
                mysqli_stmt_bind_param($update_stmt, "si", $hashed_password, $user_id);

                if (mysqli_stmt_execute($update_stmt)) {
                    session_destroy();
                    header("Location: login.php"); // Redirect to login page
                    exit();
                } else {
                    $message = "Error updating password. Please try again.";
                }

                mysqli_stmt_close($update_stmt);
            } else {
                $message = "New password and confirmation do not match.";
            }
        } else {
            $message = "Current password is incorrect.";
        }
    }

    mysqli_stmt_close($stmt);
}

// Handle profile picture update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_picture'])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["newProfilePicture"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validate image file
    if (getimagesize($_FILES["newProfilePicture"]["tmp_name"]) && in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        if (move_uploaded_file($_FILES["newProfilePicture"]["tmp_name"], $targetFile)) {
            $sql = "UPDATE User_Register SET profile_picture = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "si", $targetFile, $user_id);
            mysqli_stmt_execute($stmt);

            $message = "Profile picture updated successfully!";
        } else {
            $message = "Error uploading profile picture.";
        }
    } else {
        $message = "Invalid file type.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <meta name="author" content="Elijah">
    <meta name="keywords" content="User Profile">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" href="./images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">  
</head>
<body>
    <?php include 'include/header.inc'; ?>
    <div class="bg_login">
        <div class="login_content">
            <section class="login_form_container">
                <img class="login_logo" src="./images/logo.png" alt="logo">
                <section class="login_intro">
                    <h1>Manage Your Profile</h1>

                    <!-- Change Password Form -->
                    <form action="" method="POST">
                        <fieldset>
                            <legend>Change Password</legend>
                            <label for="pass">Current password:</label>
                            <input type="password" id="pass" name="current_password" required>
                            <label for="newpwd">New password:</label>
                            <input type="password" id="newpwd" name="new_password" required>
                            <label for="conpwd">Confirm password:</label>
                            <input type="password" id="conpwd" name="confirm_password" required>
                            <button type="submit" class="submit-button" name="change_password">Confirm</button>
                        </fieldset>
                    </form>

                    <!-- Update Profile Picture Form -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Update Profile Picture</legend>
                            <label for="newProfilePicture">Select new profile picture:</label>
                            <input type="file" name="newProfilePicture" required>
                            <button type="submit" name="update_picture" class="submit-button">Update Profile Picture</button>
                        </fieldset>
                    </form>

                    <!-- Feedback Message -->
                    <?php if ($message): ?>
                        <div class="alert"><?= htmlspecialchars($message) ?></div>
                    <?php endif; ?>
                    <br>
                    <!-- Link to Logout or Other Options -->
                    <div class="logout_button_container">
                        <a href="logout.php"><button class="button">Logout</button></a>
                    </div>
                </section>
            </section>
        </div>
    </div>
    <?php include 'include/footer.inc'; ?>
</body>
</html>