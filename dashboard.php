<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];

$query_users = "SELECT username, profile_picture FROM users";
$query_logged_in_user = "SELECT * FROM users WHERE username='$username'";

$users_result = $conn->query($query_users);
$logged_in_user_result = $conn->query($query_logged_in_user);

$users = [];
while ($row = $users_result->fetch_assoc()) {
    $users[] = $row;
}

$logged_in_user = $logged_in_user_result->fetch_assoc();

$sql = "SELECT username, points FROM user_game_points ORDER BY points DESC LIMIT 10"; // Change LIMIT as needed
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalnia+Glaze:wght@100..700&family=Playwrite+DE+Grund:wght@100..400&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="styledash.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kalnia+Glaze:wght@100..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+DE+Grund:wght@100..400&family=Quicksand:wght@300..700&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <style>
    body {
    margin: 0;
    font-family: "Quicksand", sans-serif;
    background-color: white;

}

.navbar {
    background-color: #343a40;
    padding: 10px;
}

.overlay .nav-link img {
    width: 50px; /* Adjust icon size */
    height: 50px;
}

.video-banner {
    position: relative;
    width: 100%;
    height: 400px; /* Adjust height as needed */
    overflow: hidden;
}

.video-banner video {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the video covers the banner area */
}

.overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white; /* Text color */
    text-align: center;
    z-index: 1; /* Places text above the video */
    font-family: "Montserrat", sans-serif;
}

.overlay h1 {
    font-size: 40px; /* Adjust as needed */
    font-weight: 500;

}

.overlay p {
    font-size: 20px; /* Adjust as needed */
}

.shape-divider {
    display: block;
    width: 100%;
    height: 100px; /* Adjust height as needed */
    position: absolute; /* Position it absolutely */
    bottom: 0; /* Align it to the bottom */
    left: 0; /* Align it to the left */
    z-index: 2; /* Ensure it appears above the video and overlay */
}

.container {
    display: flex;
    padding: 20px;
    background: linear-gradient(to bottom, #11004b, #830085);
}

.user-list, .user-details {
    width: 20%; /* Adjust width as needed */
    padding: 20px;
    background-color: #f8f9fa5f;
    border: 1px solid #ccc;
    border-radius: 5px;
    
    text-align:center;
    color: white;
}

.user-list h2, .user-details h2 {
    margin-top: 0;
    font-family: "Montserrat", sans-serif;
    font-weight: 500;
    
    
}

#userList {
    list-style-type: none;
    padding: 0;
    
}

#userList li {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    background-color: #f8f9fa5f;
    border-radius: 25px;
    border: 2px solid #ccc;
}

#userList img {
    width: 50px; /* Adjust size */
    height: 50px; /* Adjust size */
    border-radius: 50%; /* Make it circular */
    margin-right: 10px;
}
#loggedInUserDetails .details{
    background-color: #f8f9fa5f;
    border-radius: 25px;
    border: 2px solid #ccc;
    margin-top:30px;
    font-size: 12pt;

}

#loggedInUserDetails img {
    width: 150px; /* Adjust size */
    height: 150px; /* Adjust size */
    border-radius: 50%; /* Make it circular */
    margin-right: 10px;
    border: 2px solid #ccc;
    transition: transform 0.3s ease;
    
}

#loggedInUserDetails .logbutton img{
    width: 60px;
    height:60px;
    margin: 10px;
}
#loggedInUserDetails .logbutton img:hover{
    transform: scale(1.1);
}
.leaderboard {
            margin-top: 20px;
        }

        .leaderboard h3 {
            margin-bottom: 10px;
        }

        .leaderboard table {
            width: 100%;
            border-collapse: collapse;
        }
        .leaderboard th{
            color:purple;
        }

        .leaderboard th, .leaderboard td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .leaderboard th {
            background-color: #f4f4f4;
        }

.main-content {
    width: 60%; /* Adjust width as needed */
    padding: 20px;
    margin: 0 20px;
}

