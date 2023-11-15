<?php
$servername = "localhost:3307"; 
$username = "root";
$password = ""; 
$database = "user_management"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username FROM users WHERE role = 'staff'";
$result = $conn->query($sql);

$usernames = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usernames[] = $row["username"];
    }
}

$conn->close();

// Return the staff usernames as JSON
header('Content-Type: application/json');
echo json_encode($usernames);
?>
