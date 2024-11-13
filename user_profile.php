<?php
include 'connection.php';

session_start();
$userId = $_SESSION['user_id']; // Assume user ID is stored in session
$message = '';

// Handle profile picture update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_picture'])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["newProfilePicture"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Basic file validation
    if (getimagesize($_FILES["newProfilePicture"]["tmp_name"]) && in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        if (move_uploaded_file($_FILES["newProfilePicture"]["tmp_name"], $targetFile)) {
            // Update profile picture path in database
            $sql = "UPDATE User_Register SET profile_picture = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "si", $targetFile, $userId);
            mysqli_stmt_execute($stmt);
            
            $message = "Profile picture updated successfully!";
        } else {
            $message = "Error uploading profile picture.";
        }
    } else {
        $message = "Invalid file type.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Update Profile Picture</title></head>
<body>
    <form action="profile.php" method="POST" enctype="multipart/form-data">
        <label for="newProfilePicture">Select new profile picture:</label>
        <input type="file" name="newProfilePicture" required>
        <button type="submit" name="update_picture">Update Profile Picture</button>
    </form>
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
</body>
</html>
