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

    $errorMessage = "";
    $successMessage = "";

    // Capture stock data from the form and validate
    $stockId = $_POST['stockId'];
    $stockName = $_POST['stockName'];
    $numberOfStock = $_POST['numberOfStock'];
    $minStock = $_POST['minStock'];
    $maxStock = $_POST['maxStock'];

    // Check if a stock with the same Stock ID already exists
    $checkSql = "SELECT * FROM stock WHERE StockID = '$stockId'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        $_SESSION['errorMessage'] = "Error: Stock with the same Stock ID already exists.";
    } else {
        // Check for empty or invalid data here before executing the SQL query
        if (empty($numberOfStock)){
            $numberOfStock = 0;
        }
        if (empty($stockId) || empty($stockName) || empty($minStock) || empty($maxStock)) {
            $_SESSION['errorMessage'] = "Error: Please fill in all fields.";
        } elseif (!is_numeric($numberOfStock) || !is_numeric($minStock) || !is_numeric($maxStock)) {
            $_SESSION['errorMessage'] = "Error: Invalid data. Please enter valid numbers.";
        } elseif ($maxStock<=$minStock){
            $_SESSION['errorMessage'] = "Error: Minimum stock can't be greater or equal to Maximum stock";
        } elseif (($numberOfStock<0) || ($minStock<0) || ($maxStock<0)){
            $_SESSION['errorMessage'] = "Error: Invalid data. Values entered cannot be negative.";
        } else {
            // SQL query to insert stock data into the table
            $sql = "INSERT INTO stock (StockID, StockName, NumOfStock, MinStock, MaxStock)
                    VALUES ('$stockId', '$stockName', $numberOfStock, $minStock, $maxStock)";

            if ($conn->query($sql) !== TRUE) {
                $_SESSION['errorMessage'] = "Error: " . $sql . "<br>" . $conn->error;
            } else {
                $_SESSION['successMessage'] = "Stock was added successfully!";
            }
        }
    }

    // Close the database connection
    $conn->close();

    // Redirect back to add-stock.php
    header("Location: add-stock.php");
    exit();
?>
