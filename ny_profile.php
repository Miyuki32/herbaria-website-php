<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Neng Yi</title>
        <meta name="author" content="Neng Yi Chieng">
        <meta name="keywords" content="profile, Herbarium">
        <meta name="description" content="profile page of Neng Yi Chieng">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/style.css">
        <link rel="stylesheet" href="./style/ny_profile.css">
        <link rel="icon" href="./images/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    </head> 
    <body class="ny_profile_body">
        <?php
            include 'include/header.inc';
        ?>

        <section class="ny_profile_container">
            <div class="ny_profile_desc">
                <img src="./images/ny.jpg" alt="image" id="ny_profile_img">
                <p class="ny_profile_name">Neng Yi Chieng</p>
                <p class="ny_profile_id">104386364</p>
                <p class="ny_profile_description">Bachelor of Computer Science</p>
            </div>
			<div class="ny_profile_table_container">
				<table class="ny_profile_table">
                    
			        <tr>
						<th>About me</th>
					</tr>

                    <tr>
                        <td>I was born on 9 August 2005 in Sarikei, Sarawak. I am loving in learning and try new things.</td>
					</tr>

                    <tr>
                        <th>My Hometown</th>
                    </tr>
                        
                    <tr>
                        <td>Sarikei is a small town.  It is famous for its agriculture, especially the cultivation of pineapples and pepper.The town is culturally diverse, with a mix of Iban, Chinese, Malay, and Melanau communities</td>
                    </tr>

                    <tr>
                        <th>Achievements</th>
                    </tr>

                    <tr>
                        <td>My achievements are score 3A 5B in my SPM. </td>
                    </tr>

                    <tr>
                        <th>Hobbies</th>
                    </tr>

                    <tr>
                        <td>I usually play games and do gym during my free time. I love to play souls like game like Dark souls 3, Lies of P and so on.</td>
                    </tr>
				</table>
			</div>
            <a href="mailto:104386364@students.swinburne.edu.my"><span class="ny_email_button">Email Me</span></a>
        </section>
        <?php
            include 'include/footer.inc';
        ?>
    </body>
</html>