.game-section, .chat-section {
    margin-bottom: 20px;
    padding: 20px;
    background-color: #f8f9fa67;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.game-section h2, .chat-section h2 {
    margin-top: 0;
    color:white;
    font-family: "Montserrat", sans-serif;
    text-align:center;
    font-weight: 500;
}

.card-deck {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.card {
    width: 30%; /* Adjust width */
    margin: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
    transition: transform 0.6s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    text-align:center;
}

.card img {
    width: 100%; /* Responsive image */
    height: auto;
}

.card-body {
    padding: 10px;
    background: linear-gradient(to bottom, #11004b92, #830085a1);
    color:white;
}

.card:hover{
    transform: scale(1.05);
}

.card:nth-child(1) {
            animation: slideInFromTop 1s ease-out;
        }

        .card:nth-child(2) {
            animation: slideInFromBottom 1s ease-out;
        }

        .card:nth-child(3) {
            animation: slideInFromTop 1s ease-out;
        }

        @keyframes slideInFromTop {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInFromBottom {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

#chatBox {
    border: 1px solid #ccc;
    height: 200px; /* Adjust height */
    overflow-y: auto;
    padding: 10px;
    margin-bottom: 10px;
    background: url("chatbg.jpg") no-repeat center center/cover;
}

#chatForm {
    display: flex;
}

#chatMessage {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 20px;
    margin-right: 10px;
    background-color: rgba(255, 255, 255, 0.534);
}

#chatForm button {
    padding: 10px;
    background-color: #ffffff00;
    color: white;
    border: none;
    
    cursor: pointer;
 
}
#chatForm button img{
    width: 30px;
}


.chat-message {
display: flex;
align-items: flex-start;
margin-bottom: 10px;
}

.chat-message.my-message {
justify-content: flex-end;
}

.chat-message.other-message {
justify-content: flex-start;
}

.timestamp{
    color: lightgrey;
    font-style: italic;
    font-size: 7pt;
}

.profile-pic {
width: 40px;
height: 40px;
border-radius: 50%;
margin-right: 10px;
}

