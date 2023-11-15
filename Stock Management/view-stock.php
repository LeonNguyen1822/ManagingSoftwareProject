<?php
require_once 'notification-count.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Stock</title>
    <link rel="stylesheet" href="view-stock-style.css">
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
            <h1>View Stock</h1>
            <div class="search-bar">
                <div style="padding-right: 5px;">Search Stock ID/Name:</div>
                <form method="GET">
                    <input type="text" class="search-input" name="query" placeholder=" Blank for all stock">
                    <button type="submit" class="find-stock-button">Find Stock</button>
                </form>
            </div>
            <!--Table-->
            <table>
                <thead>
                    <tr>
                        <th>Stock ID</th>
                        <th>Stock Name</th>
                        <th>No. of Stock</th>
                        <th>Minimum Stock</th>
                        <th>Maximum Stock</th>
                        <th>Stock Status</th>
                        <th>Delivery</th>
                    </tr>
                </thead>
                <tbody>
                    <!--Stock data-->
                    <?php
                    if (isset($_GET['query'])) {
                        $searchQuery = $_GET['query'];
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

                        // SQL query to retrieve data from the Stock table
                        $sql = "SELECT * FROM stock WHERE StockID LIKE '%$searchQuery%' OR StockName LIKE '%$searchQuery%'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['StockID'] . "</td>";
                                echo "<td>" . $row['StockName'] . "</td>";
                                echo "<td>" . $row['NumOfStock'] . "</td>";
                                echo "<td>" . $row['MinStock'] . "</td>";
                                echo "<td>" . $row['MaxStock'] . "</td>";
                                echo "<td>" . $row['StockStatus'] . "</td>";
                                echo "<td>" . $row['Delivery'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No results found</td></tr>";
                        }
                        $conn->close();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>