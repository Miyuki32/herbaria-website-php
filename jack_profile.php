<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Jack</title>
        <meta name="author" content="Jack">
        <meta name="keywords" content="profile">
        <meta name="description" content="Profile page of Jack.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/style.css">
        <link rel="stylesheet" href="./style/jack_profile.css">
        <link rel="icon" href="./images/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    </head> 
    <body class="jack_profile_body">
        <?php
            include 'include/header.inc';
        ?>
        <section class="jack_profile_container">
            <div class="jack_profile_desc">
                <img src="./images/jack.jpg" alt="image" id="jack_profile_img">
                <p class="jack_profile_name">Omar ALEMADI (Jack)</p>
                <p class="jack_profile_id">102779386</p>
                <p class="jack_profile_description">Bachelor of Computer Science</p>
            </div>
			<div class="jack_profile_table_container">
				<table class="jack_profile_table">
                    
			        <tr>
						<th>About me</th>
					</tr>

                    <tr>
                        <td>I was born in Syria and raised between Lebanon and Saudi Arabia, and I now reside in Malaysia. I am currently studying computer science, diving into the world of tech with a passion for learning and innovation. My diverse background has shaped my perspective, and I’m excited to see where this journey in tech will take me.</td>
					</tr>

                    <tr>
                        <th>Achievements</th>
                    </tr>

                    <tr>
                        <td> I graduated high school with honors and completed a foundation degree, both of which have given me a solid academic base to pursue my current studies in computer science.</td>
                    </tr>

                    <tr>
                        <th>Hobbies</th>
                    </tr>

                    <tr>
                        <td>In my free time, I love drawing and editing. Whether it’s creating digital art or working on edits, these hobbies help me express my creativity and refine my artistic skills. </td>
                    </tr>

                    <tr>
                        <th>Goals</th>
                    </tr>

                    <tr>
                        <td>My immediate goal is to graduate from my current course in computer science. After that, I plan to pursue another bachelor's degree in humanities, combining my interests in both technology and the human experience. </td>
                    </tr>
				</table>
                <a href="mailto:102779386@students.swinburne.edu.my"><span class="jack_email_button">Email me</span></a>
			</div>
        </section>
        <?php
            include 'include/footer.inc';
        ?>
    </body>
</html>
