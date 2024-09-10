<?php
include 'config.php';
session_start();

if (isset($_SESSION['username'])) {
    
    header('Location: levelstart1.php');
    exit;
} else {
    
    header('Location: login.html');
    exit;
}
?>
