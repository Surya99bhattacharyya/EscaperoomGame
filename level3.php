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
    <title>Nested Popup Example</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalnia+Glaze:wght@100..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+DE+Grund:wght@100..400&family=Quicksand:wght@300..700&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&family=VT323&display=swap" rel="stylesheet">
    <style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Cinzel Decorative', cursive;
    }
    
    .background-container {
        position: relative;
        height: 100vh; /* Full viewport height */
        background-image: url('level3bg.jpg');
        background-size: cover; /* Ensures the image covers the entire container */
        background-position: center; /* Centers the background image */
        background-repeat: no-repeat; /* Prevents the background from repeating */
    }
    .overlay-heading {
            position: absolute;
            top: 7%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            text-align: center;
        }
    
    .overlay-image {
        position: absolute;
        top: 18%; /* Position the image at the vertical center */
        left: 50%; /* Position the image at the horizontal center */
        transform: translate(-50%, -50%); /* Center the image */
        max-width: 200px; /* Limit the image size (adjust as needed) */
        max-height: 200px;
        cursor: pointer; /* Change cursor to pointer on hover */
    }
    .overlay-image1 {
        position: absolute;
        top: 65%; /* Position the image at the vertical center */
        left: 49.4%; /* Position the image at the horizontal center */
        transform: translate(-50%, -50%); /* Center the image */
        max-width: 80px; /* Limit the image size (adjust as needed) */
        max-height: 80px;
        cursor: pointer; /* Change cursor to pointer on hover */
        transition: transform 0.5s ease-in-out; /* Smooth transition for rotation */
    }


    .rotate-180 {
        transform: translate(-50%, -50%) rotate(180deg); /* Rotate by 180 degrees */
        transition: transform 3s ease;
    }

    .timer {
            position: absolute;
            top: 10%;
            right: 5%;
            color: white;
            font-size: 28px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
    

    .popup-image-container, .popup-content-container {
        display: none; /* Hidden by default */
        position: fixed; 
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000; /* On top of other content */
        background-color: rgba(0, 0, 0, 0);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .popup-image {
        max-width: 80%; /* Adjust size as needed */
        max-height: 80%;
        cursor: pointer;
    }

    .popup-background, .popup-background-content {
        display: none; /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
        z-index: 999; /* Behind the popup but on top of other content */
    }

    .puzzle-container {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-template-rows: repeat(3, 100px);
            gap: 2px;
            margin-bottom: 20px;
        }

        .puzzle-piece {
            width: 100px;
            height: 100px;
            background-image: url('puzzle.png'); /* Replace with your image URL */
            background-size: 300px 300px;
            cursor: pointer;
            border: 1px solid #ccc;
            box-sizing: border-box;
            transition: transform 0.2s;
        }

        .puzzle-piece.selected {
            border: 2px solid red;
            transform: scale(1.05);
        }

        .controls {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .controls button {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #00000000;
            color: rgb(228, 173, 109);
            border-radius: 5px;
            transition: transform 0.3s ease;
            font-family: 'Cinzel Decorative', cursive;
            font-weight: 600;
        }

        .controls button:hover {
            transform: scale(1.1);
        }

        .arrow-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr ;
            gap: 30px;
        }

        .arrow-buttons button {
            width: 40px;
            height: 40px;
            font-size: 16px;
            padding: 0;
        }
        .keypad-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1001;
            background: url(calbg.jpg) no-repeat center center/cover;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: rgb(228, 173, 109);
            font-family: 'Cinzel Decorative', cursive;
        }

        .keypad-button {
            width: 50px;
            height: 50px;
            margin: 5px;
            font-size: 20px;
            cursor: pointer;
            border: none;
            background: url(keybg.png) no-repeat center center/cover;
            color: rgb(59, 20, 20);
            border-radius: 5px;
            transition: background-color 0.3s;
            font-family: 'Cinzel Decorative', cursive;
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
    <div class="background-container">
        <div class="overlay-heading">Open the lock to get clue!</div>
        <div class="timer" id="timer">100</div>
        <img src="box.png" alt="Overlay Image" class="overlay-image" id="overlayImage">
        <img src="lockroll.png" alt="Overlay Image" class="overlay-image1" id="overlay-image1">
    </div>
    <audio id="rotationSound" src="gear.mp3"></audio>
   

    <div class="bulb-icon" id="bulbIcon">
        <img src="bulbicon.png" alt="Bulb Icon" width="50" height="50">
    </div>

    <div class="hint" id="hint"></div>

    <!-- Popup Background for First Image -->
    <div class="popup-background" id="popupBackground"></div>

    <!-- First Popup Image -->
    <div class="popup-image-container" id="popupContainer">
        <img src="boxopen.png" alt="Popup Image" class="popup-image" id="popupImage">
    </div>

    <!-- Popup Background for HTML Content -->
    <div class="popup-background-content" id="popupBackgroundContent"></div>

    <!-- Second Popup Content -->
    <div class="popup-content-container" id="popupContentContainer">
        <div class="puzzle-container" id="puzzle-container"></div>

    <div class="controls">
        <div class="arrow-buttons">
            <button onclick="move('left')" style="margin-right: 30px;"><img src="leftpng.png" style="height:50px;"></button>
            <button onclick="move('up')" style="margin-left: 16px;" ><img src="uppng.png" style="width:50px;"></button>
            <button onclick="move('right')" style="margin-left: -16px;"><img src="rightpng.png" style="height:50px;"></button>
            <button onclick="move('down')" style="margin-left: 16px;"><img src="downpng.png" style="width:50px; padding-left: 100px;"></button>
        </div>
        <br>
        <button onclick="shufflePuzzle()">Shuffle</button>
        <button onclick="checkSolution()">Check Solution</button>
    </div>
    </div>

    <div class="keypad-popup" id="keypadPopup">
        <h2>Enter the Code</h2>
        <div id="keypadDisplay" style="margin-bottom: 10px; font-size: 24px;"></div>
        <div>
            <button class="keypad-button" onclick="enterKey('1')">1</button>
            <button class="keypad-button" onclick="enterKey('2')">2</button>
            <button class="keypad-button" onclick="enterKey('3')">3</button>
        </div>
        <div>
            <button class="keypad-button" onclick="enterKey('4')">4</button>
            <button class="keypad-button" onclick="enterKey('5')">5</button>
            <button class="keypad-button" onclick="enterKey('6')">6</button>
        </div>
        <div>
            <button class="keypad-button" onclick="enterKey('7')">7</button>
            <button class="keypad-button" onclick="enterKey('8')">8</button>
            <button class="keypad-button" onclick="enterKey('9')">9</button>
        </div>
        <div>
            <button class="keypad-button" onclick="clearKey()">C</button>
            <button class="keypad-button" onclick="enterKey('0')">0</button>
            <button class="keypad-button" onclick="submitKey()">></button>
        </div>
    </div>

    <script>
        const overlayImage = document.getElementById('overlayImage');
        const popupBackground = document.getElementById('popupBackground');
        const popupContainer = document.getElementById('popupContainer');
        const popupImage = document.getElementById('popupImage');

        const popupBackgroundContent = document.getElementById('popupBackgroundContent');
        const popupContentContainer = document.getElementById('popupContentContainer');
        const closePopup = document.getElementById('closePopup');

        // Show first popup and hide overlay image on image click
        overlayImage.addEventListener('click', function() {
            overlayImage.style.display = 'none'; // Hide the overlay image
            popupBackground.style.display = 'block'; // Show the popup background
            popupContainer.style.display = 'block'; // Show the popup image
        });

        // Hide first popup and show second popup when clicking the first popup image
        popupImage.addEventListener('click', function() {
            popupBackground.style.display = 'none'; // Hide first popup background
            popupContainer.style.display = 'none'; // Hide first popup image
            popupBackgroundContent.style.display = 'block'; // Show second popup background
            popupContentContainer.style.display = 'block'; // Show second popup content
        });

        // Hide the second popup and its background on close button click
        closePopup.addEventListener('click', function() {
            popupBackgroundContent.style.display = 'none';
            popupContentContainer.style.display = 'none';
        });

        // Optionally hide the second popup when clicking outside the content
        popupBackgroundContent.addEventListener('click', function() {
            popupBackgroundContent.style.display = 'none';
            popupContentContainer.style.display = 'none';
        });
    </script>
    <script>
        const puzzleContainer = document.getElementById('puzzle-container');
        let pieces = [];
        let selectedPieceIndex = null;

        // Create the puzzle pieces
        function createPuzzle() {
            for (let i = 0; i < 9; i++) {
                const piece = document.createElement('div');
                piece.className = 'puzzle-piece';
                piece.style.backgroundPosition = `${(i % 3) * -100}px ${(Math.floor(i / 3) * -100)}px`;
                piece.dataset.index = i;

                piece.addEventListener('click', () => selectPiece(piece));
                pieces.push(piece);
                puzzleContainer.appendChild(piece);
            }
        }

        // Shuffle the puzzle pieces
        function shufflePuzzle() {
            do {
                pieces.sort(() => Math.random() - 0.5);
            } while (!isSolvable());
            updatePuzzle();
        }

        // Check if the puzzle is solvable (for a 3x3 grid)
        function isSolvable() {
            let inversions = 0;
            for (let i = 0; i < pieces.length - 1; i++) {
                for (let j = i + 1; j < pieces.length; j++) {
                    if (pieces[i].dataset.index > pieces[j].dataset.index) inversions++;
                }
            }
            return inversions % 2 === 0;
        }

        // Update the puzzle grid based on the pieces array
        function updatePuzzle() {
            puzzleContainer.innerHTML = '';
            pieces.forEach(piece => puzzleContainer.appendChild(piece));
        }

        // Select a piece when clicked
        function selectPiece(piece) {
            if (selectedPieceIndex !== null) {
                pieces[selectedPieceIndex].classList.remove('selected');
            }
            selectedPieceIndex = pieces.indexOf(piece);
            pieces[selectedPieceIndex].classList.add('selected');
        }

        // Move the selected piece based on arrow key input
        function move(direction) {
            if (selectedPieceIndex === null) return;

            const selectedRow = Math.floor(selectedPieceIndex / 3);
            const selectedCol = selectedPieceIndex % 3;
            let targetIndex;

            switch (direction) {
                case 'up':
                    if (selectedRow > 0) {
                        targetIndex = selectedPieceIndex - 3;
                    }
                    break;
                case 'down':
                    if (selectedRow < 2) {
                        targetIndex = selectedPieceIndex + 3;
                    }
                    break;
                case 'left':
                    if (selectedCol > 0) {
                        targetIndex = selectedPieceIndex - 1;
                    }
                    break;
                case 'right':
                    if (selectedCol < 2) {
                        targetIndex = selectedPieceIndex + 1;
                    }
                    break;
            }

            if (targetIndex !== undefined) {
                [pieces[selectedPieceIndex], pieces[targetIndex]] = [pieces[targetIndex], pieces[selectedPieceIndex]];
                updatePuzzle();
                selectPiece(pieces[targetIndex]);  // Update the selected piece after moving
            }
        }

        // Check if the puzzle is solved
        function checkSolution() {
            const isSolved = pieces.every((piece, index) => piece.dataset.index == index);
            if (isSolved) {
                
                document.getElementById('keypadPopup').style.display = 'block';
               
        popupContentContainer.style.display = 'none';
                popupBackgroundContent.style.display = 'none';
            } else {
                Swal.fire({
                        title: 'Wrong Code!',
                        text: 'Please try again!',
                        icon: 'error',
                        confirmButtonText: 'Retry'
                    });
                    display.textContent = '';
                
            }
        }

        // Initialize the puzzle
        createPuzzle();
        shufflePuzzle();

        let enteredCode = '';

        function enterKey(key) {
            if (enteredCode.length < 3) {
                enteredCode += key;
                document.getElementById('keypadDisplay').textContent = enteredCode;
                
            }
        }

        function clearKey() {
            enteredCode = '';
            document.getElementById('keypadDisplay').textContent = enteredCode;
        }

        function submitKey() {
            if (enteredCode === '194') {
                Swal.fire({
                        title: 'Correct Code!',
                        text: 'The door is unlocked!',
                        icon: 'success',
                        confirmButtonText: 'Enter'
                    }).then(() => {
                        document.getElementById('keypadPopup').style.display = 'none';
                rotateOverlayImage(); // Redirect to the next page
                    });
                
                
            } else {
                Swal.fire({
                        title: 'Wrong Code!',
                        text: 'Please try again!',
                        icon: 'error',
                        confirmButtonText: 'Retry'
                    });
                    display.textContent = '';
                }
                clearKey();
                
            }
            
        function rotateOverlayImage() {
    const overlayImage1 = document.getElementById('overlay-image1');
    
    overlayImage1.classList.add('rotate-180');
    setTimeout(() => {
        Swal.fire({
                        title: 'Congratulations!',
                        text: 'The door is unlocked!',
                        icon: 'success',
                        confirmButtonText: 'Next'
                    }).then(() => {
                        window.location.href = 'level4start.php'; // Redirect to the next page
                    });
}, 3000);

const rotatingImage = document.getElementById('overlay-image1');
        const rotationSound = document.getElementById('rotationSound');

        rotatingImage.addEventListener('click', () => {
            // Trigger the rotation by adding the 'rotate-active' class
            rotatingImage.classList.add('rotate-active');

            // Play the audio
            rotationSound.play();

            // Remove the 'rotate-active' class after the rotation is complete
            setTimeout(() => {
                rotatingImage.classList.remove('rotate-active');
            }, 2000); // Duration should match the CSS transition time (2s)
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
            showHint('Find the code to unlock the circular lock!');
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
