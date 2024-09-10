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
    <title>Image Overlay with Number Guessing</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalnia+Glaze:wght@100..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+DE+Grund:wght@100..400&family=Quicksand:wght@300..700&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&family=VT323&display=swap" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            font-family: 'Cinzel Decorative', cursive;
            position: relative; /* Added to position confetti correctly */
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

        .image-container {
            position: relative;
            max-width: 100%;
        }

        .background-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .overlay-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 2.5%;
            height: auto;
            object-fit: cover;
            opacity: 1;
            transition: opacity 0.5s ease;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.804);
            margin-top: 300px;
            margin-left: 710px;
        }

        .hidden {
            opacity: 0;
        }

        .keypad {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            flex-wrap: wrap;
            height: 350px;
            width: 300px;
            background: url(calbg.jpg) no-repeat center center/cover;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0.8, 0.8, 0.8);
            display: none;
            padding-left: 15px;
        }

        .keypad button {
            font-family: 'Cinzel Decorative', cursive;
            width: 60px;
            height: 60px;
            margin: 5px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 10px;
            background: url(keybg.png) no-repeat center center/cover;
        }

        .input-display {
            border-radius: 10px;
            width: 100%;
            height: 40px;
            text-align: center;
            font-size: 18px;
            border: none;
            margin-bottom: 5px;
            background: url(disbg.jpg) no-repeat center center/cover;
            margin-top: 20px;
            margin-right: 15px;
            font-family: "VT323", monospace;
            font-size: 30pt;
            color: #2d2d2da4;
        }

        .timer-display {
            position: absolute;
            top: 10px;
            right: 10px;
            font-family: 'Cinzel Decorative', cursive;
            font-size: 30pt;
            background-color: #00000000;
            color: #fff;
            padding: 10px;
            border-radius: 10px;
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

        /* Confetti Styles */
       
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <audio autoplay loop>
        <source src="music1.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    
    <div class="image-container">
        <div class="overlay-heading">Find the way out of this room!</div>
        <img src="olddoor.jpg" alt="Background Image" class="background-image">
        <img src="numlock.png" alt="Overlay Image" class="overlay-image" id="overlay">
    </div>

    <div class="keypad" id="keypad">
        <input type="text" id="inputDisplay" class="input-display" readonly>
        <button>1</button>
        <button>2</button>
        <button>3</button>
        <button>4</button>
        <button>5</button>
        <button>6</button>
        <button>7</button>
        <button>8</button>
        <button>9</button>
        <button>0</button>
        <button id="clear">C</button>
        <button id="submit">></button>
    </div>

    <div class="timer-display" id="timerDisplay">100</div>

    <div class="bulb-icon" id="bulbIcon">
        <img src="bulbicon.png" alt="Bulb Icon" width="50" height="50">
    </div>

    <div class="hint" id="hint"></div>

    <script>
        let predefinedNumber = Math.floor(Math.random() * (300 - 100 + 1)) + 100;
        console.log('Predefined Number:', predefinedNumber);
        const overlay = document.getElementById('overlay');
        const keypad = document.getElementById('keypad');
        const inputDisplay = document.getElementById('inputDisplay');
        const clearButton = document.getElementById('clear');
        const submitButton = document.getElementById('submit');
        const timerDisplay = document.getElementById('timerDisplay');
        const hint = document.getElementById('hint');
        const bulbIcon = document.getElementById('bulbIcon');

        let timer;
        let timeLeft = 100;

        window.onload = function() {
            startTimer();
            startBulbShake();
        };

        overlay.addEventListener('click', function() {
            keypad.style.display = 'flex';
        });

        document.querySelectorAll('.keypad button').forEach(button => {
            button.addEventListener('click', function() {
                if (this.id === 'clear') {
                    inputDisplay.value = '';
                } else if (this.id === 'submit') {
                    checkGuess();
                } else {
                    inputDisplay.value += this.textContent;
                }
            });
        });

        function startTimer() {
            timer = setInterval(function() {
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    showRetryAlert();
                } else {
                    timeLeft--;
                    timerDisplay.textContent = timeLeft;
                }
                console.log(timeLeft);
            }, 1000);
        }

        function startBulbShake() {
            setTimeout(() => {
                bulbIcon.classList.add('shake');
            }, 5000);
        }

        bulbIcon.addEventListener('click', function() {
            showHint('Find the number between 100 & 300!');
        });

        function showHint(message) {
            hint.textContent = message;
            hint.classList.add('show');
            setTimeout(() => {
                hint.classList.remove('show');
            }, 3000);
        }

        function showRetryAlert() {
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

        function checkGuess() {
            const guess = parseInt(inputDisplay.value, 10);
            console.log('Guess:', guess);
            if (isNaN(guess)) {
                alert('Please enter a valid number.');
                return;
            }

            if (guess < predefinedNumber) {
                showHint('The number is higher.');
            } else if (guess > predefinedNumber) {
                showHint('The number is lower.');
            } else {
                showConfetti(); // Show confetti on correct guess
                showCongratulatoryAlert();
                clearInterval(timer);
                keypad.style.display = 'none';
                resetGame();
            }
        }

        function showConfetti() {
            for (let i = 0; i < 100; i++) {
                createConfetti();
            }
        }

        function createConfetti() {
            const colors = ['#FF0D72', '#0DC2FF', '#0DFF72', '#F9FF0D', '#FF0DAB'];
            const confetti = document.createElement('div');
            confetti.classList.add('confetti');
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
            document.body.appendChild(confetti);
            setTimeout(() => {
                confetti.remove();
            }, 4000); // Remove confetti after 4 seconds
        }

        function showCongratulatoryAlert() {
            
            Swal.fire({
                title: 'Congratulations!',
                text: 'You guessed the correct number!',
                icon: 'success',
                confirmButtonText: 'Next',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'addpoints2.php'; // Redirect to the next page
                }
            });
        }

        function resetGame() {
            predefinedNumber = Math.floor(Math.random() * (300 - 100 + 1)) + 100;
            console.log('New Predefined Number:', predefinedNumber);
            inputDisplay.value = '';
            timeLeft = 100;
            timerDisplay.textContent = timeLeft;
            startTimer();
        }
    </script>
</body>
</html>
