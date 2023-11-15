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
    echo "Connection failed: ";
}

// Initialize an error message variable
$errorMessage = "";
$successMessage = "";

$UserID = $_POST['UserID'];
$Password = $_POST['Password'];
$ConPassword = $_POST['ConPassword'];

if ($Password != $ConPassword) {
    echo "Password Does not Match";
}

elseif (empty($UserID) || empty($Password) || empty($ConPassword)) {
    $_SESSION['errorMessage'] = "Error: Please fill out all fields.";
} else {
    if ($Password = $ConPassword) {
        // Update the sales record for the existing ReceiptID and ItemID
        $updateSql = "UPDATE user SET Password='$Password' WHERE UserID='$UserID';";

        if ($conn->query($updateSql) === TRUE) {
            $_SESSION['successMessage'] = "Sales data updated successfully!";
            echo "Sales data updated successfully!";
        } else {
            $_SESSION['errorMessage'] = "Error updating sales data: " . $conn->error;
            echo "Error updating sales data:";
        }
    } else {
        $_SESSION['errorMessage'] = "Error: Sales record with the provided Receipt ID/Item ID does not exist.";
        echo "Error: Sales record with the provided Receipt ID/Item ID does not exist.";
    }
}

// Close the database connection
$conn->close();

// Redirect back to the editsalesrecord.php page
//header("Location: newpassword.php");
exit();
?>


UPDATE user SET Password='newp123' WHERE UserID='GG123';"