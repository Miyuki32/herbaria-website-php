<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Identify</title>
        <meta name="author" content="Ivan Liang Jin Ngu">
        <meta name="description" content="Webpage about identifying plants.">
        <meta name="keywords" content="identify, Herbarium">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/style.css">
        <link rel="icon" href="./images/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    </head> 
    <body id="identify_body">
        <?php
            include 'include/header.inc';
        ?>
        <section class="hero" id="identify_hero">
            <div class="hero-text">
                <h1>Welcome to the Identify</h1>
                <p>Your guide to understanding on how to indentify a plant.</p>
            </div>
        </section>
        <div class="upload_divider" id="identify_form">
            <h1>Need help identifying plants?</h1>
        </div>
        <!-- Upload form -->
        <div class="content_con">
            <form action="/upload" method="post" enctype="multipart/form-data" class="upload_form" onsubmit="return false;">
                <div class="upload_container">
                    <div class="upload_icon">⬇️</div>
                    <p class="upload_text">Choose a file or drag it here.</p>
                    <input type="file" id="file_upload" name="file_upload" accept="image/*">
                </div>
                <!-- Hidden checkbox to trigger the reveal -->
                <label for="toggle" class="upload_button" title="Click here for example result.">
                    <span class="button_text">Upload File</span>
                </label>
            </form>
        </div>
        <input type="checkbox" id="toggle">
        <!-- Content to be revealed -->
        <div class="hide_content">
            <div class="divider">
                <h1>Example result:</h1>
            </div>
            <div class="identify_class_def">
                <h2 class="title">Morning Glory</h2>
                <div class="content-wrapper">
                    <figure class="identify_figure">
                        <img src="./images/morning_flower.webp" alt="morning_flower" id="morning_flower1">
                        <img src="./images/GoodMorning1.jpeg" alt="morning_flower" id="morning_flower2">
                        <img src="./images/GoodMorning3.jpeg" alt="morning_flower" id="morning_flower3">
                    </figure>
                    <div class="identify_textarea">
                        <table class="identify_table">
                            <tr>
                                <th>Name:</th>
                                <td>Morning Glory</td>
                            </tr>
                            <tr>
                                <th>Scientific Name:</th>
                                <td>Ipomoea purpurea</td>
                            </tr>
                            <tr>
                                <th>Tutorial:</th>
                                <td>Morning Glories are wonderful, quickly developing vines that grow vibrant, bell-shaped flowers of different colors, with blue, purple and/or pink being the most abundant ones. This instruction is to direct you with planting, caring for, and other steps to successfully grow these beautiful and colorful flowers. You will be informed how to select the right place, prepare the soil, and the way to prop the flowers while they're growing, so they will thrive and bloom optimally.</td>
                            </tr>
                            <tr>
                                <th>Tools:</th>
                                <td>
                                    <ul>
                                        <li>Garden trowel</li>
                                        <li>Gardening gloves</li>
                                        <li>Trellis or support structure</li>
                                        <li>Watering can</li>
                                        <li>Organic fertilizer</li>
                                        <li>Mulch</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th>Care:</th>
                                <td>
                                    <ul>
                                        <li><strong>Sunlight:</strong> Morning Glories thrive in full sunlight, requiring at least 6 hours of direct sunlight daily.</li>
                                        <li><strong>Soil:</strong> They prefer well-draining soil with a slightly acidic to neutral pH. Amend with compost for better results.</li>
                                        <li><strong>Watering: </strong>Keep the soil evenly moist, especially during the initial growth phase. Once established, they are drought-tolerant but still appreciate regular watering.</li>
                                        <li><strong>Support:</strong> Provide a trellis or other support for the vines to climb.</li>
                                        <li><strong>Fertilization:</strong> Feed with a balanced, slow-release fertilizer every 4-6 weeks during the growing season.</li>
                                        <li><strong>Pruning:</strong> Cut back dead or damaged vines to encourage healthier growth.</li>
                                        <li><strong>Pest Control:</strong> Keep an eye out for aphids and other common garden pests. Neem oil can be used as an organic treatment if necessary.</li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <input type="checkbox" id="toggle">
                <label for="toggle" class="close_button" title="Click here to close.">
                   <img src="./images/close.png" alt="close logo">
                </label>
            </div>
        </div>
        <div class="divider">
            <h1>How can you identify a plant?</h1>
        </div>
        <div class="content_con">
            <section class="class_border" id="identify_ways">
                <h2>Basic way of Plant Identification</h2>
            </section>
            <div class="class_def">
                <div class="family_box">
                    <h3>According to <a href="https://www.seattlemet.com/discover/home/how-identify-plants/">Seattlemet</a>, here's a how to identify a plant with basic skills:</h3>
                    <br><br>
                    <div class="class_textarea">
                        <ul>
                            <li>Leaves Clues:
                                <ul>
                                    <li><strong>Shape:</strong> Look at the overall shape.</li>
                                    <li><strong>Edges:</strong> Smooth, toothed, or lobed?</li>
                                    <li><strong>Arrangement:</strong> Simple (one blade) or compound (multiple leaflets)?</li>
                                    <li><strong>Attachment: </strong> Opposite or alternate on the stem?</li>
                                </ul>
                            </li>
                            <li>Plant Identification Clues:
                                <ul>
                                    <li><strong>Leaf Arrangement:</strong> Opposite or alternate on the stem?</li>
                                    <li><strong>Leaf Edges:</strong> Smooth or toothed?</li>
                                    <li><strong>Flowers:</strong> Shape, size, and color.</li>
                                    <li><strong>Fruit:</strong> Type (berries, cones, etc.)</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <aside class="identify_aside">
                        <h4>Quick Tip: Leaf Patterns</h4>
                        <dl>
                            <dt>When identifying plants, pay close attention to leaf patterns. Some common patterns include:</dt>
                            <dd>
                                <ul>
                                    <li>Palmate: Leaves spread out like fingers from a palm</li>
                                    <li>Pinnate: Leaflets arranged along both sides of a stem</li>
                                    <li>Bipinnate: Twice divided pinnate leaves</li>
                                </ul>
                            </dd>
                            <dd>Recognizing these patterns can greatly assist in narrowing down plant species!</dd>
                        </dl>
                    </aside>
                </div>
                <figure class="def_image_leaf">
                    <img src="./images/leaves.png" alt="leaf" id="leaf">
                    <figcaption>Image of a leaf. From <a href="https://www.pexels.com/photo/nature-plant-leaf-leaves-36008/">Pexels</a>.</figcaption>
                </figure>
            </div>
        </div>
        <div class="content_con">
            <section class="class_border" id="tools">
                <h2>Using tools to Identify</h2>
            </section>
            <div class="class_def">
                <div class="family_box">
                    <h3>According to <a href="https://www.seattlemet.com/discover/home/how-identify-plants/">Seattlemet</a>, there's a few tools that can help identifying a plant:</h3>
                    <br><br>
                    <div class="class_textarea">
                        <ul>
                            <li>Dichotomous Key
                                <ol>
                                    <li><strong>Start:</strong> Tree, shrub, or other?</li>
                                    <li><strong>Leaves:</strong> Needles or broad?</li>
                                    <li><strong>Arrangement:</strong> Opposite or alternate?</li>
                                    <li><strong>Margins: </strong> Smooth, toothed, or lobed?</li>
                                    <li><strong>Features: </strong> Berries, flowers, etc.?</li>
                                    <li><strong>Habitat: </strong> Wetlands or dry areas?</li>
                                </ol>
                            </li>
                            <li>Plant Identification Clues:
                                <ul>
                                    <li><a href="https://apps.apple.com/ca/app/plant-iq-identify-plants/id6474062354"><strong>Dr. Greeny:</strong></a> Snap a photo for instant plant identification and care tips.</li>
                                    <li><a href="https://www.picturethisai.com/"><strong>PictureThis:</strong></a> AI-powered plant identification with detailed species information.</li>
                                    <li><a href="https://www.plantsnap.com/"><strong>PlantSnap:</strong></a> Extensive database and advanced image recognition for plant identification.</li>
                                    <li><a href="https://www.inaturalist.org/"><strong>iNaturalist:</strong></a> Community-based plant identification through photo uploads.</li>
                                    <li><a href="https://leafsnap.com/"><strong>Leafsnap:</strong></a> Electronic field guide for identifying tree species from leaf photos.</li>
                                    <li><a href="https://www.gardenanswers.com/"><strong>Garden Answers Plant Identification:</strong></a> Instant plant information and care advice from photos.</li>
                                    <li><a href="https://www.inaturalist.org/pages/seek_app"><strong>Seek by iNaturalist:</strong></a> Point your camera at a plant for identification and educational information.</li>
                                    <li><a href="https://identify.plantnet.org/"><strong>Pl@ntNet:</strong></a> Identify plants through images and curated databases.</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <figure class="def_image_tools">
                    <img src="./images/plant_indentifier-removebg.png" alt="tools" id="tools">
                    <figcaption>Image of a PlantCam App. From <a href="https://www.plantidapp.com/">PlantID</a>.</figcaption>
                </figure>
            </div>
        </div>
        <?php
            include 'include/footer.inc';
            include 'include/back_top.inc';
        ?>
    </body>
</html>
