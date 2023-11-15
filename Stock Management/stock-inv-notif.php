<?php
// Database connection details
$servername = "127.0.0.1"; // Database server name (localhost or 127.0.0.1)
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

// Handle search input
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';
$searchQuery = '%' . $searchQuery . '%'; // Add wildcards for partial matching

// Query to retrieve stock information with optional search
$query = "SELECT StockID, StockName, NumOfStock, MinStock, MaxStock, StockStatus, Delivery 
          FROM stock 
          WHERE (StockID LIKE :searchQuery OR StockName LIKE :searchQuery)
             AND NumOfStock < MinStock"; // You can keep the stock status condition

$stmt = $pdo->prepare($query);
$stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_STR);
$stmt->execute();
?>

<?php
require_once 'notification-count.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Inventory Notification</title>
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
            <h1>Stock Inventory Notification</h1>
            <!-- Create a container for search bar and report options -->
            <div class="search-report-container">
                <div class="search-bar">
                    <div style="padding-right: 5px;">Search Stock ID/Name:</div>
                    <form method="GET">
                        <input type="text" class="search-input" name="query" placeholder=" Blank for all stock">
                        <button type="submit" class="find-stock-button">Find Stock</button>
                    </form>
                    <form method="POST" action="generate-low-stock-report.php">
                        <button class="report-button">Generate Low Stock Report</button>
                    </form>
                    <form method="POST" action="generate-all-stock-report.php">
                        <button class="report-button">Generate All Stock Report</button>
                    </form>
                </div>
            </div>
            <table>
                <tr>
                    <th>Stock ID</th>
                    <th>Stock Name</th>
                    <th>No. of Stock</th>
                    <th>Minimum Stock</th>
                    <th>Maximum Stock</th>
                    <th>Stock Status</th>
                    <th>Delivery</th>
                </tr>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['StockID']); ?></td>
                        <td><?php echo htmlspecialchars($row['StockName']); ?></td>
                        <td><?php echo htmlspecialchars($row['NumOfStock']); ?></td>
                        <td><?php echo htmlspecialchars($row['MinStock']); ?></td>
                        <td><?php echo htmlspecialchars($row['MaxStock']); ?></td>
                        <td><?php echo htmlspecialchars($row['StockStatus']); ?></td>
                        <td><a href="update-delivery.php?StockID=<?php echo $row['StockID']; ?>">Update</a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>