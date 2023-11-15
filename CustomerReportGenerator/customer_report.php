<!DOCTYPE html>
<html>

<head>
    <title>Customer Report</title>
    <link rel="stylesheet" href="style.css">
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
    <h1>Customer Report</h1>

    <?php
    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "customer_report_db";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize variables to store user input
    $customerName = "";
    $customerPhone = "";
    $customerEmail = "";
    $reportType = "";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customerName = $_POST["customer_name"];
        $customerPhone = $_POST["customer_phone"];
        $customerEmail = $_POST["customer_email"];
        $reportType = $_POST["report_type"];

        // Query to retrieve customer data based on user input
        // Query to retrieve customer data based on user input
        $sql = "SELECT customers.id AS customer_id, customers.name AS customer_name, customers.phone AS customer_phone, customers.email AS customer_email, orders.id AS order_id, orders.order_date, orders.product_name
        FROM customers
        INNER JOIN orders ON customers.id = orders.customer_id
        WHERE customers.name = '$customerName' AND customers.phone = '$customerPhone' AND customers.email = '$customerEmail'";



        // Determine the date range based on the selected report type
        if ($reportType == "week") {
            $startDate = date('Y-m-d', strtotime('-1 week'));
            $endDate = date('Y-m-d');
        } else {
            $startDate = date('Y-m-01');
            $endDate = date('Y-m-t');
        }

        // Add date range conditions to the SQL query
        $sql .= " AND orders.order_date BETWEEN '$startDate' AND '$endDate'";

        $result = $conn->query($sql);

        // Display the report
        if ($result->num_rows > 0) {
            $firstRow = $result->fetch_assoc(); // Fetch the first row to get customer info
            $customerID = $firstRow["customer_id"];
            $customerName = $firstRow["customer_name"];
            $customerPhone = $firstRow["customer_phone"];
            $customerEmail = $firstRow["customer_email"];

            echo "<h2>Customer Information</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Customer ID</th><th>Customer Name</th><th>Phone</th><th>Email</th></tr>";
            echo "<tr><td>$customerID</td><td>$customerName</td><td>$customerPhone</td><td>$customerEmail</td></tr>";
            echo "</table>";

            echo "<h2>Purchased Item</h2>";
            echo "<h3>Report Type: " . ucfirst($reportType) . "</h3>";
            echo "<table border='1'>";
            echo "<tr><th>Order ID</th><th>Order Date</th><th>Product Name</th></tr>";

            // Display order details
            $result->data_seek(0); // Reset result pointer to the beginning

            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["order_id"] . "</td><td>" . $row["order_date"] . "</td><td>" . $row["product_name"] . "</td></tr>";
            }

            echo "</table>";
        } else {
            echo "No data available for this customer.";
        }
    }
    ?>

    <br>

    <!-- Create a form for user input -->
    <h2>Search for Customer Data</h2>
    <form method="POST" action="">
        <label>Name:</label>
        <input type="text" name="customer_name" required><br>
        <label>Phone:</label>
        <input type="text" name="customer_phone" required><br>
        <label>Email:</label>
        <input type="email" name="customer_email" required><br>
        <label>Report Type:</label>
        <select name="report_type">
            <option value="week">Weekly Report</option>
            <option value="month">Monthly Report</option>
        </select><br>
        <input type="submit" value="Search">
    </form>
    <ul>
    <li><a href="CsvProcess.php" class="button"> Go to grocery need</a></li>
    <li><a href="customer_report.php" class="button"> Go to customer report</a></li>
    <li><a href="index.html" class="button2">Go to master sales page</a></li>
    <li><a href="allsales.php" class="button2">Go to all sales report</a></li>
    <li><a href="dailysales.php" class="button2">Go to daily sales report</a></li>
    <li><a href="monthlysales.php" class="button2">Go to monthly sales report</a></li>
    <li><a href="weeklysales.php" class="button2">Go to weekly sales report</a></li>
    <li><a href="index.php" class="button3">Member Grocery Requirements</a></li>
    <li><a href="addsalesrecord.php" class="button4">Go to Add Sales Record</a></li>
    <li><a href="deletesalesrecord.php" class="button4">Go to Delete Sales Record</a></li>
    <li><a href="editsalesrecord.php" class="button4">Go to Edit Sales Record</a></li>
    <li><a href="viewsalesrecord.php" class="button4">Go to view Sales Record</a></li>
    </ul>

    <!-- Add a link to generate the CSV file -->
    <br>
    <a href="generate_csv.php?name=<?php echo $customerName; ?>&phone=<?php echo $customerPhone; ?>&email=<?php echo $customerEmail; ?>&report_type=<?php echo $reportType; ?>">Generate CSV</a>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>

</html>
