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

$showResult = false;
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Check if the form is submitted and file is uploaded
if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] === UPLOAD_ERR_OK) {
    // Define the target file path
    $targetFilePath = $uploadDir . basename($_FILES['file_upload']['name']);

    // Proceed with the file upload
    if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $targetFilePath)) {
        $apiKey = "";
        $apiUrl = "https://api.plant.id/v2/identify";

        $imageData = base64_encode(file_get_contents($targetFilePath));

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
        curl_close($ch);

        $result = json_decode($response, true);

        if (isset($result['suggestions'][0])) {
            $showResult = true;
            $plantName = htmlspecialchars($result['suggestions'][0]['plant_name']);
            $iNaturalistId = $result['suggestions'][0]['plant_details']['inaturalist_id'] ?? null;
            $commonNamesArray = $result['suggestions'][0]['plant_details']['common_names'] ?? ["Unknown"];
            $firstCommonName = htmlspecialchars($commonNamesArray[0]);
            $firstCommonName = html_entity_decode($firstCommonName);
            $commonName = htmlspecialchars(implode(", ", $commonNamesArray));
            $commonName = html_entity_decode($commonName);

            $description = htmlspecialchars($result['suggestions'][0]['plant_details']['wiki_description']['value'] ?? "Description not available.");
            $description = html_entity_decode($description);

            $propagationMethodsArray = $result['suggestions'][0]['plant_details']['propagation_methods'] ?? ["Description not available."];
            $propagationMethods = htmlspecialchars(implode(", ", $propagationMethodsArray));
            $propagationMethods = html_entity_decode($propagationMethods);

            $watering = htmlspecialchars($result['suggestions'][0]['plant_details']['best_watering'] ?? "Description not available.");
            $watering = html_entity_decode($watering);

            $culturalSignificance = htmlspecialchars($result['suggestions'][0]['plant_details']['cultural_significance'] ?? "Description not available.");
            $culturalSignificance = html_entity_decode($culturalSignificance);

            $commonUses = htmlspecialchars($result['suggestions'][0]['plant_details']['common_uses'] ?? "Description not available.");
            $commonUses = html_entity_decode($commonUses);

            $taxonomy = $result['suggestions'][0]['plant_details']['taxonomy'] ?? [];
            $kingdom = htmlspecialchars($taxonomy['kingdom'] ?? "Unknown");
            $family = htmlspecialchars($taxonomy['family'] ?? "Unknown");
            $genus = htmlspecialchars($taxonomy['genus'] ?? "Unknown");
        } else {
            $error = "Plant not identified. Please try another image.";
        }
    } else {
        $error = "Failed to upload image.";
    }
} else {
    if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] !== UPLOAD_ERR_OK) {
        $error = "No file uploaded or an error occurred.";
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
    <form action="identify.php" method="post" enctype="multipart/form-data" class="upload_form">
        <div class="upload_container">
            <div class="upload_icon">⬇️</div>
            <p class="upload_text">Choose a file or drag it here.</p>
            <input type="file" id="file_upload" name="file_upload" accept="image/*">
        </div>
        <button type="submit" class="upload_button">Upload File</button>
    </form>
</div>

<?php if ($showResult): ?>
    <input type="checkbox" id="toggle" checked>
    <div class="hide_content">
        <div class="divider">
        <h1>Result (Powered by Plant.id):</h1>
        </div>
        <div class="identify_class_def">
            <h2 class="title"><?= htmlspecialchars($firstCommonName) ?></h2>
            <div class="content-wrapper">
                <figure class="identify_figure">
                    <img src="<?= htmlspecialchars($targetFilePath) ?>" alt="Uploaded plant image" id="upload_plant">
                </figure>
                <div class="identify_textarea">
                    <table class="identify_table">
                        <tr>
                            <th>Name:</th>
                            <td><?= htmlspecialchars($commonName) ?></td>
                        </tr>
                        <tr>
                            <th>Scientific Name:</th>
                            <td><?= htmlspecialchars($plantName) ?></td>
                        </tr>
                        <tr>
                            <th>iNaturalist:</th>
                            <td>
                                <?php if ($iNaturalistId): ?>
                                    <a href="https://www.inaturalist.org/taxa/<?= htmlspecialchars($iNaturalistId) ?>" target="_blank"><?= htmlspecialchars($plantName) ?></a>
                                <?php else: ?>
                                    Not available
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Classification:</th>
                            <td>
                                <strong>Kingdom:</strong> <?= htmlspecialchars($kingdom) ?><br>
                                <strong>Family:</strong> <?= htmlspecialchars($family) ?><br>
                                <strong>Genus:</strong> <?= htmlspecialchars($genus) ?><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td><?= htmlspecialchars($description) ?></td>
                        </tr>
                        <tr>
                            <th>Propagation Methods:</th>
                            <td><?= htmlspecialchars($propagationMethods) ?></td>
                        </tr>
                        <tr>
                            <th>Watering:</th>
                            <td><?= htmlspecialchars($watering) ?></td>
                        </tr>
                        <tr>
                            <th>Common Uses:</th>
                            <td><?= htmlspecialchars($commonUses) ?></td>
                        </tr>
                        <tr>
                            <th>Cultural Significance:</th>
                            <td><?= htmlspecialchars($culturalSignificance) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <label for="toggle" class="close_button" title="Click here to close.">
               <img src="./images/close.png" alt="close logo">
            </label>
        </div>
    </div>
<?php elseif (isset($error)): ?>
    <p><?= htmlspecialchars($error) ?></p>
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
