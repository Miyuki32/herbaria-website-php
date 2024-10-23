<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Care</title>
        <meta name="author" content="Elijah">
        <meta name="keywords" content="Care, Herbarium">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/style.css">
        <link rel="icon" href="./images/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    </head> 
    <body>
        <?php
            include 'include/header.inc';
        ?>
        <section class="hero" id="care_hero">
            <div class="hero-text">
                <h1>Welcome to the Care</h1>
                <p>Your guide to understanding on how to transfer a fresh leaf into herbarium specimens</p>
            </div>
        </section>

        <div class="class_divider">
            <h1>What are the ways that a herbarium can be preserved?</h1>
        </div>

        <div class="content_con">
            <section class="class_border">
                <h2 id="family">The 3 methods for herbarium care</h2>
            </section>
            <div class="class_def">
                <div class="family_box">
                    <h3>Herbariums are vulnerable and require lots of care, especially the specimens.</h3>
                    <br><br>
                    <div class="class_textarea">
                        <p>There are 3 methods that you can care for your herbarium and the specimens.</p>
                        <ul>
                            <li>Safe storage environment</li>
                            <li>Specimen Handling</li>
                            <li>Condition surveying</li>
                        </ul>
                    </div>
                </div>
                <figure class="care_figure">
                    <img class="care_img" src="./images/not_care.jpg" alt="destroyed" id="destroyed">
                    <figcaption class="care_cap">Image of a specimen that were neglected</figcaption>
                </figure>
            </div>
        </div>

        <div class="class_divider">
            <h1>The Methods</h1>
        </div>
        <div class="content_con">
            <section class="class_border">
                <h2>Safe storage environment</h2>
            </section>
            <div class="tools_def">
                <div class="family_box">
                    <div class="care_textarea">
                        <p>A safe place to store the specimens should have multiple criterias and requirements. A safe herbarium should be :</p>
                        <ul>
                            <li>Secure and purpose built</li>
                            <li>20 degrees Celcius and 50% relative humidity</li>
                            <li>Have metal cabinets with rubber door seals</li>
                        </ul>
                    </div>
                </div>
                <figure class="care_figure">
                    <img class="care_img" src="./images/safe.jpg" alt="safe">
                    <figcaption class="care_cap">Metal cabinets used to store specimens</figcaption>
                </figure>
            </div>
        </div>

        <div class="content_con">
            <section class="class_border">
                <h2>Specimen Handling</h2>
            </section>
            <div class="tools_def">
                <div class="family_box">
                    <div class="care_textarea">
                        <p>There are many precautions that one should take when handling specimens. Examples of these precautions are as followed :</p>
                        <ul>
                            <li>Tight or overcrowded spaces and crush the specimens</li>
                            <li>Tilting the specimens can possibly damage the specimens</li>
                            <li>Electrical lights can cause decay to the specimens</li>
                            <li>Open doors may cause uninvited pests</li>
                        </ul>
                    </div>
                </div>
                <figure class="care_figure">
                    <img class="care_img" src="./images/squash.jpg" alt="squash">
                    <figcaption class="care_cap">Specimens getting squashed</figcaption>
                </figure>
            </div>
        </div>

        <div class="content_con">
            <section class="class_border">
                <h2>Condition surveying</h2>
            </section>
            <div class="tools_def">
                <div class="family_box">
                    <div class="care_textarea">
                        <p>Surveys are carried out on the specimens to determine their condition. These are the survey methods :</p>
                        <ul>
                            <li>Using a digital camera</li>
                            <li>Using a flat bed scanner</li>
                            <li>Databasing specimens from a monitor</li>
                        </ul>
                    </div>
                </div>
                <figure class="care_figure">
                    <img class="care_img2" src="./images/scan.jpg" alt="scan">
                    <figcaption class="care_cap2">Flat bed scanner</figcaption>
                </figure>
            </div>
        </div>
        <?php
            include 'include/footer.inc';
            include 'include/back_top.inc';
        ?>
    </body>
</html>