.message-content {
background: linear-gradient(to right, #d132f9bb, #222fe1);
padding: 10px;
border-radius: 20px;
max-width: 60%;
color: #f8f9fa;
}

.my-message .message-content {
background: linear-gradient(to left, #007bff, #005ec3);
order: 1;
margin-left: 10px;
}

.other-message .profile-pic {
margin-right: 10px;

}

.my-message .profile-pic {
order: 2;
margin-left: 10px;
}

.button1 {
    background-color: #093dc1;
            border: 1px solid #ccc; /* Remove border */
            color: white; /* White text */
            padding: 10px 20px; /* Some padding */
            text-align: center; /* Center the text */
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Make the link behave like a button */
            font-size: 14px; /* Increase font size */
            /* margin-left: 30px; Add some margin */
            cursor: pointer; /* Pointer/hand icon on hover */
            border-radius: 20px; /* Rounded corners */
            transition: background-color 0.3s ease; /* Smooth transition */
            font-family: "Quicksand", sans-serif;
        }

        .button1 a {
            color: white; /* Ensure the link text is white */
            text-decoration: none; /* Remove underline from the link */
        }

        .button1:hover {
            background-color: rgb(71, 0, 109); /* Darker green on hover */
        }


    </style>
</head>
<body>
    <!-- <nav class="navbar">
        <div class="navbar-nav ml-auto">
            
        </div>
    </nav> -->

    <div class="video-banner">
        <video autoplay muted loop>
            <source src="videoplayback.webm" type="video/webm">
            Your browser does not support the video tag.
        </video>
        <div class="overlay">
            <h1>Your Game Center</h1>
            <p>Find Your Realm Here -> </p>
            
        </div>
        <svg viewBox="0 0 1440 320" preserveAspectRatio="none" class="shape-divider">
        <defs>
        <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" style="stop-color:rgb(21, 2, 74); stop-opacity:1" />
            <stop offset="100%" style="stop-color:rgb(21, 2, 74); stop-opacity:1" />
        </linearGradient>
    </defs>
            <path fill="url(#gradient)" d="M0,128L30,133.3C60,139,120,149,180,165.3C240,181,300,203,360,218.7C420,235,480,245,540,234.7C600,224,660,192,720,160C780,128,840,96,900,90.7C960,85,1020,107,1080,128C1140,149,1200,171,1260,176C1320,181,1380,171,1410,165.3L1440,160L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320H0Z"></path>
        </svg>
    </div>

    <div class="container">
        <div class="user-list">
            <h2>Team Members</h2>
            <ul id="userList">
                <?php foreach ($users as $user): ?>
                    <li>
                        <img src="<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture">
                        <?= htmlspecialchars($user['username']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="main-content">
            <div class="game-section">
                <!-- <h2>Games</h2> -->
                <div id="gameList" class="card-deck">
                    <div class="card">
                        <img class="card-img-top" src="game1bg.jpg" alt="Game 1">
                        <div class="card-body">
                            <h4 class="card-title">HAUNTED SECRET</h4>
                            <p>"Unveil the Secrets, Escape the Haunt!"</p>
                            <button class="button1"><a href=game1.php>LAUNCH</a></button>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="game2.jpg" alt="Game 2">
                        <div class="card-body">
                            <h4 class="card-title">Game 2</h4>
                            <button class="button1"><a href=game2.php>LAUNCH</a></button>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="game3.jpg" alt="Game 3">
                        <div class="card-body">
                            <h4 class="card-title">Game 3</h4>
                            <button class="button1"><a href=game3.php>LAUNCH</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-section">
    <h2>Team Chat</h2>
    <div id="chatBox">
        <!-- Chat messages will appear here -->
    </div>
    <form id="chatForm">
        <input type="text" id="chatMessage" placeholder="Type a message" required>
        <button type="submit"><img src="send.png"></button>
    </form>
</div>

        </div>
        <div class="user-details">
            <h2>Dashboard</h2>
            <div id="loggedInUserDetails" class="logged-in-user">
                <img src="<?= htmlspecialchars($logged_in_user['profile_picture']) ?>" alt="Profile Picture">
                <div class="details">
                <p><strong><?= htmlspecialchars($logged_in_user['username']) ?></strong> </p>
                <p> <strong><?= htmlspecialchars($logged_in_user['email']) ?></strong></p>
                <a class="logbutton" href="logout.php"><img src="logout.png"></a>
                
                </div>
                <div class="leaderboard">
    <h3>Leaderboard</h3>
    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $rank = 1; // Initialize rank
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $rank . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['points']) . "</td>";
                    echo "</tr>";
                    $rank++;
                }
            } else {
                echo "<tr><td colspan='3'>No entries found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="scripts.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const chatForm = document.getElementById("chatForm");
    const chatBox = document.getElementById("chatBox");
    const loggedInUsername = "<?= htmlspecialchars($username) ?>"; // Add this line to get the logged-in username

    // Load chat messages
    function loadMessages() {
        $.get('get_messages.php', function(data) {
            const messages = JSON.parse(data);
            chatBox.innerHTML = '';
            messages.forEach(function(message) {
                const chatMessage = document.createElement("div");
                chatMessage.className = 'chat-message';
                if (message.username === loggedInUsername) {
                    chatMessage.classList.add('my-message');
                } else {
                    chatMessage.classList.add('other-message');
                }
                chatMessage.innerHTML = `
                    <img src="${message.profile_picture}" alt="Profile Picture" class="profile-pic">
                    <div class="message-content">
                        <strong>${message.message}</strong>  <small class="timestamp">${message.timestamp}</small>
                    </div>
                `;
                chatBox.appendChild(chatMessage);
            });
        });
    }

    // Send chat message
    chatForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const message = document.getElementById("chatMessage").value;
        if (message.trim() !== "") {
            $.post('send_message.php', { message: message }, function() {
                loadMessages();
                chatForm.reset();
            });
        }
    });

    // Load messages on page load
    loadMessages();

    // Optionally, refresh messages every few seconds
    setInterval(loadMessages, 5000);
});

    </script>
</body>
</html>
