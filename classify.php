<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Classify</title>
        <meta name="author" content="Ivan Liang Jin Ngu">
        <meta name="keywords" content="classification, Herbarium, genus, family, species">
        <meta name="description" content="Webpage about Family, Genus and Species">
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
                <h1>Welcome to the Classification</h1>
                <p>Your guide to understanding the beauty and diversity of plants of different families.</p>
            </div>
        </section>
        <div class="class_divider">
            <h1>What is family, genus and species?</h1>
        </div>
        <div class="content_con">
            <section class="class_border">
                <h2 id="family">Family</h2>
            </section>
            <div class="class_def">
                <div class="family_box">
                    <h3>According to <a href="https://www.biologyonline.com/dictionary/family">Biology Online</a>, there's a few meanings for family:</h3>
                    <br><br>
                    <div class="class_textarea">
                        <ul>
                            <li>A taxonomic rank in the classification of organisms between genus and order.</li>
                            <li>A taxonomic group of one or more genera, especially sharing a common attribute.</li>
                            <li>A collection of things or entities grouped by their common attributes, e.g., protein family, gene family, etc.</li>
                        </ul>
                    </div>
                </div>
                <figure class="def_image_taxonomy">
                    <img src="./images/taxanomy.png" alt="taxonomy" id="taxonomy">
                    <figcaption>Image of Taxonomy. From <a href="https://www.vrogue.co/post/five-kingdom-classification-of-plants-and-animals-pmf-ias">Vrouge.co</a>.</figcaption>
                </figure>
            </div>
        </div>
        <div class="content_con">
            <div class="section class_border" id="genus">
              <h2>Genus</h2>
            </div>
            
            <div class="class_def">
              <figure class="def_image_genus">
                <img src="./images/genus.jpg" id="Genus" alt="genus">
                <figcaption>Image of Genus. From <a href="https://www.biologyonline.com/dictionary/genus">Biology Online</a>.</figcaption>
              </figure>
              <div class="genus_box">
                <h3>According to <a href="https://dictionary.cambridge.org/dictionary/english/genus">Cambridge Dictionary</a>, genus means:</h3>
                <div class="class_textarea">
                    <p>A group of animals or plants, more closely related than a family, but less similar than a species</p>
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
                <h2 id="species">Species</h2>
            </section>
            <div class="class_def">
                <div class="species_box">
                    <h3>According to <a href="https://biologydictionary.net/species/">Biology Dictionary</a>, genus means:</h3>
                    <br>
                    <div class="class_textarea">
                        <ul>
                            <li>Species are organisms with similar genetics, capable of interbreeding and producing fertile offspring.</li>
                            <li>Reproductive barriers (geographical or genetic) separate species.</li>
                            <li>Barriers include mountains or genetic differences preventing reproduction.</li>
                            <li>The definition of species has evolved over time.</li>
                        </ul>
                    </div>
                </div>
                <figure class="def_image_species">
                    <img src="./images/species-removebg-preview.png" alt="species" id="species_img">
                    <figcaption>Image of Taxanomy. From <a href="https://www.thulasidas.com/reductionism/">Unreal Blog</a>.</figcaption>
                </figure>
            </div>
        </div>
        <div class="class_divider">
            <h1>Examples:</h1>
        </div>
        <div class="content_con">
            <section class="class_border">
                <h2 id="dipterocarpaceae">Dipterocarpaceae</h2>
            </section>
            <div class="class_classification">
                <div class="fade_container">
                    <img src="./images/shorea_faguetiana.jpg" alt="shorea_faguetiana" class="fade_image">
                    <div class="fade_overlay">
                      <div class="fade_text"><a href="https://en.wikipedia.org/wiki/Shorea_faguetiana">Shorea Faguetiana</a></div>
                    </div>
                </div>                  
                <div class="class_textarea">
                    <dl>
                        <dt>Shorea (Genus)</dt>
                        <dd>
                            The family Dipterocarpaceae contains about 196 species of rainforest trees that make up the genus Shorea.
                            <ul>
                                <li>Found in tropical Asia</li>
                                <li>Includes important timber species</li>
                            </ul>
                        </dd>
                        <dt>Example Species:</dt>
                        <dd>
                            Shorea faguetiana (Yellow Meranti):
                            <ul>
                                <li>It belongs to the family Dipterocarpaceae and is native to Borneo, the Malay Peninsula, and Thailand.</li>
                                <li>It is one of the tallest flowering plants, with the tallest specimen reaching 100.7 meters.</li>
                                <li>Shorea faguetiana is endangered due to deforestation and habitat loss.</li>
                            </ul>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="content_con">
            <section class="class_border">
                <h2 id="lauraceae">Lauraceae</h2>
            </section>
            <div class="class_classification">
                <div class="fade_container">
                    <img src="./images/endiandra_bullata.jpg" alt="endiandra_bullata" class="fade_image">
                    <div class="fade_overlay">
                      <div class="fade_text"><a href="https://www.selinawamucii.com/plants/lauraceae/endiandra-bullata/">Endiandra bullataa</a></div>
                    </div>
                </div>                  
                <div class="class_textarea">
                    <dl>
                        <dt>Endiandra (Genus)</dt>
                        <dd>
                            Endiandra is a genus of over 126 species in the Lauraceae family of Laurel plants, mostly trees.
                            <ul>
                                <li>Found throughout Asia and Australia</li>
                                <li>Often used as screen trees in Australia</li>
                            </ul>
                        </dd>
                        <dt>Example Species:</dt>
                        <dd>
                            Endiandra bullata (Bullate False Walnut):
                            <ul>
                                <li>It belongs to the family Endiandra and is native to New Guinea.</li>
                                <li>With a trunk as tall as 10 m and a crown as wide as 15 m, this tree is medium in size</li>
                                <li>Endiandra bullata is used as a hedge plant and as an attractive plant in gardens. It is also utilized as a medical herb to cure conditions of the skin.</li>
                            </ul>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="content_con">
            <section class="class_border">
                <h2 id="burseraceae">Burseraceae</h2>
            </section>
            <div class="class_classification">
                <div class="fade_container">
                    <img src="./images/canarium_australasicum.jpg" alt="Canarium_australasicum" class="fade_image">
                    <div class="fade_overlay">
                      <div class="fade_text"><a href="https://en.wikipedia.org/wiki/Canarium_australasicum">Canarium Australasicum</a></div>
                    </div>
                </div>                  
                <div class="class_textarea">
                    <dl>
                        <dt>Canarium (Genus)</dt>
                        <dd>
                            Canarium is a genus of about 120 species of tropical and subtropical trees, in the family Burseraceae.
                            <ul>
                                <li>Found Tropical Africa, South Asia, Southeast Asia, and Pacific Islands.</li>
                                <li>Canarium species have pinnate leaves that are placed alternately and can reach enormous evergreen trees that reach heights of 40–50 m (130–160 ft).</li>
                            </ul>
                        </dd>
                        <dt>Example Species:</dt>
                        <dd>
                            Canarium Australasicum (Mango Bark):
                            <ul>
                                <li>It belongs to the family Burseraceae and is native to tropical and subtropical rainforests in eastern Queensland and northeastern New South Wales, Australia.</li>
                                <li>With a trunk as tall as 10 m and a crown as wide as 15 m, this tree is medium in size</li>
                                <li>Its timber, known as parsnip wood or mango bark, is used for light construction, joinery, and cabinet work. The tree's resin has traditional uses, and its fruit is edible, though not widely consumed commercially.</li>
                            </ul>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <?php
            include 'include/footer.inc';
            include 'include/back_top.inc';
        ?>
    </body>
</html>
