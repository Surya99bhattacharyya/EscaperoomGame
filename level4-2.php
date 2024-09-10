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
            background-image: url('room4.jpg');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .overlay-heading {
            position: absolute;
            top: 20%;
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
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            cursor: pointer;
        }

        .middle-layer1 { z-index: 1; width: 150px; }
        .middle-layer2 { z-index: 1; width: 100px; margin-left: 140px; }
        .middle-layer3 { z-index: 1; width: 100px; margin-left: -140px; }
        .middle-layer4 { z-index: 1; width: 350px; margin-top: 295px; }
        .middle-layer5 { z-index: 1; width: 150px; margin-top: 127px; margin-left: -5px; }
        .middle-layer6 { z-index: 1; width: 100px; margin-top: 145px; margin-left: -105px; }
        .middle-layer7 { z-index: 1; width: 100px; margin-top: 145px; margin-left: 100px; }
        .middle-layer8 { z-index: 1; width: 120px; margin-top: 190px; margin-left: -290px; }
        .middle-layer9 { z-index: 1; width: 500px; margin-top: 350px; margin-left: 620px; }
        
        .swal-overlay {
            background-color: rgba(0, 0, 0, 0.769); /* Semi-transparent background */
        }

        .swal-modal {
            background-color: rgba(226, 226, 226, 0.807); /* Semi-transparent popup */
        }

        /* Box for overlayed image */
        #image-box {
            position: absolute;
            bottom: 20px;
            left: 20px;
            width: 150px;
            height: 150px;
            border: 2px dashed white;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.5);
        }

        #image-box img {
            max-width: 100%;
            max-height: 100%;
        }
        .timer {
            position: absolute;
            top: 10%;
            right: 5%;
            color: white;
            font-size: 28px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            z-index: 3;
        }
        .hint {
            position: fixed;
            top: 50%;
            right: -300px;
            background-color: #b5b5b56c;
            color: #fdfdfd;
            padding: 20px;
            border-radius: 10px;
            font-size: 20px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: right 0.5s ease-in-out;
            width: 200px;
            z-index: 10;
        }

        .hint.show {
            right: 20px;
        }

        /* Bulb Icon Styles */
        .bulb-icon {
            position: absolute;
            top: 70px; /* Adjust as needed */
            right: 10px;
            cursor: pointer;
            transition: transform 0.2s;
            z-index: 2;
        }

        /* Shake Animation */
        @keyframes shake {
            0% { transform: translate(0); }
            25% { transform: translate(-5px); }
            50% { transform: translate(5px); }
            75% { transform: translate(-5px); }
            100% { transform: translate(0); }
        }

        .shake {
            animation: shake 0.5s infinite;
        }
        .box {
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 10px;
            border: 2px solid #ccc;
            background-color: rgba(255, 255, 255, 0.383);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
            z-index: 3;
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin-left: 500px;
        
        }

        .box img {
            width: 100px; /* Adjust the size of the inner image */
            height: auto;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0);
            padding: 20px;
            z-index: 10;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 500px;
        }

        .popup img {
            width: 100%; /* Make the popup image responsive */
            height: auto;
        }

        .close-btn {
            background-color: #7c2622; /* Red background */
            color: rgb(240, 179, 98); /* White text */
            border: none;
            border-radius: 10px;
            padding: 5px 10px;
            cursor: pointer;
            margin-top: 10px;
            margin-left: 45%;
            font-size: 15pt;
            font-family: 'Cinzel Decorative', cursive;
            font-weight: 600;
        
        }
        .close-btn:hover{
            background-color: #ad140b; /* Red background */
        }

        
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<audio autoplay loop>
    <source src="music1.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
    <div class="bg-image">
        <div class="timer" id="timer">100</div>
        <div class="overlay-heading">Find the clue to the next level!</div>
        <img src="photoframe.png" class="layer middle-layer1" alt="Photoframe" onclick="showPopup('photoframe.png', true)">
        <img src="rose.png" class="layer middle-layer2" alt="Rose" onclick="showPopup('rose.png')">
        <img src="rose.png" class="layer middle-layer3" alt="Rose" onclick="showPopup('rose.png')">
        <img src="table.png" class="layer middle-layer4" alt="Table" onclick="showPopup('table.png')">
        <img src="statue.png" class="layer middle-layer5" alt="Statue" onclick="showPopup('statue.png')">
        <img src="vase.png" class="layer middle-layer6" alt="Vase" onclick="showPopup('vase.png')">
        <img src="vase.png" class="layer middle-layer7" alt="Vase" onclick="showPopup('vase.png')">
        <img src="cl.png" class="layer middle-layer8" alt="Clock" onclick="showPopup('cl.png')">
        <img src="piano.png" class="layer middle-layer9" alt="Piano" onclick="showPopup('piano.png')">
        <div class="box" id="innerBox">
            <img src="roll.png" alt="Inner Image">
        </div>
    </div>
    <div id="image-box"></div>
    <canvas id="confetti-canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;"></canvas>
    <div class="bulb-icon" id="bulbIcon">
        <img src="bulbicon.png" alt="Bulb Icon" width="50" height="50">
    </div>
    <div class="hint" id="hint"></div>
    <div class="popup" id="popup">
        <img src="clue.png" alt="Popup Image">
        <button class="close-btn" id="closePopup">Close</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        let overlayImageAdded = false; // Track if overlay image is added to the box

        function showPopup(imageSrc, isLayer1 = false) {
            const overlayImageSrc = 'finalclue.png'; // Replace with your overlay image
            const popupContent = isLayer1 && !overlayImageAdded ? `
                <div id="popup-content" style="position: relative;">
                    <img src="${imageSrc}" alt="Popup Image" style="width: 100%; height: auto;">
                    <img src="${overlayImageSrc}" alt="Overlay Image" style="position: absolute; top: 70%; left: 45%; width: 7%; height: auto; cursor: pointer;" onclick="moveToBox('${overlayImageSrc}')">
                </div>` : `
                <img src="${imageSrc}" alt="Popup Image" style="width: 100%; height: auto;">`;

            swal({
                content: {
                    element: "div",
                    attributes: {
                        innerHTML: popupContent,
                    },
                },
                buttons: false,
                closeOnClickOutside: true,
                closeOnEsc: true,
            });
        }

        function moveToBox(imageSrc) {
            const imageBox = document.getElementById('image-box');
            const imgElement = document.createElement('img');
            imgElement.src = imageSrc;
            imageBox.appendChild(imgElement);
            
            overlayImageAdded = true; // Set the flag to true

            // Remove the overlay image from the popup
            const popupContent = document.getElementById('popup-content');
            if (popupContent) {
                popupContent.innerHTML = ''; // Clear the popup content
            }

            swal.close(); // Close the popup

            // Show SweetAlert for the new riddle
            swal({
                text: "New Riddle Unlocked!",
                buttons: {
                    ok: "OK",
                },
                className: "", // No custom styles
            }).then((value) => {
                if (value) {
                    // Show welcome message for the final level
                    swal({
                        text: "Welcome to Final Level!",
                        buttons: {
                            next: "Next",
                        },
                        className: "", // No custom styles
                    }).then((nextValue) => {
                        if (nextValue) {
                            window.location.href = "addpoints4.php"; // Change to your next page URL
                        }
                    });
                }
            });
        }
        let timeLeft = 100;
        const timerElement = document.getElementById('timer');
        const timerInterval = setInterval(() => {
            if (timeLeft > 0) {
                timeLeft--;
                timerElement.textContent = `${timeLeft}`;
            } else {
                clearInterval(timerInterval);
                Swal.fire({
                    title: 'Time Up!',
                    text: 'Do you want to retry?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Retry',
                    cancelButtonText: 'Exit'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload(); // Restart the game
                    } else {
                        window.location.href = 'dashboard.php'; // Redirect to an exit or different page
                    }
                });
            }
        }, 1000);
        window.onload = function() {
        
        startBulbShake();
    };
    function startBulbShake() {
        setTimeout(() => {
            bulbIcon.classList.add('shake');
        }, 5000);
    }

    bulbIcon.addEventListener('click', function() {
        showHint('Find the door, from the riddle you got!');
    });

    function showHint(message) {
        hint.textContent = message;
        hint.classList.add('show');
        setTimeout(() => {
            hint.classList.remove('show');
        }, 3000);
    }
    document.getElementById('innerBox').addEventListener('click', function() {
    document.getElementById('popup').style.display = 'block'; // Show the popup
});

document.getElementById('closePopup').addEventListener('click', function() {
    document.getElementById('popup').style.display = 'none'; // Close the popup
});
    </script>
</body>
</html>
