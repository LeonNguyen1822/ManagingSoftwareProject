<?php
// Database connection setup
$servername = "localhost:3307"; // 
$username = "root"; // 
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
    $newUsername = $data['newUsername'];
    $newPassword = $data['newPassword'];

    // Check if the username already exists in the database
    $checkQuery = "SELECT username FROM users WHERE username = ?";
    $checkStmt = $connection->prepare($checkQuery);
    $checkStmt->bind_param("s", $newUsername);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Username already exists
        $response = [
            'success' => false,
            'message' => 'Staff username already exists please select another one.'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        // Username does not exist, insert the new staff member into the database
        $insertQuery = "INSERT INTO users (username, password, role) VALUES (?, ?, 'staff')";
        $insertStmt = $connection->prepare($insertQuery);
        $insertStmt->bind_param("ss", $newUsername, $newPassword);

        if ($insertStmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Staff registered successfully.',
            ];
            header('Content-Type: application/json'); // Set the response header
            echo json_encode($response);
        } else {
            $response = [
                'success' => false,
                'message' => 'Registration failed. Please try again.',
            ];
            header('Content-Type: application/json'); // Set the response header
            echo json_encode($response);
        }
    }

    // Close the database connections
    $checkStmt->close();
    $insertStmt->close();
    $connection->close();
}
?>


