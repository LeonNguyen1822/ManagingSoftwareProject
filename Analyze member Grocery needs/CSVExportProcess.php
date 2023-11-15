<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "salesdatabase";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve the top 10 sold items sorted by quantity
$sql = "SELECT `ItemID`, `ItemName`, SUM(`Quantity`) AS TotalQuantity
        FROM `sales`
        GROUP BY `ItemID`, `ItemName`
        ORDER BY TotalQuantity DESC
        LIMIT 10";

$result = $conn->query($sql);

// Function to create and download CSV file
function downloadCSV($data) {
    $filename = "top_10_sold_items.csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    // Write the CSV header (column names)
    $header = array("ItemID", "ItemName", "TotalQuantity");
    fputcsv($output, $header);

    // Write the data rows
    foreach ($data as $row) {
        fputcsv($output, $row);
    }

    fclose($output);
}

// Check if the download button was clicked
if (isset($_POST['download'])) {
    // Fetch data from the result set
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Call the downloadCSV function to generate and download the CSV
    downloadCSV($data);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CSV Download Page</title>
	<style>
        
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 10px;
        }
		.button2{
			 display: inline-block;
            background-color: #00ffff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 10px;
        }.button3{
			 display: inline-block;
            background-color: #00b7eb;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 10px;
        }
		.button4{
			 display: inline-block;
            background-color: #00ced1;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 10px;
        }
			

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h2>Download Grocery Trend CSV</h2>
    
    <form method="post">
        <input type="submit" name="download" value="Download CSV Report">
    </form>
	<ul>
	<li><a href="customer_report.php" class="button"> Go to customer report</a></li>
	<li><a href="allsales.php" class="button2">Go to all sales report</a></li>
	<li><a href="dailysales.php" class="button2">Go to daily sales report</a></li>
	<li><a href="monthlysales.php" class="button2">Go to monthly sales report</a></li>
	<li><a href="weeklysales.php" class="button2">Go to weekly sales report</a></li>
	<li><a href="index.php" class="button3">Member Grocery Requirements</a></li>
	<li><a href="SaleRecordManegement" class="button4">Go to Sales Record Management</a></li>
	</ul>
</body>
</html>
