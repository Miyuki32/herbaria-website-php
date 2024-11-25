<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="CWA Help Desk Appointment Form">
        <meta name="keywords" content="Help Desk, Appointment, Form">
        <meta name="author" content="Neng Yi Chieng">
        <title>Contribute</title>
        <link rel="stylesheet" href="./style/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <body id="contribute_body">
        <?php
            include 'include/header.inc';
        ?>
          <!-- Contribute Content -->
          <div class="bg_contribute">
            <div class="contribute-content">
                <section class="contribute-form-container">
                    <section class="contribute-intro">
                        <h1>Contribute to Our Herbarium</h1>
                        <p>Help us grow our collection by sharing your plant discoveries. Your contribution is valuable in expanding our botanical knowledge.</p>
                    </section>
                    <h2>Plant Contribution Form</h2>
                    <form class="contribute-form" action="contribute_process.php" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="plantName">Plant Name</label>
                                <input type="text" id="plantName" name="plantName" required>
                            </div>
                            <div class="form-group">
                                <label for="scientificName">Scientific Name</label>
                                <input type="text" id="scientificName" name="scientificName" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="family">Family</label>
                                <select name="family" id="family">
                                    <option value="Dipterocarpaceae">Dipterocarpaceae</option>
                                    <option value="Lauraceae">Lauraceae</option>
                                    <option value="Burseraceae">Burseraceae</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="genus">Genus</label>
                                <select name="genus" id="genus">
                                    <option value="Vatica">Vatica</option>
                                    <option value="Dipterocarpus">Dipterocarpus</option>
                                    <option value="Hopea">Hopea</option>
                                    <option value="Actinodaphne">Actinodaphne</option>
                                    <option value="Endiandra">Endiandra</option>
                                    <option value="Beilschmiedia">Beilschmiedia</option>
                                    <option value="Canarium">Canarium</option>
                                    <option value="Dacryodes">Dacryodes</option>
                                    <option value="Santiria">Santiria</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <p>Collection Location</p>
                                <div class="radio-group">
                                    <input type="radio" id="eastmalaysia" name="location" value="east_malaysia" required>
                                    <label for="eastmalaysia">East Malaysia</label>
                                    <input type="radio" id="westmalaysia" name="location" value="west_malaysia" required>
                                    <label for="westmalaysia">West Malaysia</label>
                                    <input type="radio" id="other" name="location" value="other" required>
                                    <label for="other">Other country</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date">Date Collected</label>
                                <input type="date" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Plant Description</label>
                            <textarea id="description" name="description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image1">Upload Image 1</label>
                            <input type="file" id="image1" name="image1" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="image2">Upload Image 2</label>
                            <input type="file" id="image2" name="image2" accept="image/*" required>
                        </div>
                        <p class="upload-instructions">
                            Please upload clear, high-resolution images of the plant. 
                            Accepted formats: JPG, PNG, GIF. Maximum file size: 5MB per image.
                        </p>
                        <button type="submit" class="submit-button">Submit Contribution</button>
                    </form>
                </section>
            </div>
        </div>
        <?php
            include 'include/footer.inc';
            include 'include/back_top.inc';
        ?>
    </body>
</html>
    
