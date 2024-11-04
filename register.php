<?php
include 'connection.php'; // This should be the connection file that connects to the Herbaria_Database
include 'database.php';

// Initialize a variable to hold the message
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['pwd']), PASSWORD_DEFAULT); // Hash the password for security

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO User_Register (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        $message = "User  registered successfully!";
    } else {
        $message = "Error registering user: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

// Close the connection at the end of your script
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="author" content="Neng Yi Chieng">
    <meta name="keywords" content="register, Herbarium, account">
    <meta name="description" content="Registration page of Herbaria account.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" href="./images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="register-body">
    <?php include 'include/header.inc'; ?>
    <section class="register-container">
        <section class="register-form">
            <h1>Register</h1>
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" placeholder="JACK" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" placeholder="PIRATE" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="example@example.com" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" id="pwd" name="pwd" required>
                </div>
                <button type="submit" name="register" class="register-button">Confirm</button>
            </form>

            <?php if ($message): ?>
                <div class="alert">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
        </section>
    </section>
    <?php include 'include/footer.inc'; ?>
    <?php include 'include/back_top.inc'; ?>
</body>
</html>