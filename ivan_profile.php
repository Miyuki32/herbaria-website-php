<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Ivan</title>
        <meta name="author" content="Ivan Liang Jin Ngu">
        <meta name="keywords" content="profile">
        <meta name="description" content="Profile page of Ivan Liang Jin Ngu.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/style.css">
        <link rel="icon" href="./images/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    </head> 
    <body id="ivan_profile_body">
        <?php
            include 'include/header.inc';
        ?>
        <section class="ivan_profile_container">
            <img src="./images/ivan.jpg" alt="image" id="ivan_profile_img">
            <div class="ivan_profile_desc">
                <p class="ivan_profile_name">Ivan Liang Jin Ngu</p>
                <p class="ivan_profile_id">104381576</p>
                <p class="ivan_profile_description">Bachelor of Computer Science</p>
            </div>
			<div class="ivan_profile_table_container">
				<table class="ivan_profile_table">
                    
			        <tr>
						<th>About me</th>
					</tr>

                    <tr>
                        <td>I was born on the 18th of March 2005 in Kuching Sarawak, which makes me 19 years old this year. I am a guy who enjoys and is keen to learn about the latest technologies from around the globe. I am also fascinated with turn-based RPGs, and I spend most of my free time playing games related to that genre.</td>
					</tr>

                    <tr>
                        <th>My Hometown</th>
                    </tr>
                        
                    <tr>
                        <td>My hometown is an awesome city in Borneo in Malaysia. Dubbed as a place with a rich history and cultural diversity, Kuching experiences a combination of modern and traditional ways of living. The city is diverse, and different peoples occupy it. Malays, Chinese, Iban, Bidayuh, and other indigenous communities live in Kuching. All of these factors contribute to the multicultural charm.</td>
                    </tr>

                    <tr>
                        <th>Achievements</th>
                    </tr>

                    <tr>
                        <td>Up to this point, I would say my achievements are scoring 4As in my SPM and finishing my Foundation studies.</td>
                    </tr>

                    <tr>
                        <th>Hobbies</th>
                    </tr>

                    <tr>
                        <td id="ivan_hobby">
                            I usually spend most of my free time playing turn-based RPGs. Here is the list:
                            <ul>
                                <li>Shin Megami Tensei V</li>
                                <li>Persona 3 Reload</li>
                                <li>Persona 4 Golden</li>
                                <li>Persona 5 Royal</li>
                                <li>Metaphor Refantazio</li>
                                <li>Tokyo Mirage Sessions ♯FE</li>
                                <li>Octopath Traveler</li>
                                <li>Octopath Traveler 2</li>
                                <li>Pokemon Violet</li>
                                <li>Pokemon Sword</li>
                            </ul>
                        </td>
                    </tr>
				</table>
                <br>
                <a href="mailto:104381576@students.swinburne.edu.my"><span class="ivan_email_button">Email me</span></a>
			</div>
        </section>
        <?php
            include 'include/footer.inc';
        ?>
    </body>
</html>
