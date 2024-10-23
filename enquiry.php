<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Enquiry</title>
        <meta name="author" content="Jack">
        <meta name="keywords" content="Enquiry, Herbarium">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/style.css">
        <link rel="icon" href="./images/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
        <title>Enquiry Form</title>
    </head>
    <body id="enquiry_body">
        <?php
            include 'include/header.inc';
        ?>
        <section class="enquiry-container">
            <h1>Enquiry Form</h1>
            <form action="/submit-enquiry" method="POST">

            <label for="first-name">First Name</label>
            <input type="text" id="first-name" name="first-name" maxlength="25" pattern="[A-Za-z]+" required placeholder="Enter your first name">

            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" name="last-name" maxlength="25" pattern="[A-Za-z]+" required placeholder="Enter your last name">

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email address">

            <fieldset>
                <legend>Address</legend>

                <label for="street-address">Street Address</label>
                <input type="text" id="street-address" name="street-address" maxlength="40" required placeholder="Enter your street address">

                <label for="city">City/Town</label>
                <input type="text" id="city" name="city" maxlength="20" required placeholder="Enter your city/town">

                <label for="state">State</label>
                <select id="state" name="state" required>
                    <option value="" disabled selected>Select your state</option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Labuan">Labuan</option>
                    <option value="Malacca">Malacca</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Penang">Penang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Putrajaya">Putrajaya</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                </select>

                <label for="postcode">Postcode</label>
                <input type="text" id="postcode" name="postcode" pattern="\d{5}" required placeholder="e.g. 12345">
            </fieldset>

            <label for="phone-number">Phone Number</label>
            <input type="tel" id="phone-number" name="phone-number" maxlength="10" pattern="\d{10}" required placeholder="e.g. 0123456789">

            <label for="tutorial">Tutorial</label>
            <select id="tutorial" name="tutorial" required>
                <option value="" disabled selected>Select a tutorial</option>
                <option value="Herbarium Specimen">Herbarium Specimen</option>
                <option value="Plant Classification">Plant Classification</option>
                <option value="Botanical Illustration">Botanical Illustration</option>
            </select>

            <input type="submit" value="Submit Enquiry">
            </form>
        </section>
        <?php
            include 'include/footer.inc';
            include 'include/back_top.inc';
        ?>
    </body>
    </html>
    
