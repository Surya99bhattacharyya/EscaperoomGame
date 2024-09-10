<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $profile_picture = $_FILES['profile_picture'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($profile_picture["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($profile_picture["tmp_name"]);
    
    if($check !== false && move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
        // Insert user data into database
        $sql = "INSERT INTO users (username, email, password, profile_picture) VALUES ('$username', '$email', '$password', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            header("Location: register.html?success=true");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "File is not an image or there was an error uploading.";
    }

    $conn->close();
}
?>
