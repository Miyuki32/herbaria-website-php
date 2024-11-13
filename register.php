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

    // Check if the email already exists
    $sql = "SELECT email FROM User_Register WHERE email = ?";
    $emailCheckStmt = mysqli_prepare($conn, $sql); // Use a different variable for the email check
    mysqli_stmt_bind_param($emailCheckStmt, "s", $email);
    mysqli_stmt_execute($emailCheckStmt);
    mysqli_stmt_store_result($emailCheckStmt);

    // Check if the email exists
    if (mysqli_stmt_num_rows($emailCheckStmt) > 0) {
        $message = "This email is already registered. Please use a different email.";
    } else {
        // Handle file upload
        $targetDir = "uploads/"; // Directory where profile pictures will be stored
        $targetFile = $targetDir . basename($_FILES["profilePicture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
        if ($check === false) {
            $message = "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (limit to 2MB)
        if ($_FILES["profilePicture"]["size"] > 2000000) {
            $message = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $message = "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload the file
            if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFile)) {
                // Prepare and execute the SQL statement for user registration
                $sql = "INSERT INTO User_Register (first_name, last_name, email, password, profile_picture) VALUES (?, ?, ?, ?, ?)";
                $registerStmt = mysqli_prepare($conn, $sql); // Use a separate variable for the registration statement
                
                if ($registerStmt) { // Check if statement preparation was successful
                    mysqli_stmt_bind_param($registerStmt, "sssss", $firstName, $lastName, $email, $password, $targetFile);

                    if (mysqli_stmt_execute($registerStmt)) {
                        $message = "User  registered successfully!";
                    } else {
                        $message = "Error registering user: " . mysqli_error($conn);
                    }

                    mysqli_stmt_close($registerStmt); // Close the registration statement after use
                } else {
                    $message = "Failed to prepare SQL statement: " . mysqli_error($conn);
                }
            } else {
                $message = "Sorry, there was an error uploading your file.";
            }
        }
    }

    mysqli_stmt_close($emailCheckStmt); // Close the email check statement
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
            <form action="register.php" method="POST" enctype="multipart/form-data">
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
                <div class="form-group">
                    <label for="profilePicture">Profile Picture:</label>
                    <input type="file" id="profilePicture" name="profilePicture" accept="image/*" required>
                </div>
                <button type="submit" name="register" class="register-button">Confirm</button>
            </form>
            <?php if ($message): ?>
                <input type="checkbox" id="toggle-popup" style="display: none;" checked>
                <div class="popup-overlay">
                    <div class="popup">
                        <label for="toggle-popup" class="close-btn">✖</label>
                        <p><?= htmlspecialchars($message) ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    </section>
    <?php include 'include/footer.inc'; ?>
    <?php include 'include/back_top.inc'; ?>
</body>
</html>