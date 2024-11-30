<?php
session_start();
include 'connection.php';

// Redirect logged-in users to the login page
if (isset($_SESSION['user_id'])) { // Replace 'user_id' with the key you use to store the logged-in user's ID
    header("Location: user_profile.php"); // Change 'login.php' to the desired redirect page
    exit;
}


// Initialize $message to an empty string to prevent undefined variable warning
$message = '';

$email = $_GET['email'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify_otp'])) {
    $enteredOtp = trim($_POST['otp']);
    $newPassword = password_hash(trim($_POST['new_password']), PASSWORD_DEFAULT);

    // Retrieve OTP and expiration time from the database
    $sql = "SELECT otp, otp_expiry FROM User_Register WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $otp, $expiry);
        mysqli_stmt_fetch($stmt);
        
        // Free result to avoid "Commands out of sync" error
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        
        if ($otp == $enteredOtp && strtotime($expiry) > time()) {
            // OTP is valid, update password
            $sql = "UPDATE User_Register SET password = ?, otp = NULL, otp_expiry = NULL WHERE email = ?";
            $updateStmt = mysqli_prepare($conn, $sql);
            
            if ($updateStmt) {
                mysqli_stmt_bind_param($updateStmt, "ss", $newPassword, $email);
                if (mysqli_stmt_execute($updateStmt)) {
                    $message = "Password reset successful.";
                } else {
                    $message = "Error updating password: " . mysqli_error($conn);
                }
                mysqli_stmt_close($updateStmt);
            } else {
                $message = "Failed to prepare update statement: " . mysqli_error($conn);
            }
        } else {
            $message = "Invalid or expired OTP.";
        }
    } else {
        $message = "Failed to prepare statement: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <meta name="author" content="Elijah & Ivan">
    <meta name="keywords" content="Verify OTP">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" href="./images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
</head>
<body id="otp-body">
    <?php include './include/header.inc'; ?>
    <div class="otp-container">
        <div class="otp-header">
            <img src="./images/logo.png" alt="logo" class="login_logo">
            <h2>Verify OTP</h2>
            <p>Please enter the One-Time Password sent to your email</p>
            <p>Please check your junk/spam mail if you don't see the email in your inbox</p>
        </div>
        
        <form action="verify_otp.php?email=<?= urlencode($email) ?>" method="POST">
            <div class="form-group">
                <label for="otp" class="form-label">Enter OTP</label>
                <input type="text" class="form-control" id="otp" name="otp" required placeholder="Enter 6-digit OTP">
            </div>
            
            <div class="form-group">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required placeholder="Enter new password">
            </div>
            
            <button type="submit" class="button" name="verify_otp">
               Reset Password
            </button>
        </form>
        
        <?php if ($message): ?>
            <div class="message <?= strpos($message, 'successful') !== false ? 'success-message' : 'error-message' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
    </div>
    <div>
        <?php include './include/footer.inc'; ?>
    </div>
</body>
</html>