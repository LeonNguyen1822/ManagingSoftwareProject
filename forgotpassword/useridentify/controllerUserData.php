<?php
session_start();

$servername = "127.0.0.1"; // database server name
$username = "root"; // database username
$password = ""; // database password
$dbname = "userdatabase"; // database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize an error message variable
$errorMessage = "";
$successMessage = "";

$UserID = $_POST['UserID'];
$UserName = $_POST['UserName'];

// Check if the ReceiptID exists in the database
$checkSql = "SELECT * FROM user WHERE UserID = '$UserID' AND UserName = '$UserName'";
$checkResult = $conn->query($checkSql);

if (empty($UserID) || empty($UserName)) {
    $_SESSION['errorMessage'] = "Error: Please fill out all fields.";
} else {
    if ($checkResult->num_rows > 0) {
        header("Location: newpassword.php");
    } else {
        echo "Error: User ID and User Name Does not Matching or Does not Exist!!!";
        $_SESSION['errorMessage'] = "Error: User ID and User Name Does not Matching or Does not Exist!!!";
    }
}

// Close the database connection
$conn->close();

// Redirect back to the editsalesrecord.php page
//header("Location: identifyuser.php");
exit();
?>