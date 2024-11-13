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
session_start();

include 'include/header.inc';

$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$showResult = false;
$error = null;
$uploadDir = 'uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Only check for errors if a form submission occurred
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle file upload restriction for logged-out users
    if (!$isLoggedIn) {
        $error = "You must be logged in to upload a file.";
    }
    // Check if file was uploaded
    else if (!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] !== UPLOAD_ERR_OK) {
        $error = "Please select a file to upload.";
    }
    else {
        // Define the target file path
        $targetFilePath = $uploadDir . basename($_FILES['file_upload']['name']);

        // Proceed with file upload and API call
        if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $targetFilePath)) {
            $apiKey = "CSTmOnm87HrmtD3E2UDT9lNAkVcXhpvlAvxaMgZqFpbuGzKiOp";
            $apiUrl = "https://api.plant.id/v2/identify";

            $imageData = base64_encode(file_get_contents($targetFilePath));

            // Plant ID API data setup
            $data = [
                'api_key' => $apiKey,
                'images' => [$imageData],
                'modifiers' => ["crops_fast", "similar_images"],
                'plant_language' => "en",
                'plant_details' => ["common_names", "wiki_description", "taxonomy", "propagation_methods", "best_watering", "cultural_significance", "common_uses", "inaturalist_id"]
            ];

            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

            $response = curl_exec($ch);
            
            // Check for cURL errors
            if ($response === false) {
                $error = "API request failed: " . curl_error($ch);
            } else {
                $result = json_decode($response, true);

                // Check if suggestions are available in the result
                if (isset($result['suggestions']) && count($result['suggestions']) > 0) {
                    $showResult = true;
                } else {
                    $error = "No plant identification suggestions found. Please try another image.";
                }
            }
            curl_close($ch);
        } else {
            $error = "File upload failed. Please try again.";
        }
    }
}
?>

<section class="hero" id="identify_hero">
    <div class="hero-text">
        <h1>Welcome to the Identify</h1>
        <p>Your guide to understanding how to identify a plant.</p>
    </div>
</section>

<div class="upload_divider" id="identify_form">
    <h1>Need help identifying plants?</h1>
</div>

<div class="content_con">
    <form action="identify.php#result_section" method="post" enctype="multipart/form-data" class="upload_form">
        <div class="upload_container">
        <?php if (!$isLoggedIn): ?>
            <div class="upload_icon">⚠️</div>
            <h3><a href="./login.php">Login to access this feature</a></h3>
        <?php else: ?>
            <div class="upload_icon">⬇️</div>
            <p class="upload_text">Choose a file or drag it here.</p>
            <input type="file" id="file_upload" name="file_upload" accept="image/*">
        </div>
        <button type="submit" class="upload_button">Upload File</button>
    <?php endif; ?>
    </form>
</div>

<?php if ($showResult): ?>
    <input type="checkbox" id="toggle" checked>
    <div id="result_section">
        <div class="result_divider">
            <h1>Possible Plant Identifications (Powered by Plant.id):</h1>
        </div>
        <div class="identify_class_def">
            <div class="content-wrapper">
                <figure class="identify_figure">
                    <img src="<?= htmlspecialchars($targetFilePath) ?>" alt="Uploaded plant image" class="similar_image">
                </figure>
                <div class="identify_textarea">
                    <table class="identify_table">
                        <?php
                        // Loop through all suggestions and display details
                        foreach ($result['suggestions'] as $index => $suggestion) :
                            $plantName = htmlspecialchars($suggestion['plant_name']);
                            $probability = isset($suggestion['probability']) ? round($suggestion['probability'] * 100, 2) . "%" : "Unknown";
                            
                            // Get common names if available
                            $commonNames = isset($suggestion['plant_details']['common_names']) 
                                ? implode(", ", array_map('htmlspecialchars', $suggestion['plant_details']['common_names'])) 
                                : "Not available";
                            
                            // Get iNaturalist ID
                            $iNaturalistId = $suggestion['plant_details']['inaturalist_id'] ?? 'Not available';
                            
                            // Get similar images
                            $similarImages = $suggestion['similar_images'] ?? [];
                        ?>
                            <tr>
                                <th>Suggestion <?= $index + 1 ?>:</th>
                                <td>
                                    <strong>Scientific Name:</strong> <?= $plantName ?><br>
                                    <strong>Common Names:</strong> <?= $commonNames ?><br>
                                    <strong>Probability:</strong> <?= $probability ?><br>
                                    <strong>iNaturalist:</strong> 
                                    <?php if ($iNaturalistId): ?>
                                        <a href="https://www.inaturalist.org/taxa/<?= htmlspecialchars($iNaturalistId) ?>" target="_blank"><?= htmlspecialchars($plantName) ?></a>
                                    <?php else: ?>
                                        Not available
                                    <?php endif; ?>
                                    <br>
                                    <?php if (!empty($similarImages)): ?>
                                        <strong>Similar Images:</strong><br>
                                        <div class="similar-images-container">
                                            <?php 
                                            $imageCount = 0;
                                            foreach ($similarImages as $image): 
                                                if ($imageCount >= 3) break;
                                            ?>
                                                <img src="<?= htmlspecialchars($image['url']) ?>" 
                                                     alt="Similar plant image" 
                                                     class="identify_image">
                                            <?php 
                                                $imageCount++;
                                            endforeach; 
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr><td colspan="2"><hr></td></tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <label for="toggle" class="close_button" title="Click here to close.">
               <img src="./images/close.png" alt="close logo">
            </label>
        </div>
    </div>
<?php endif; ?>


<?php if (isset($error) && $error !== null): ?>
    <input type="checkbox" id="toggle-popup" style="display: none;" checked>
    <div class="popup-overlay">
        <div class="popup">
            <label for="toggle-popup" class="close-btn">✖</label>
            <p><?= htmlspecialchars($error) ?></p>
        </div>
    </div>
<?php endif; ?>
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
