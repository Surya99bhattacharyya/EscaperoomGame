
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
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Cinzel Decorative', cursive;
        }

        .bg-image {
            background-image: url('level5bg.jpg');
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
            cursor: pointer;
        }

        .top-layer1 {
            z-index: 2;
            width: 150px;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .top-layer2 {
            z-index: 2;
            width: 210px;
            top: 54%;
            left: 51%;
            transform: translate(-50%, -50%);
        }

        .top-layer3 {
            z-index: 3;
            width: 90px;
            top: 71.6%;
            left: 50.2%;
            transform: translate(-50%, -50%);
        }

        .overlayed-layer {
            z-index: 4;
            width: 50px;
            top: 71%;
            left: 50.2%;
            transform: translate(-50%, -50%);
            display: none; /* Initially hidden */
        }

        .drawer-open {
            width: 125px;
            top: 73.3%;
            left: 50.2%;
            transform: translate(-50%, -50%);
        }
        

        /* Popup Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 5; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.7); /* Black w/ opacity */
            text-align: center;
        }

        .modal-content {
            background-color: #fefefeb2;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #fffbfb;
            width: 20%; /* Could be more or less, depending on screen size */
            position: relative; /* Position relative to enable positioning of the overlay */
            border-radius: 20px;
        }

        .overlay-image {
            position: absolute; /* Position absolute to overlay */
            top: 50%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Center the image */
            width: 30px; /* Size of the overlay image */
            display: none; /* Initially hidden */
        }

        .overlay-image1 {
            position: absolute; /* Position absolute to overlay */
            top: 65%; /* Center vertically */
            left: 60%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Center the image */
            width: 130px; /* Size of the overlay image */
            display: none; /* Initially hidden */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Additional overlay image modal */
        .overlay-image-modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 6; /* Sit on top of the previous modal */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
            text-align: center;
        }

        .overlay-image-modal-content {
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        .final-heading {
            color: white;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .next-button {
            background-color: #7c2622; /* Red background */
            color: rgb(240, 179, 98); /* White text */
            border: none;
            border-radius: 10px;
            padding: 5px 10px;
            cursor: pointer;
            margin-top: 10px;
            
            font-size: 15pt;
            font-family: 'Cinzel Decorative', cursive;
            font-weight: 600;
        
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
        .newbox {
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

        .newbox img {
            width: 80%; /* Adjust the size of the inner image */
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
        <div class="overlay-heading">Find the final treasure</div>
        
        <img src="soldiertable.png" class="layer top-layer1" id="topLayerImage1" alt="Top Layer Image 1">
        <img src="backsoldier.png" class="layer top-layer2" id="topLayerImage2" alt="Top Layer Image 2">
        <img src="drawercl.png" class="layer top-layer3" id="topLayerImage3" alt="Top Layer Image 3">
        <img src="boxtressure.png" class="layer overlayed-layer" id="overlayedImage" alt="Overlayed Image">
        <div class="newbox" id="innerBox">
            <img src="finalclue.png" alt="Inner Image">
        </div>
    </div>
    <div class="bulb-icon" id="bulbIcon">
        <img src="bulbicon.png" alt="Bulb Icon" width="50" height="50">
    </div>

    <div class="hint" id="hint"></div>

    <div class="popup" id="popup">
        <img src="finalclue.png" alt="Popup Image">
        <button class="close-btn" id="closePopup">Close</button>
    </div>

    <!-- Popup Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Congratulations!</h2>
            <p>You found the treasure!</p>
            <img class="modal-img" src="opentressurebox.png" alt="Treasure" style="width:100%;"> <!-- Replace with your treasure image -->
            <img class="overlay-image1" src="roll.png" alt="Overlay" id="overlayImage"> <!-- Replace with your overlay image -->
        </div>
    </div>

    <!-- Additional overlay image modal -->
    <div id="overlayImageModal" class="overlay-image-modal">
        <div class="overlay-image-modal-content">
            <span class="close">&times;</span>
            <h2 class="final-heading">You have unlocked the treasure!</h2>
            <img src="final.png" alt="Overlay Full Image" style="width:500px;"> <!-- Replace with your full overlay image -->
            <br>
            <button class="next-button" onclick="goToNextPage()">Quit</button>
        </div>
    </div>

    <script>
        let clickCount = 0;

        document.getElementById('topLayerImage2').addEventListener('click', function() {
            if (clickCount === 0) {
                this.src = 'sidesoldier.png';
                clickCount++;
            } else if (clickCount === 1) {
                this.src = 'frontsoldier.png';
                clickCount++;
            }
        });

        document.getElementById('topLayerImage3').addEventListener('click', function() {
            if (clickCount === 2) {
                this.src = 'drawer1.png';
                this.classList.add('drawer-open');
                document.getElementById('overlayedImage').style.display = 'block'; // Show the overlayed image
            }
        });

        // Show modal when overlayed layer is clicked
        document.getElementById('overlayedImage').addEventListener('click', function() {
            document.getElementById('myModal').style.display = 'block'; // Show the modal
            document.getElementById('overlayImage').style.display = 'block'; // Show the overlay image
        });

        // Close the main modal when the close button is clicked
        document.getElementsByClassName('close')[0].onclick = function() {
            document.getElementById('myModal').style.display = 'none';
            document.getElementById('overlayImage').style.display = 'none'; // Hide the overlay image when modal is closed
        }

        // Close the main modal when clicking outside of the modal content
        window.onclick = function(event) {
            if (event.target == document.getElementById('myModal')) {
                document.getElementById('myModal').style.display = 'none';
                document.getElementById('overlayImage').style.display = 'none'; // Hide the overlay image when modal is closed
            }
        }

        // Show overlay image modal when overlay image is clicked
        document.getElementById('overlayImage').addEventListener('click', function() {
            document.getElementById('overlayImageModal').style.display = 'block'; // Show overlay image modal
        });

        // Close the overlay image modal when the close button is clicked
        document.getElementsByClassName('close')[1].onclick = function() {
            document.getElementById('overlayImageModal').style.display = 'none'; // Hide overlay image modal
        }
        document.addEventListener('DOMContentLoaded', function() {
    var box = document.getElementById('innerBox');
    var popup = document.getElementById('popup');
    var closeBtn = document.getElementById('closePopup');

    // Show the popup when the box is clicked
    box.addEventListener('click', function() {
        popup.style.display = 'block';
    });

    // Hide the popup when the close button is clicked
    closeBtn.addEventListener('click', function() {
        popup.style.display = 'none';
    });

    // Hide the popup when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target == popup) {
            popup.style.display = 'none';
        }
    });
});


        // Close the overlay image modal when clicking outside of the modal content
        window.onclick = function(event) {
            if (event.target == document.getElementById('overlayImageModal')) {
                document.getElementById('overlayImageModal').style.display = 'none'; // Hide overlay image modal
            }
        }

        function goToNextPage() {
            window.location.href = "addpoints5.php"; // Replace with your next page URL
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
        showHint('Find the way, from the riddle you got!');
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
