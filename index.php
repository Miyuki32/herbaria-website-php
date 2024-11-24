<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>Main</title>
        <meta name="author" content="Ivan Liang Jin Ngu">
        <meta name="keywords" content="Main, Herbarium">
        <meta name="description" content="Main page of Herbaria">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/style.css">
        <link rel="icon" href="./images/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div id="top"></div>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <a href="index.php"><img src="./images/logo.png" alt="Logo"></a>  
        </div>
        <nav class="navbar">
            <div class="user-dropdown">
                <button class="user-button">
                <img src="<?php echo isset($_SESSION['user_id']) ? (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] ? './images/logo.png' : htmlspecialchars($_SESSION['profile_picture'])) : './images/login.png'; ?>" alt="login_logo" class="user-logo">
                </button>
                <div class="user-dropdown-content">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <p class="welcome-message">Welcome, <?php echo isset($_SESSION['is_admin']) && $_SESSION['is_admin'] ? 'Admin' : htmlspecialchars($_SESSION['first_name']); ?>!</p>
                        <div><br> </div>
                        <a href="logout.php" class="button">Logout</a>
                    <?php else: ?>
                        <form action="login.php" method="POST">
                            <label for="email">Email / Username:</label>
                            <input type="text" id="email" name="email" placeholder="example@example.com or Admin" required>
                            <label for="pwd">Password:</label>
                            <input type="password" id="pwd" name="pwd" required>
                            <input type="submit" value="Login">
                            <p>Don't have an account? <a href="register.php"> Register now.</a></p>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    <!-- Hero Section -->
     <div class="parallax">
        <section class="hero" id="main_hero">
            <div class="hero-text">
                <h1>Welcome to the Herbaria</h1>
                <p>Your guide to understanding the beauty and diversity of plants around the world.</p>
                <p>What would you like to do today?</p>
            </div>
            <div class="product-categories">
                <button class="cat_button" onclick="location.href = 'classify.php'">Classification</button>
                <button class="cat_button" onclick="location.href = 'tutorial.php'">Tutorial</button>
                <button class="cat_button" onclick="location.href = 'tools.php'">Tools</button>
                <button class="cat_button" onclick="location.href = 'care.php'">Care</button>
                <button class="cat_button" onclick="location.href = 'identify.php'">Identify</button>
                <button class="cat_button" onclick="location.href = 'contribute.php'">Contribute</button>
                <button class="cat_button" onclick="location.href = 'enquiry.php   '">Enquiry</button>
            </div>
        </section>
    </div>
    <!-- Divider Section -->
    <div class="divider">
        <h1>Informations</h1>
    </div>
    <div class="content_con">
        <section class="border">
            <h2>Classification</h2>
        </section>
        <section class="content_con">
            <div class="box_container">
                <div class="main_box">
                  <div class="box_content">
                    <img src="./images/family_icon.png" alt="family" class="icon">
                    <h3>Family</h3>
                    <p>Click the button to learn more about Family.</p>
                    <div><br></div>
                    <button class="button" onclick="location.href = './classify.php#family'">Learn More</button>
                  </div>
                </div>
                <div class="main_box">
                    <div class="box_content">
                        <img src="./images/species-butterfly-type-class-genus-512.webp" alt="genus" class="icon">
                        <h3>Genus</h3>
                        <p>Click the button to learn more about Genus.</p>
                        <div><br></div>
                        <button class="button" onclick="location.href = './classify.php#genus'">Learn More</button>
                    </div>
                </div>
                <div class="main_box">
                    <div class="box_content">
                        <img src="./images/species.png" alt="care" class="icon">
                        <h3>Species</h3>
                        <p>Click the button to learn more about Family.</p>
                        <div><br></div>
                        <button class="button" onclick="location.href = './classify.php#species'">Learn More</button>
                    </div>
                </div>
            </div>
            <div class="box_container">
                <div class="zoom_box">
                    <div class="mbox_front">
                        <img src="./images/shorea_faguetiana.jpg" class="front_img" alt="shorea_faguetiana">
                    </div>
                    
                    <div class="zoom_box_content">
                        <h3>Dipterocarpaceae</h3>
                        <button class="button" onclick="location.href = './classify.php#dipterocarpaceae'">Learn More</button>
                    </div>
                </div>

                <div class="zoom_box">
                    <div class="mbox_front">
                        <img src="./images/endiandra_bullata.jpg" class="front_img" alt="endiandra-bullata">
                    </div>
                    
                    <div class="zoom_box_content">
                        <h3>Lauraceae</h3>
                        <button class="button" onclick="location.href = './classify.php#lauraceae'">Learn More</button>
                    </div>
                </div>
                <div class="zoom_box">
                    <div class="mbox_front">
                        <img src="./images/canarium_australasicum.jpg" alt="canarium_australasicum" class="front_img">
                    </div>
                    
                    <div class="zoom_box_content">
                        <h3>Burseraceae</h3>
                        <button class="button" onclick="location.href = './classify.php#burseraceae'">Learn More</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Content Container -->
    <div class="content_con">
        <section class="border">
            <h2>Here below are other information:</h2>
        </section>
        <div class="content_con">
            <div class="box_container">
                <div class="main_box">
                <div class="box_content">
                    <img src="./images/tutorial.png" alt="tutorial" class="icon">
                    <h3>Tutorial</h3>
                    <p>A guide on how to transfer a fresh leaf into herbarium specimens.</p>
                    <div><br></div>
                    <button class="button" onclick="location.href = './tutorial.php'">Learn More</button>
                    </div>
                </div>
                <div class="main_box">
                    <div class="box_content">
                        <img src="./images/tools.png" alt="tools" class="icon">
                        <h3>Tools</h3>
                        <p>Information on the tools used to create herbarium specimens.</p>
                        <div><br></div>
                        <button class="button" onclick="location.href = './tools.php'">Learn More</button>
                    </div>
                </div>
                <div class="main_box">
                    <div class="box_content">
                        <img src="./images/care.png" alt="care" class="icon">
                        <h3>Care</h3>
                        <p>Information on how to preserve the herbarium.</p>
                        <div><br></div>
                        <button class="button" onclick="location.href = './care.php'">Learn More</button>
                    </div>
                </div>
                <div class="main_box">
                    <div class="box_content">
                        <img src="./images/identify.png" alt="indentify" class="icon">
                        <h3>Identify</h3>
                        <p>Steps to identify a plant's family and genus.</p>
                        <div><br></div>
                        <button class="button" onclick="location.href = './identify.php#identify_ways'">Learn More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="divider">
        <h1>Our Services</h1>
    </div>
    <div class="content_con">
        <section class="border">
          <h2>Here below are some services we provide:</h2>
        </section>
        <section class="other_resources">
        <div class="box_container">
            <div class="main_box">
                <div class="box_content">
                    <img src="./images/contribute.png" alt="placeholder" class="icon">
                    <h3>Contribution</h3>
                    <p>A form to contribute plants into our website.</p>
                    <div><br></div>
                    <button class="button" onclick="location.href = './contribute.php'">Learn More</button>
                </div>
            </div>
            <div class="main_box">
                <div class="box_content">
                    <img src="./images/enquiry.png" alt="placeholder" class="icon">
                    <h3>Enquiry</h3>
                    <p>Any questions? Feel free to ask us through a form.</p>
                    <div><br></div>
                    <button class="button" onclick="location.href = './enquiry.php'">Learn More</button>
                </div>
            </div>
            <div class="main_box">
                <div class="box_content">
                    <img src="./images/camera.png" alt="camera" class="icon">
                    <h3>Identify Plants</h3>
                    <p>Need help with identifying plants? Snap a pic and upload to us.</p>
                    <div><br></div>
                    <button class="button" onclick="location.href = './identify.php#identify_form'">Learn More</button>
                </div>
            </div>
        </div>
        </section>
    </div>
    <section id="about_us">
        <div class="divider">
            <h1>About Us</h1>
        </div>
        <div class="content_con">
            <section id="team" class="border">
              <h2>The Team</h2>
            </section>
            <section class="other_resources">
            <div class="box_container">
                <div class="abtus_box">
                    <div class="abtus_content">
                        <h3>Ivan Liang Jin Ngu</h3>
                        <img src="./images/ivan.jpg" alt="Ivan"  class="profile_img">
                        <p>The person that mainly focus on content and styling of the website.</p>
                        <button class="button" onclick="location.href = 'ivan_profile.php'">Learn More</button>
                    </div>
                  </div>
                  <div class="abtus_box">
                    <div class="abtus_content">
                        <h3>NENG YI CHIENG</h3>
                        <img src="./images/ny.jpg" alt="ny"  class="profile_img">
                        <p>The person that's responsible for forms and media handling.</p>
                        <button class="button" onclick="location.href = 'ny_profile.php'">Learn More</button>
                    </div>
                  </div>
                  <div class="abtus_box">
                    <div class="abtus_content">
                        <h3>ELIJAH BENJAMIN TAN</h3>
                        <img src="./images/Elijah.jpg" alt="Elijah"  class="profile_img">
                        <p>The person that's responsible for content and styling parts of the website.</p>
                        <button class="button" onclick="location.href = 'elijah_profile.php'">Learn More</button>
                    </div>
                  </div>
                  <div class="abtus_box">
                    <div class="abtus_content">
                        <h3>JACK</h3>
                        <img src="./images/jack.jpg" alt="placeholder"  class="profile_img">
                        <p>The person that's responsible for background images, logo and forms.</p>
                        <button class="button" onclick="location.href = 'jack_profile.php'">Learn More</button>
                    </div>
                  </div>
            </div>
            </section>
        </div>
        </section>

    <!-- Footer Section -->
    <?php 
        include "include/footer.inc";
        include "include/back_top.inc";
    ?>
</body>

</html>
