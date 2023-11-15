<?php
session_start();

$servername = "127.0.0.1"; // database server name
$username = "root"; // database username
$password = ""; // database password
$dbname = "salesdb"; // database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize an error message variable
$errorMessage = "";
$successMessage = "";

$receiptID = $_POST['receiptID'];
$itemID = $_POST['itemID'];
$itemName = $_POST['itemName'];
$itemPrice = $_POST['itemPrice'];
$quantity = $_POST['quantity'];
$totalPrice = $_POST['totalPrice'];
$dateofSale = $_POST['dateofSale'];

// Check if the ReceiptID exists in the database
$checkSql = "SELECT * FROM sales WHERE ReceiptID = '$receiptID' AND ItemID = '$itemID'";
$checkResult = $conn->query($checkSql);

if (empty($receiptID) || empty($itemID) || empty($itemName) || empty($itemPrice) || empty($quantity) || empty($totalPrice) || empty($dateofSale)) {
    $_SESSION['errorMessage'] = "Error: Please fill out all fields.";
} elseif (!is_numeric($itemPrice) || !is_numeric($quantity) || !is_numeric($totalPrice) || $itemPrice < 0 || $quantity < 0 || $totalPrice < 0) {
    $_SESSION['errorMessage'] = "Error: Invalid input data. All numeric fields must be positive numbers.";
} else {
    if ($checkResult->num_rows > 0) {
        // Update the sales record for the existing ReceiptID and ItemID
        $updateSql = "UPDATE sales SET ItemName = '$itemName', ItemPrice = '$itemPrice', Quantity = '$quantity', TotalPrice = '$totalPrice', DateofSale = '$dateofSale' WHERE ReceiptID = '$receiptID' AND ItemID = '$itemID'";

        if ($conn->query($updateSql) === TRUE) {
            $_SESSION['successMessage'] = "Sales data updated successfully!";
        } else {
            $_SESSION['errorMessage'] = "Error updating sales data: " . $conn->error;
        }
    } else {
        $_SESSION['errorMessage'] = "Error: Sales record with the provided Receipt ID/Item ID does not exist.";
    }
}

// Close the database connection
$conn->close();

// Redirect back to the editsalesrecord.php page
header("Location: editsalesrecord.php");
exit();
?>
