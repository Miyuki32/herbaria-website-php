<?php
include 'connection.php';

$email = $_GET['email'] ?? '';
$message = '';

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
<html>
<head><title>Verify OTP</title></head>
<body>
    <form action="verify_otp.php?email=<?= urlencode($email) ?>" method="POST">
        <label for="otp">Enter OTP:</label>
        <input type="text" name="otp" required>
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required>
        <button type="submit" name="verify_otp">Verify OTP & Reset Password</button>
    </form>
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
</body>
</html>
