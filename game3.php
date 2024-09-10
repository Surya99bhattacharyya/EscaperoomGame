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
    <title>Word Scramble Game</title>
    <style>body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f0;
    margin: 0;
    font-family: Arial, sans-serif;
}

.game-container {
    text-align: center;
}

h1 {
    margin-bottom: 20px;
}

.scrambled-word {
    font-size: 30px;
    margin-bottom: 20px;
}

#guess-input {
    font-size: 16px;
    padding: 5px;
    margin-bottom: 10px;
}

button {
    padding: 10px 20px;
    font-size: 16px;
    margin: 5px;
    cursor: pointer;
}

.result {
    font-size: 20px;
    margin-top: 20px;
}

.score-board, .timer {
    margin-top: 20px;
}
</style>
</head>
<body>
    <div class="game-container">
        <h1>Word Scramble Game</h1>
        <div class="scrambled-word" id="scrambled-word"></div>
        <input type="text" id="guess-input" placeholder="Enter your guess" />
        <button id="submit-guess">Submit Guess</button>
        <div class="result" id="result"></div>
        <div class="score-board">
            <h3>Score: <span id="score">0</span></h3>
        </div>
        <div class="timer">
            <h3>Time Left: <span id="time">30</span> seconds</h3>
        </div>
        <button id="next-word">Next Word</button>
    </div>
    <script>const words = ["javascript", "programming", "interface", "developer", "function", "variable", "object", "array"];
let currentWord = "";
let scrambledWord = "";
let score = 0;
let timeLeft = 30;
let timer;

const scrambledWordElement = document.getElementById('scrambled-word');
const guessInput = document.getElementById('guess-input');
const submitGuessButton = document.getElementById('submit-guess');
const resultElement = document.getElementById('result');
const scoreElement = document.getElementById('score');
const timeElement = document.getElementById('time');
const nextWordButton = document.getElementById('next-word');

function scrambleWord(word) {
    let scrambled = word.split('').sort(() => 0.5 - Math.random()).join('');
    while (scrambled === word) {
        scrambled = word.split('').sort(() => 0.5 - Math.random()).join('');
    }
    return scrambled;
}

function newWord() {
    currentWord = words[Math.floor(Math.random() * words.length)];
    scrambledWord = scrambleWord(currentWord);
    scrambledWordElement.textContent = scrambledWord;
    guessInput.value = "";
    resultElement.textContent = "";
    resetTimer();
}

function updateScore() {
    scoreElement.textContent = score;
}

function resetTimer() {
    clearInterval(timer);
    timeLeft = 30;
    timeElement.textContent = timeLeft;
    timer = setInterval(() => {
        timeLeft--;
        timeElement.textContent = timeLeft;
        if (timeLeft === 0) {
            clearInterval(timer);
            resultElement.textContent = "Time's up! The correct word was " + currentWord;
            guessInput.disabled = true;
            submitGuessButton.disabled = true;
        }
    }, 1000);
}

submitGuessButton.addEventListener('click', () => {
    const guess = guessInput.value.toLowerCase();
    if (guess === currentWord) {
        resultElement.textContent = "Correct! Well done!";
        score++;
        updateScore();
        clearInterval(timer);
        guessInput.disabled = true;
        submitGuessButton.disabled = true;
    } else {
        resultElement.textContent = "Incorrect! Try again.";
    }
});

nextWordButton.addEventListener('click', () => {
    guessInput.disabled = false;
    submitGuessButton.disabled = false;
    newWord();
});

// Initialize the first word
newWord();
updateScore();
resetTimer();
</script>
</body>
</html>
