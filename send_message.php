<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
$message = $_POST['message'];

if (!empty($message)) {
    $stmt = $conn->prepare("INSERT INTO chat_messages (username, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $message);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>
