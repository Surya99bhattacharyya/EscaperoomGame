<?php
// include 'config.php';
// session_start();

// if (!isset($_SESSION['username'])) {
//     header("Location: login.html");
//     exit();
// }
// else{
//     header("Location:dashboard.php");
// }
//$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kalnia+Glaze:wght@100..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+DE+Grund:wght@100..400&family=Quicksand:wght@300..700&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: "Quicksand", sans-serif;
            overflow-x: hidden;
        }

        .video-background {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .video-background video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .centered-button {
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        
        }
        .centered-button p{
            color: #c97ce8;
            text-decoration: none;
            text-align: center;
            font-size: 14pt;
        }
        .centered-button a{
            text-decoration: none;
        }

        .button {
            display: inline-block;
            padding: 20px 40px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff00;
            text-align: center;
            text-decoration: none;
            border: 2px solid #fff;
            border-radius: 20px;
            transition: background-color 0.3s ease;
            font-size: 20pt;
        }

        .button:hover {
            box-shadow: 0px 8px 8px 0px rgba(230, 55, 233, 0.462);
            transform: scale(1.05);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }



        .content-section {
            padding: 50px 20px;
            background: linear-gradient(to bottom, #11004b, #830085);
            text-align: center;
            font-family: "Montserrat", sans-serif;
            color:#fff
            
        }
        .content-section h1{
            font-weight: 400;
            
        }

        .cards-section {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .card {
            width: 30%;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.6s ease, box-shadow 0.6s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            background-color: #9898987b;
            color: #fff;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card-body {
            padding: 10px;
            text-align: center;
            font-weight: 400;
        }

        .card-body h3{
            /* color: #ffffff; */
            font-weight: 700;
            font-size: 16pt;
        }

        .card-body p{
            text-align:justify;
            padding-left:20px;
            padding-right:20px;
        }

        .card-title {
            font-size: 1.2em;
            margin: 0;
            font-weight: 500;
        }

        footer {
            background-color: #340135;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .footer-widget {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            font-family: "Montserrat", sans-serif;

        }

        .footer-widget h2{
            font-weight: 300;
        }

        .footer-widget div {
            
            margin: 10px 0;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            background-color: #dddddd39;
            color:#fff;
            font-family: "Montserrat", sans-serif;
            width: 550px;
            margin: auto;
        }

        .contact-form button {
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #a336e2;
            color: #fff;
            border-radius: 20px;
            cursor: pointer;
            width: 100px;
            margin:auto;
            font-family: "Montserrat", sans-serif;
            transition: transform 0.6s ease, box-shadow 0.6s ease;
        
        }

        .contact-form button:hover {
            background-color: #5b1373;
            transform: scale(1.05);
        }

        .social-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
            text-align: center;
            background-color: #b6b6b62d;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 20px;
            
        }

        .social-links p{
            text-align: center;
            margin:auto;
        
            
        }
        .social-links img{
            margin: auto;
        }

        .social-links a {
            color: #fff;
            text-decoration: none;
        }

        .social-links a:hover {
            text-decoration: underline;
        }
        .social-icons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .social-icons a {
            display: inline-block;
            width: auto; /* Adjust size as needed */
            height: 40px;
            transition: transform 0.3s ease;
        }

        .social-icons a:hover {
            transform: scale(1.1);
        }

        .social-icons img {
            width: 100%;
            height: 100%;
        }
        .button1 {
    background-color: #880986;
            border: 1px solid #ccc; /* Remove border */
            color: white; /* White text */
            padding: 10px 20px; /* Some padding */
            text-align: center; /* Center the text */
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Make the link behave like a button */
            font-size: 14px; /* Increase font size */
            margin: auto; /* Add some margin */
            cursor: pointer; /* Pointer/hand icon on hover */
            border-radius: 20px; /* Rounded corners */
            transition: background-color 0.3s ease; /* Smooth transition */
            font-family: "Quicksand", sans-serif;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            
            
        }

        .button1 a {
            color: white; /* Ensure the link text is white */
            text-decoration: none; /* Remove underline from the link */
        }

        .button1:hover {
            background-color: rgb(56, 8, 81); /* Darker green on hover */
        }
    </style>
</head>
<body>
    <div class="video-background">
        <video autoplay muted loop id="bg-video">
            <source src="bg2.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="centered-button">
            <a href="process.php" class="button floating">Enter the Realm</a>
            <a href="#contact"><p>For your queries</p></a>
        </div>
        
    </div>

    <div class="content-section">
        <h1>YOUR EXPERIENCES</h1>
        <div class="cards-section">
            
            <div class="card">
                <img src="game2.jpg" alt="Game 1">
                <div class="card-body">
                    <h3 class="card-title">Welcome to the Adventure</h3><hr>
                    <p>Discover a world of captivating and visually stunning games at Attractive Adventures! Dive into thrilling quests, solve intricate puzzles, and embark on epic journeys that will keep you hooked for hours. Ready to play? Join us and let the adventure begin!</p>
                    <button class="button1"><a href=login.html>Know more</a></button>
                </div>
            </div>
            <div class="card">
                <img src="team.jpg" alt="Game 2">
                <div class="card-body">
                    <h3 class="card-title">Join the Squad</h3><hr>
                    <p>Join the Squad! Discover a world of exciting and visually stunning games. Dive into thrilling quests, solve intricate puzzles, and embark on epic journeys with friends. Ready to team up? Let the fun begin!</p><br>
                    <button class="button1"><a href=login.html>Know more</a></button>
                </div>
            </div>
            <div class="card">
                <img src="challenge.jpg" alt="Game 3">
                <div class="card-body">
                    <h3 class="card-title">Face the Challenge</h3><hr>
                    <p>Face the Challenge! Discover exciting and visually stunning games. Dive into thrilling quests, solve intricate puzzles, and embark on epic journeys. Ready to compete? Join us and let the battle begin!</p><br>
                    <button class="button1"><a href=login.html>Know more</a></button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-widget" id="contact" >
            <div>
                <h2>Contact Us</h2>
                <form id="contact-form" class="contact-form">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
                    <button type="submit">Send</button>
                </form>
            </div>
            <div>
                <h2>Get in Touch</h2>
                <div class="social-links">
                    <img src="call.png" style="max-width: 40px;">
                    <p>+3238393923</p>
                    <img src="mail.png" style="max-width: 40px;">   
                    <p>quantumverse@contact.com</p>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/yourprofile" target="_blank" title="Facebook">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook">
                        </a>
                        <a href="https://www.instagram.com/yourprofile" target="_blank" title="Instagram">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram">
                        </a>
                        <a href="https://www.youtube.com/yourprofile" target="_blank" title="YouTube" >
                            <img src="https://upload.wikimedia.org/wikipedia/commons/4/42/YouTube_icon_%282013-2017%29.png" alt="YouTube">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Font Awesome for social icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script><script>
        $(document).ready(function(){
            $("#contact-form").on("submit", function(e){
                e.preventDefault();

                $.ajax({
                    url: 'submit_contact.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if(response == 'success') {
                            swal("Success!", "Your message has been sent successfully!", "success");
                        } else {
                            swal("Error!", "There was an error submitting your message. Please try again.", "error");
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
