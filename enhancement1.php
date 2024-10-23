<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Enhancements</title>
        <meta name="author" content="Ivan Liang Jin Ngu">
        <meta name="keywords" content="Enhancements, Herbarium">
        <meta name="description" content="Webpage about the enhancements used in Herbaria website.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/style.css">
        <link rel="icon" href="./images/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    </head> 
    <body>
        <?php
            include 'include/header.inc';
        ?>
        <section class="hero" id="classify_hero">
            <div class="hero-text">
                <h1>Welcome to Enhancements</h1>
                <p>Your guide to understanding the key features of the website</p>
            </div>
        </section>
        <div class="divider">
            <h1>What are the enhancement used in this website?</h1>
        </div>
        <div class="content_con">
            <section class="class_border">
                <h2>Lift effects when hover</h2>
            </section>
            <div class="class_def">
                <div class="box_container">
                    <div class="main_box">
                      <div class="box_content">
                      </div>
                    </div>
                    <div class="enhancement_text">
                        <p>Lift while hover is an enhancement appearing throughout index.php boxes. This effect is achieved with <a href="https://www.w3schools.com/cssref/css3_pr_transform.php">transform: translateY(-5px);.</a> This effect is implemented so that the boxes in index.php will be more stand out visually. <a href="index.php">Click here to see this effect in the website.</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content_con">
            <section class="class_border">
                <h2 id="family">Image zoom effect to reveal content box</h2>
            </section>
            <div class="class_def">
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
                    <div class="enhancement_text">
                        <p>The .zoom_box class is a class to style a container with a background color #FAFAQ0, rounded corners, and shadow for a raised effect that looks appealing all visually. It's a flexbox element and it moves smoothly from one visibility level/point to another when hovered. The front element, .mbox_front, is an element that is absolutely adhered to it and covers the whole box, but, when on hover, it transforms into a smaller version of the image and placing on top of the content which is hidden behind. This effect has taken inspiration from <a href="https://www.youtube.com/watch?v=IFai8qTKvEM">Online Tutorials</a>, and are being used under <a href="index.php#classify">Classification in main webpage.</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content_con">
            <div class="section class_border" id="genus">
              <h2>Hidden aside text area / Slide Panel</h2>
            </div>
            <div class="class_def">
              <div class="genus_box">
                <div class="class_textarea">
                    <p>By using the effect we can create a sliding panel intra-action that appears when hovered over by positioning it off-screen to the right (right: -30vw) and moving it into view (right: 0) using CSS transitions. The panel rarely visible and moved out of view by default (inactive) through the setting creating a smooth sliding effect in the user experience. The transform: translateY(-50%) ensures that the panel is always directly at the middle vertically. Also, transition: right 0.3s ease-out;, once activated, simply controls the sliding speed. This feature draws inspiration from <a href="https://speckyboy.com/vertical-slide-menu-css-transitions/">Speckyboy</a>, and is used in <a href="./classify.php#genus">genus under classify page.</a> For users on mobile, this feature is unfortunately not displayed due to coding limitations.</p>
                </div>
              </div>
              <aside class="slide_panel">
                <div class="slide_trigger">&#9658;</div>
                <div class="slide_content">
                  <p><em>Fun fact: In 2018, the <a href="https://www.catalogueoflife.org/">Catalogue of Life</a> quoted 173,363 accepted genus names for both extant and extinct species.</em></p>
                </div>
              </aside>
            </div>
        </div>
        <div class="content_con">
            <section class="class_border">
                <h2>Fade Image Text</h2>
            </section>
            <div class="class_classification">
                <div class="fade_container">
                    <img src="./images/shorea_faguetiana.jpg" alt="shorea_faguetiana" class="fade_image">
                    <div class="fade_overlay">
                      <div class="fade_text"><a href="https://en.wikipedia.org/wiki/Shorea_faguetiana">Shorea Faguetiana</a></div>
                    </div>
                </div>                  
                <div class="class_def">
                    <p>The class .fade_container is coded to produce a fade-in overlay effect for images in classify.php. An overlay is shown on one side when a user hits the mouse over, which leads to the content becoming more visible. The overlay is made up of centered text links that are brought into focus against the image, as the user is able to interact with the content by clicking on the links. This feature is based on <a href="https://www.w3schools.com/howto/howto_css_image_overlay.asp">Image Hover Overlay from W3Schools</a>, and is used under examples in <a href="classify.php#examples">Examples under classify webpage.</a>
                </div>
            </div>
        </div>
        <div class="upload_divider">
            <h1>Header with effects</h1>
        </div>
        <div class="content_con">
            <div class="class_def">
                <p>The upload_divider class utilizes pseudo-elements to create decorative floating leaf emojis (🍃) on both the top left and bottom right corners. These emojis are animated to create a gentle floating effect using keyframe animations. The ::before pseudo-element floats the emoji to the left, while the ::after pseudo-element floats the emoji to the right, each with distinct animations. The animations involve translating and rotating the emojis to simulate a natural floating motion, enhancing the visual appeal of the divider. This animation is made using <a href="https://www.w3schools.com/css/css3_animations.asp">W3Schools' documentation</a> on animations. This is only used in one header in <a href="identify.php#identify_form">identify webpage.</a></p>
            </div>
        </div>
        <div class="content_con">
            <form action="/upload" method="post" enctype="multipart/form-data" class="upload_form" onsubmit="return false;">
                <!-- Hidden checkbox to trigger the reveal -->
                <label for="toggle" class="upload_button" title="Click here for example result.">
                    <span class="button_text">Click Me</span>
                </label>
            </form>
        </div>
        <input type="checkbox" id="toggle">
        <!-- Content to be revealed -->
        <div class="hide_content">
            <div class="identify_class_def">
                <h2 class="title">Hidden content</h2>
                <div class="content-wrapper">
                    <div class="identify_textarea">
                        By using toggle for checked and clever display:none css element, we are able to make items reveal itself when the button is clicked. The button also features an animation of leaves floating in when hover using keyframes. This is used under <a href="./identify.php#identify_form">upload in identify</a>, to only show the results of the flower when button is clicked.
                    </div>
                </div>
                <input type="checkbox" id="toggle">
                <label for="toggle" class="close_button" title="Click here to close.">
                   <img src="./images/close.png" alt="close logo">
                </label>
            </div>
        </div>
        <div class="content_con">
            <section class="tool_border" id="enhancement_section1">
                <h2>Moving text box when hover and image enlargement when hover</h2>
            </section>
            
            <div class="tools_def">
                <div class="tools_section2">
                    <p>For the text area, it utilizes transform: translateX(10px); to move it towards X when hover. While the image utilizes transform: scale(1.05); to make it increase in scale when hover. These can be found through W3School website. <a href="https://www.w3schools.com/cssref/css3_pr_transform.php">Transform </a>and <a href="https://www.w3schools.com/cssref/css_pr_translate.php">Translate</a>. This part is used in <a href="./tools.php">Tools section.</a></p>
                </div>
                <figure class="tools_figure">
                    <img class="tools_figure_img" src="./images/glue.jpg" alt="glue">
                </figure>
            </div>
        </div>
        <div class="content_con">
            <section class="tool_border">
                <h2>Flip Cards</h2>
            </section>
            <div class="tools_def">
                <div class="tools_section">
                    <div class="flip_box_container">
                        <div class="class_flip">
                            <div class="class_flip_inner">
                              <div class="class_flip_front">
                                <div class="content">
                                    <img src="./images/bag.jpg" alt="bag">
                                    <p>Flip Cards</p>
                                </div>
                            </div>
                            <div class="class_flip_back">
                                <p>Flip cards are used to display certain tools under the page <a href="tools.php">Tools.</a> This feature is from <a href="https://www.w3schools.com/howto/howto_css_flip_card.asp">W3School</a> but with our own twists.</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>
        <?php
            include 'include/footer.inc';
            include 'include/back_top.inc';
        ?>
</html>
