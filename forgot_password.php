<?php
include 'connection.php';
require_once 'vendor/autoload.php'; // Include the SwiftMailer autoloader

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_otp'])) {
    $email = trim($_POST['email']);

    // Check if the email exists in the database
    $sql = "SELECT id FROM User_Register WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        // Generate OTP and expiration time (e.g., 5 minutes from now)
        $otp = rand(100000, 999999);
        $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

        // Store OTP and expiry in the database
        $sql = "UPDATE User_Register SET otp = ?, otp_expiry = ? WHERE email = ?";
        $updateStmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($updateStmt, "sss", $otp, $expiry, $email);
        mysqli_stmt_execute($updateStmt);

        // Set up SwiftMailer
        // Use SSL and port 465
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
        ->setUsername('ivanngu08@gmail.com')  // Your Gmail email
        ->setPassword('xwts xcbg lpsw qoot'); // Your Gmail password (use App password if 2FA enabled)

        // Create the mailer using the transport configuration
        $mailer = new Swift_Mailer($transport);

        // Create the message
        $subject = "Password Reset OTP";
        $messageBody = "Your OTP for password reset is: $otp. It expires in 5 minutes.";

        $message = (new Swift_Message($subject))
            ->setFrom(['ivanngu08@gmail.com' => 'Herbaria Website'])  // Your email
            ->setTo([$email])                                    // Recipient email
            ->setBody($messageBody);                             // Email content

        // Send the email
        try {
            $mailer->send($message);
            header("Location: verify_otp.php?email=" . urlencode($email));
            exit;
        } catch (Exception $e) {
            $message = "Failed to send OTP email. Error: " . $e->getMessage();
        }
    } else {
        $message = "Email not found.";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head><title>Forgot Password</title></head>
<body>
    <form action="forgot_password.php" method="POST">
        <label for="email">Enter your email to receive OTP:</label>
        <input type="email" name="email" required>
        <button type="submit" name="send_otp">Send OTP</button>
    </form>
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
</body>
</html>
