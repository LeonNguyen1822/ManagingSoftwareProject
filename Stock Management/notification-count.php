<?php
// Database connection details (similar to your stock-inventory.php)
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "stockdatabase";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Query to retrieve the count of items with "Low Stock" status
$countQuery = "SELECT COUNT(*) AS lowStockCount FROM stock WHERE StockStatus = 'Low Stock'";
$countStmt = $pdo->prepare($countQuery);
$countStmt->execute();

$lowStockCount = $countStmt->fetchColumn();
