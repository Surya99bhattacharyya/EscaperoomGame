
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
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layered Images</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Cinzel Decorative', cursive;
        }

        .bg-image {
            background-image: url('level3bg.png');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .overlay-heading {
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            text-align: center;
        }

        .layer {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .top-layer {
            z-index: 2;
            width: 150px;
            margin-left: -90px;
            margin-top: 40px;
            
        }

        .middle-layer {
            z-index: 1;
            width: 700px;
            margin-left: -90px;
            margin-top: 10px;
        }

        .floating-card {
            position: absolute;
            top: 70%;
            left: 50%;
            
            transform: translate(-50%, -50%);
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #ccc;
            background-color: rgba(255, 255, 255, 0.383);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
            display: none;
            z-index: 3;
            width: 100px;
            height: 100px;
            margin-left: 500px;
        }

        .floating-card img {
            width: 800px;
            height: auto;
        }
    </style>
</head>
<body>
    <audio autoplay loop>
        <source src="music1.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <div class="bg-image">
        <div class="overlay-heading">Get the clue</div>
        <img src="roll.png" class="layer top-layer" id="topLayerImage" alt="Top Layer Image">
        <img src="open.png" class="layer middle-layer" id="middleLayerImage" alt="Middle Layer Image">
        <div class="floating-card" id="floatingCard">
            
        </div>
    </div>
    <canvas id="confetti-canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        document.getElementById('topLayerImage').addEventListener('click', function() {
            // Move the top layer image to the floating card
            document.getElementById('floatingCard').style.display = 'block';
            document.getElementById('floatingCard').appendChild(this);
            this.style.marginLeft = '0';
            this.style.marginTop = '0';
            this.style.width = '100%';

            // Show SweetAlert for the new riddle
            swal({
                title: "New Riddle Found!",
                text: "You have found a hidden object.",
                icon: "success",
                buttons: {
                    ok: {
                        text: "OK",
                        value: "ok",
                    }
                }
            }).then((value) => {
                if (value === "ok") {
                    const confettiSettings = { target: 'confetti-canvas' };
                    const confetti = new ConfettiGenerator(confettiSettings);
                    confetti.render();
                    swal({
                        title: "Go to Next Level!",
                        text: "Congratulations! You're ready for the next challenge.",
                        icon: "success",
                        buttons: {
                            next: {
                                text: "Next",
                                value: "next",
                            }
                        }
                    }).then((value) => {
                        if (value === "next") {
                            // Redirect to the next page or perform any other action
                            window.location.href = 'addpoints3.php'; // replace 'next_page.html' with your next page URL
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
