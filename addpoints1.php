<?php
include 'config.php';
session_start();


// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Get the logged-in user's username from the session
$username = $_SESSION['username'];

// Fetch the user ID based on the username
$query = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();

if ($user_id) {
    // Check if the user already has an entry in the user_game_points table
    $check_query = "SELECT points FROM user_game_points WHERE user_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User exists in the table, update the points
        $update_query = "UPDATE user_game_points SET points = points + 500, last_updated = NOW() WHERE user_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
    } else {
        // User does not exist in the table, insert a new record
        $insert_query = "INSERT INTO user_game_points (user_id, username, points) VALUES (?, ?, 500)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('is', $user_id, $username);
        $stmt->execute();
    }
    $stmt->close();

    // Redirect to the next level page
    header("Location: levelstart2.php");
    exit();
} else {
    echo "User not found!";
}

$conn->close();
?>
