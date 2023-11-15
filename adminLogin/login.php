<?php
// Database connection setup
$servername = "localhost:3307"; 
$username = "root"; 
$password = ""; 
$database = "user_management"; 

// Create a connection
$connection = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
    $password = $data['password'];

    // Sanitize inputs and perform SQL query to check username and password against the database
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $response = [
            'success' => true,
            'role' => $row['role'],
        ];
        echo json_encode($response);
    } else {
        $response = [
            'success' => false,
            'message' => 'Invalid username or password',
        ];
        echo json_encode($response);
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
}
?>

