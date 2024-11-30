<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enquiry Submitted Successfully!</title>
    <meta name="author" content="Ivan Liang Jin Ngu">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" href="./images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<?php
        include 'include/header.inc';
?>

<div class="bg_login">
            <div class="login_content">
                <section class="contribute_process_form_container">
                    <section class="login_intro">
                        <img  class="login_logo" src="./images/logo.png" alt="logo">

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'connection.php';

// Initialize variables for popup messages
$message = "";
$error = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $first_name = mysqli_real_escape_string($conn, $_POST['first-name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last-name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $street_address = mysqli_real_escape_string($conn, $_POST['street-address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone-number']);
    $tutorial = mysqli_real_escape_string($conn, $_POST['tutorial']);

    // Prepare SQL query to insert data
    $sql = "INSERT INTO HW_Enquiry (first_name, last_name, email, street_address, city, state, postcode, phone_number, tutorial) 
            VALUES ('$first_name', '$last_name', '$email', '$street_address', '$city', '$state', '$postcode', '$phone_number', '$tutorial')";

    // Execute the query and set popup messages
    if (mysqli_query($conn, $sql)) {
        $message = "Enquiry submitted successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>
                    <p id="enquiry_process_message"><?php echo $message; ?></p>
                    </section>
                </section>
            </div>
        </div>
        <?php 
            include 'include/footer.inc';
        ?>
</body>
</html>

