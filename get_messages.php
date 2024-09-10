<?php
include 'config.php';

// Query to fetch chat messages along with user's profile picture
$query = "
    SELECT 
        chat_messages.username, 
        chat_messages.message, 
        chat_messages.timestamp, 
        users.profile_picture 
    FROM 
        chat_messages 
    INNER JOIN 
        users 
    ON 
        chat_messages.username = users.username 
    ORDER BY 
        chat_messages.timestamp ASC
";

$result = $conn->query($query);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
$conn->close();
?>
