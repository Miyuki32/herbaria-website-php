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
        <?php
            include 'include/header.inc';
        ?>

        <section class="register-container">
            <section class="register-form">
                <h1>Register</h1>
                <form>
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
                    <button type="submit" class="register-button">Confrim</button>
                </form>
            </section>
        </section>
        <?php
            include 'include/footer.inc';
            include 'include/back_top.inc';
        ?>
    </body>
</html>
