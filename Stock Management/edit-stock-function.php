<?php
    session_start();

    $servername = "127.0.0.1"; // database server name
    $username = "root"; // database username
    $password = ""; // database password
    $dbname = "stockdatabase"; // database name

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize an error message variable
    $errorMessage = "";
    $successMessage = "";

    $stockId = $_POST['stockId'];
    $stockName = $_POST['stockName'];
    $numberOfStock = $_POST['numberOfStock'];
    $minStock = $_POST['minStock'];
    $maxStock = $_POST['maxStock'];

    // Check if the StockID exists in the database
    $checkSql = "SELECT * FROM stock WHERE StockID = '$stockId'";
    $checkResult = $conn->query($checkSql);
    if (empty($numberOfStock)){
        $numberOfStock = 0;
    }
    if (empty($stockId) || empty($stockName) || empty($minStock) || empty($maxStock)) {
        $_SESSION['errorMessage'] = "Error: Please fill out all fields.";
    } elseif ($minStock >= $maxStock) {
        $_SESSION['errorMessage'] = "Error: Minimum stock cannot be greater than or equals to maximum stock.";
    } elseif (!is_numeric($numberOfStock) || !is_numeric($minStock) || !is_numeric($maxStock) || $numberOfStock < 0 || $minStock < 0 || $maxStock < 0) {
        $_SESSION['errorMessage'] = "Error: Invalid input data. All numeric fields must be positive numbers.";
    } else {

        if ($checkResult->num_rows > 0) {
            // Update the stock data for the existing StockID
            $updateSql = "UPDATE stock SET StockName = '$stockName', NumOfStock = $numberOfStock, MinStock = $minStock, MaxStock = $maxStock WHERE StockID = '$stockId'";

            if ($conn->query($updateSql) === TRUE) {
                $_SESSION['successMessage'] = "Stock data updated successfully!";
            } else {
                $_SESSION['errorMessage'] = "Error updating stock data: " . $conn->error;
            }
        } else {
            $_SESSION['errorMessage'] = "Error: Stock with the provided Stock ID does not exist.";
        }
    }

    // Close the database connection
    $conn->close();

    // Redirect back to the edit-stock.php page
    header("Location: edit-stock.php");
    exit();
?>