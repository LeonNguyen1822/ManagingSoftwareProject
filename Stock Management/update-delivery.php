<?php
// Database connection details (similar to your stock-inventory.php)
$servername = "127.0.0.1"; // Database server name (localhost or 127.0.1.1)
$username = "root"; // Database username
$password = ""; // Database password (leave it empty if no password is set)
$dbname = "stockdatabase"; // Database name

try {
    // Create a database connection using PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Check if StockID is provided in the URL
if (isset($_GET['StockID'])) {
    $stockID = $_GET['StockID'];

    // Retrieve the stock information for the selected StockID
    $query = "SELECT StockID, StockName, Delivery, NumOfStock, MaxStock, DeliveryQuan FROM stock WHERE StockID = :stockID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':stockID', $stockID, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $stockID = $row['StockID'];
        $stockName = $row['StockName'];
        $deliveryStatus = $row['Delivery'];
        $numOfStock = $row['NumOfStock'];
        $maxStock = $row['MaxStock'];
        $deliveryQuan = $row['DeliveryQuan'];
    } else {
        // Handle the case when StockID is not found
        echo "Stock ID not found.";
        exit; // Stop further execution
    }
} else {
    // Handle the case when StockID is not provided
    echo "Stock ID is missing.";
    exit; // Stop further execution
}
// Check if the update form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected delivery status from the form
    $newDeliveryStatus = isset($_POST['newDeliveryStatus']) ? $_POST['newDeliveryStatus'] : '';

    // Define the mapping of user choices to database messages
    $statusMapping = [
        '1' => 'Restock requested',
        '2' => 'Arriving soon',
        '3' => 'Request rejected',
        '4' => 'Re-Scheduled',
        '5' => 'Items delivered',
        '6' => 'Delivery cancelled',
        '7' => 'None',
    ];

    // Update the delivery status in the database
    if (array_key_exists($newDeliveryStatus, $statusMapping)) {
        $newStatusMessage = $statusMapping[$newDeliveryStatus];
        
        // Handle "Make stock request" calculation
        if ($newDeliveryStatus === '1') {
            $deliveryQuan = $maxStock - $numOfStock;
        }
        
        // Handle "Items fully restocked" calculation
        elseif ($newDeliveryStatus === '7') {
            $numOfStock = $numOfStock + $deliveryQuan;
            $deliveryQuan = 0;
        }
        
        // Update the database with the new values
        $updateQuery = "UPDATE stock SET Delivery = :newStatusMessage, DeliveryQuan = :deliveryQuan, NumOfStock = :numOfStock WHERE StockID = :stockID";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(':newStatusMessage', $newStatusMessage, PDO::PARAM_STR);
        $updateStmt->bindParam(':deliveryQuan', $deliveryQuan, PDO::PARAM_INT);
        $updateStmt->bindParam(':numOfStock', $numOfStock, PDO::PARAM_INT);
        $updateStmt->bindParam(':stockID', $stockID, PDO::PARAM_STR);

        if ($updateStmt->execute()) {
            // Redirect back to the stock inventory page after the update
            header("Location: stock-inv-notif.php");
            exit; // Stop further execution
        } else {
            echo "Error updating the delivery status.";
        }
    } else {
        echo "Invalid delivery status selected.";
    }
}
?>

<?php
require_once 'notification-count.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Updating Stock Delivery Status</title>
    <link rel="stylesheet" href="stock-inv-notif-style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <form id="redirectForm" action="view-stock.php">
                <button class="view-stk-button">View Stock</button>
            </form>
            <form id="redirectForm" action="add-stock.php">
                <button class="add-stk-button">Add Stock</button>
            </form>
            <form id="redirectForm" action="edit-stock.php">
                <button class="edit-stk-button">Edit Stock</button>
            </form>
            <form id="redirectForm" action="delete-stock.php">
                <button class="delete-stk-button">Delete Stock</button>
            </form>
            <form id="redirectForm" action="stock-inv-notif.php">
                <button class="notif-stk-button">Stock Notification (<?php echo $lowStockCount; ?>)</button>
            </form>
            <form id="redirectForm" action="-">
                <button class="return-dash-button">Return to Dashboard</button>
            </form>
        </div>
        <div class="main">
            <h1>Updating Stock Delivery Status for <?php echo htmlspecialchars($stockName) . ' (' . htmlspecialchars($stockID) . ')'; ?></h1>
            <p>Current Delivery Status: <?php echo htmlspecialchars($deliveryStatus); ?></p>
            <form method="POST">
                <label for="newDeliveryStatus">Select Delivery Status:</label>
                <select name="newDeliveryStatus" id="newDeliveryStatus">
                    <option value="1">Make stock request</option>
                    <option value="2">Request Accepted</option>
                    <option value="3">Request Rejected</option>
                    <option value="4">Delivery Postponed</option>
                    <option value="5">Delivery Successful</option>
                    <option value="6">Delivery Cancelled</option>
                    <option value="7">Items Fully Restocked</option>
                </select>
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</body>
</html>