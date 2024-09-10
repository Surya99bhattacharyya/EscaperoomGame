<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
// else{
//     header("Location:dashboard.php");
// }
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mystery Mansion Escape</title>
    <link rel="stylesheet" href="stylegame1.css">
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
            background-color: #bababa66;
            text-align: center;
            text-decoration: none;
            border: 2px solid #fff;
            border-radius: 20px;
            transition: background-color 0.3s ease;
            font-size: 20pt;
        }

        .button:hover {
            box-shadow: 0px 8px 8px 0px rgba(255, 255, 255, 0.778);
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
        </style>

</head>
<body>
<audio autoplay loop>
    <source src="intro.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
<div class="video-background">
        <video autoplay muted loop id="bg-video">
            <source src="start2.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="centered-button">
            <a href="level2.php" class="button floating">Start</a>
        </div>
        
    </div>
    <script>document.addEventListener("DOMContentLoaded", function() {
    // Hide the button initially
    const enterButton = document.querySelector('.button');
    enterButton.style.display = 'none'; 

    // Show the button after a delay (e.g., 3 seconds)
    setTimeout(function() {
        enterButton.style.display = 'inline-block'; // Show the button
    }, 9000); // Change 3000 to the desired delay in milliseconds
});
</script>
    
</body>
</html>
