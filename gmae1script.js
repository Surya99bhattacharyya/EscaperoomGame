// script.js
document.addEventListener("DOMContentLoaded", function() {
    const scenes = document.querySelectorAll('.scene');
    
    function startGame() {
        switchScene('intro', 'library');
    }

    function switchScene(current, next) {
        document.getElementById(current).classList.add('hidden');
        document.getElementById(next).classList.remove('hidden');
    }

    window.startGame = startGame;

    // Room 1 - Library
    const correctBook = 'B';
    const riddleAnswer = 'piano';

    function checkBook(book) {
        if (book === correctBook) {
            document.getElementById('ghost-riddle').classList.remove('hidden');
        } else {
            alert('Nothing here, try another book.');
        }
    }

    function checkRiddle() {
        const answer = document.getElementById('riddle-answer').value.toLowerCase();
        if (answer === riddleAnswer) {
            switchScene('library', 'laboratory');
        } else {
            alert('Wrong answer, try again.');
        }
    }

    window.checkBook = checkBook;
    window.checkRiddle = checkRiddle;

    // Room 2 - Laboratory
    let mixedColors = [];
    const correctMix = ['red', 'blue', 'green'];
    const cipherMessage = "Svool Dliow"; // Encoded message (Hello World)

    function mixChemicals(color) {
        mixedColors.push(color);
        if (mixedColors.length === 3) {
            if (JSON.stringify(mixedColors) === JSON.stringify(correctMix)) {
                document.getElementById('cipher').classList.remove('hidden');
                document.getElementById('cipher-message').innerText = cipherMessage;
            } else {
                alert('Wrong mix, try again.');
                mixedColors = [];
            }
        }
    }

    function checkCipher() {
        const answer = document.getElementById('cipher-answer').value.toLowerCase();
        if (answer === 'hello world') {
            switchScene('laboratory', 'attic');
        } else {
            alert('Wrong answer, try again.');
        }
    }

    window.mixChemicals = mixChemicals;
    window.checkCipher = checkCipher;

    // Final Room - Attic
    function findFinalKey() {
        switchScene('attic', 'escape');
    }

    window.findFinalKey = findFinalKey;
});
