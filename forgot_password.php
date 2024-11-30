<?php
session_start();
include 'connection.php';
require_once 'vendor/autoload.php'; // Include Composer's autoloader for SwiftMailer and Dotenv

// Redirect logged-in users to the login page
if (isset($_SESSION['user_id'])) { // Replace 'user_id' with the key you use to store the logged-in user's ID
    header("Location: user_profile.php"); // Change 'login.php' to the desired redirect page
    exit;
}

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');
$dotenv->load();

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

        // Set up SwiftMailer using environment variables
        $transport = (new Swift_SmtpTransport($_ENV['SMTP_HOST'], $_ENV['SMTP_PORT'], $_ENV['SMTP_ENCRYPTION']))
            ->setUsername($_ENV['SMTP_USERNAME'])  // Gmail email from .env
            ->setPassword($_ENV['SMTP_PASSWORD']); // Gmail password from .env

        $mailer = new Swift_Mailer($transport);

        // Create the email message
        $subject = "Password Reset OTP";
        $messageBody = "Your OTP for password reset is: $otp. It expires in 5 minutes.";

        $message = (new Swift_Message($subject))
            ->setFrom([$_ENV['SMTP_USERNAME'] => 'Herbaria Website'])
            ->setTo([$email])
            ->setBody($messageBody);

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
<head>
<meta charset="UTF-8">
        <title>Forgot Password</title>
        <meta name="author" content="Elijah & Ivan">
        <meta name="keywords" content="Frogot, Password">
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
                    <form action="forgot_password.php" method="POST">
                        <div class="form-group">
                            <label for="email">Enter your email to receive OTP:</label>
                            <input type="email" name="email" required>
                            <button type="submit" name="send_otp" class="submit-button">Send OTP</button>
                        </div>
                    </form>
                </section>
            </section>
        </div>
    </div>
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <?php include 'include/footer.inc'; ?>
</body>
</html>
