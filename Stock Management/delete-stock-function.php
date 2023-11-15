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

    // Capture stock data from the form and validate
    $stockId = $_POST['stockId'];
    $stockName = $_POST['stockName'];

    // Check if the Stock ID and Stock Name match a record in the database
    $checkSql = "SELECT * FROM stock WHERE StockID = '$stockId' AND BINARY StockName = '$stockName'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        // Delete the stock record
        $deleteSql = "DELETE FROM stock WHERE StockID = '$stockId' AND BINARY StockName = '$stockName'";

        if ($conn->query($deleteSql) === TRUE) {
            $_SESSION['successMessage'] = "Stock data deleted successfully!";
        } else {
            $_SESSION['errorMessage'] = "Error deleting stock data: " . $conn->error;
        }
    } else {
        $_SESSION['errorMessage'] = "Error: Stock with the provided Stock ID and Stock Name does not exist. Data is case sensitive.";
    }

    // Close the database connection
    $conn->close();

    // Redirect back to the delete-stock.php page
    header("Location: delete-stock.php");
    exit();
?>