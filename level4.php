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
            background-image: url('doorswall.png');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .layer {
            position: absolute;
            
            transform: translate(-50%, -50%);
            /* cursor: pointer; */
        }

        .top-layer1 {
            z-index: 2;
            width: 84px;
            margin-left: 90px;
            margin-top: 140px;
            cursor: pointer;
        }
        .top-layer2 {
            z-index: 2;
            width: 84px;
            margin-left: 407px;
            margin-top: 140px;
            cursor: pointer;
        }
        .top-layer3 {
            z-index: 2;
            width: 84px;
            margin-left: 725px;
            margin-top: 140px;
            cursor: pointer;
        }
        .top-layer4 {
            z-index: 2;
            width: 84px;
            margin-left: 1040px;
            margin-top: 140px;
            cursor: pointer;
        }
        .top-layer5 {
            z-index: 2;
            width: 84px;
            margin-left: 1356px;
            margin-top: 140px;
            cursor: pointer;
        }
        .top-layer6 {
            z-index: 2;
            width: 84px;
            margin-left: 90px;
            margin-top: 410px;
            cursor: pointer;
        }
        .top-layer7 {
            z-index: 2;
            width: 84px;
            margin-left: 407px;
            margin-top: 410px;
            cursor: pointer;
        }
        .top-layer8 {
            z-index: 2;
            width: 84px;
            margin-left: 725px;
            margin-top: 410px;
            cursor: pointer;
        }
        .top-layer9 {
            z-index: 2;
            width: 84px;
            margin-left: 1040px;
            margin-top: 410px;
            cursor: pointer;
        }
        .top-layer10 {
            z-index: 2;
            width: 84px;
            margin-left: 1356px;
            margin-top: 410px;
            cursor: pointer;
        }
        .top-layer11 {
            z-index: 2;
            width: 84px;
            margin-left: 90px;
            margin-top: 680px;
            cursor: pointer;
        }
        .top-layer12 {
            z-index: 2;
            width: 84px;
            margin-left: 407px;
            margin-top: 680px;
            cursor: pointer;
        }
        .top-layer13 {
            z-index: 2;
            width: 84px;
            margin-left: 725px;
            margin-top: 680px;
            cursor: pointer;
        }
        .top-layer14 {
            z-index: 2;
            width: 84px;
            height: 164px;
            margin-left: 1040px;
            margin-top: 680px;
            cursor: pointer;
        }
        .top-layer141 {
            z-index: 2;
            width: 85px;
            height: 170px;
            margin-left: 1040px;
            margin-top: 680px;
            cursor: pointer;
        }
        .top-layer15 {
            z-index: 2;
            width: 84px;
            margin-left: 1356px;
            margin-top: 680px;
            cursor: pointer;
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

        /* Popup styles */
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
            z-index: 2;
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
        <img src="dooroption.png" class="layer top-layer1" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer2" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer3" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer4" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer5" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer6" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer7" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer8" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer9" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer10" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer11" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer12" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer13" id="topLayerImage" alt="Top Layer Image">
        <img src="opendoor.png" class="layer top-layer141" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer14" id="topLayerImage" alt="Top Layer Image">
        <img src="dooroption.png" class="layer top-layer15" id="topLayerImage" alt="Top Layer Image">
        <div class="box" id="innerBox">
            <img src="roll.png" alt="Inner Image">
        </div>
        </div>
    </div>
    <div class="bulb-icon" id="bulbIcon">
        <img src="bulbicon.png" alt="Bulb Icon" width="50" height="50">
    </div>

    <div class="hint" id="hint"></div>
    <canvas id="confetti-canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;"></canvas>
   

    <!-- Popup -->
    <div class="popup" id="popup">
        <img src="clue.png" alt="Popup Image">
        <button class="close-btn" id="closePopup">Close</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    
    <script>
        let wrongAttempts = 0;

// Function to handle layer clicks
function handleLayerClick(event) {
    const layer = event.currentTarget;

    if (layer.classList.contains('top-layer14')) {
        // Remove the clicked layer
        layer.style.display = 'none';
    } else if (layer.classList.contains('top-layer141')) {
        // Show SweetAlert to enter the room
        showEnterRoomAlert();
    } else {
        // Show wrong choice message
        wrongAttempts++;
        showWrongChoiceMessage();

        // Check if wrong attempts reached 3
        if (wrongAttempts >= 3) {
            showRetryAlert();
        }
    }
}

// Function to show wrong choice message
function showWrongChoiceMessage() {
    const wrongMessage = document.createElement('div');
    wrongMessage.textContent = 'Wrong choice!';
    wrongMessage.style.position = 'fixed';
    wrongMessage.style.top = '20px';
    wrongMessage.style.left = '50%';
    wrongMessage.style.transform = 'translateX(-50%)';
    wrongMessage.style.backgroundColor = 'rgba(255, 0, 0, 0.8)';
    wrongMessage.style.color = 'white';
    wrongMessage.style.padding = '10px';
    wrongMessage.style.borderRadius = '5px';
    wrongMessage.style.zIndex = '2';
    document.body.appendChild(wrongMessage);

    // Remove message after 1 second
    setTimeout(() => {
        document.body.removeChild(wrongMessage);
    }, 1000);
}

// Function to show SweetAlert for retry
function showRetryAlert() {
    swal({
        title: "Try Again!",
        text: "You have made too many wrong choices. Reloading the page.",
        icon: "warning",
        buttons: false,
        timer: 2000,
    }).then(() => {
        location.reload(); // Reload the page after the alert
    });
}

// Function to show SweetAlert to enter the room
function showEnterRoomAlert() {
    swal({
        title: "Enter the Room",
        text: "Are you ready to enter the room?",
        icon: "info",
        buttons: {
            cancel: "Cancel",
            enter: {
                text: "Enter",
                value: "enter",
            }
        },
    }).then((value) => {
        if (value === "enter") {
            window.location.href = "level4-2.php"; // Redirect to the next page
        }
    });
}

// Attach click event listeners to layers
document.querySelectorAll('.layer').forEach(layer => {
    layer.addEventListener('click', handleLayerClick);
});

document.getElementById('innerBox').addEventListener('click', function() {
    document.getElementById('popup').style.display = 'block'; // Show the popup
});

document.getElementById('closePopup').addEventListener('click', function() {
    document.getElementById('popup').style.display = 'none'; // Close the popup
});

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

    </script>
</body>
</html>
