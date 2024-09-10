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
    <title>Rock Paper Scissors</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
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

.choices {
    display: flex;
    justify-content: center;
    gap: 20px;
}

.choice {
    font-size: 50px;
    cursor: pointer;
    transition: transform 0.2s;
}

.choice:hover {
    transform: scale(1.2);
}

.result {
    margin-top: 20px;
}

.score-board {
    margin-top: 20px;
}

#result-text {
    font-size: 24px;
    font-weight: bold;
    margin: 10px 0;
}
</style>
</head>
<body>
    <div class="game-container">
        <h1>Rock Paper Scissors</h1>
        <div class="choices">
            <div class="choice" id="rock"><i class="fas fa-hand-rock"></i></div>
            <div class="choice" id="paper"><i class="fas fa-hand-paper"></i></div>
            <div class="choice" id="scissors"><i class="fas fa-hand-scissors"></i></div>
        </div>
        <div class="result">
            <h2 id="result-text"></h2>
        </div>
        <div class="score-board">
            <h3>Score:</h3>
            <p>Player: <span id="player-score">0</span></p>
            <p>Computer: <span id="computer-score">0</span></p>
        </div>
    </div>
    <script>const choices = document.querySelectorAll('.choice');
const resultText = document.getElementById('result-text');
const playerScoreText = document.getElementById('player-score');
const computerScoreText = document.getElementById('computer-score');

let playerScore = 0;
let computerScore = 0;

choices.forEach(choice => choice.addEventListener('click', playGame));

function playGame(event) {
    const playerChoice = event.target.id;
    const computerChoice = getComputerChoice();
    const winner = getWinner(playerChoice, computerChoice);

    displayResult(winner, computerChoice);
    updateScore(winner);
}

function getComputerChoice() {
    const choices = ['rock', 'paper', 'scissors'];
    const randomIndex = Math.floor(Math.random() * choices.length);
    return choices[randomIndex];
}

function getWinner(player, computer) {
    if (player === computer) {
        return 'draw';
    } else if (
        (player === 'rock' && computer === 'scissors') ||
        (player === 'paper' && computer === 'rock') ||
        (player === 'scissors' && computer === 'paper')
    ) {
        return 'player';
    } else {
        return 'computer';
    }
}

function displayResult(winner, computerChoice) {
    if (winner === 'draw') {
        resultText.textContent = `It's a draw! Computer chose ${computerChoice}`;
    } else if (winner === 'player') {
        resultText.textContent = `You win! Computer chose ${computerChoice}`;
    } else {
        resultText.textContent = `You lose! Computer chose ${computerChoice}`;
    }
}

function updateScore(winner) {
    if (winner === 'player') {
        playerScore++;
    } else if (winner === 'computer') {
        computerScore++;
    }

    playerScoreText.textContent = playerScore;
    computerScoreText.textContent = computerScore;
}
</script>
</body>
</html>
