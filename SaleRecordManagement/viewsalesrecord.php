<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="view port" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Yasith Kudagamage" />
    <title>View Sales</title>
    <link rel="stylesheet" href="editviewstyle.css">
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
    <header>
        <section>
            <!-- Company logo -->
            <div class="logo">
                <img src="GotoGro.jpg" alt="logo" />
            </div>
            <h1>Sales Record Management</h1>
            <div class="nav">
                <!-- Website main menu, Use of unordered list -->
                <nav>
                    <ul>
                        <li><a href="deletesalesrecord.html">Delete Sales</a></li>
                        <li><a href="viewsalesrecord.php">View Sales</a></li>
                        <li><a href="editsalesrecord.php">Edit Sales</a></li>
                        <li><a href="addsalesrecord.html">Add Sales</a></li>
                        <li><a href="userdashboard.html">User Dashboard</a></li>
                    </ul>
                </nav>
            </div>
        </section>
    </header>
    <div class="main">
        <h2>View Sales Records</h2>
        <div class="search-bar">
            <div style="padding-right: 5px;">Search Receipt ID:</div>
            <form method="GET">
                <input type="text" class="search-input" name="query">
                <button type="submit" class="findsalesbutton">View Sales</button>
            </form>
        </div>
        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>Receipt ID</th>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Date of Sale</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sales data -->
                <?php
                if (isset($_GET['query'])) {
                    $searchQuery = $_GET['query'];

                    // Create a database connection
                    $conn = new mysqli('127.0.0.1', 'root', '', 'salesdb');

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    if (!empty($searchQuery)) {
                        // SQL query to retrieve data from the sales table when the query is not empty
                        $sql = "SELECT * FROM sales WHERE ReceiptID LIKE '%$searchQuery%'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $totalBill = 0;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['ReceiptID'] . "</td>";
                                echo "<td>" . $row['ItemID'] . "</td>";
                                echo "<td>" . $row['ItemName'] . "</td>";
                                echo "<td>" . $row['ItemPrice'] . "</td>";
                                echo "<td>" . $row['Quantity'] . "</td>";
                                echo "<td>" . $row['TotalPrice'] . "</td>";
                                echo "<td>" . $row['DateofSale'] . "</td>";
                                echo "</tr>";

                                $totalBill += $row['TotalPrice'];
                            }
                            echo "<tr><td colspan='5'><strong>Total Bill:</strong></td><td><strong>$totalBill</strong></td></tr>";
                        } else {
                            echo "<tr><td colspan='7'>No results found</td></tr>";
                        }
                    } else {
                        // Handle the case when the query is empty (blank)
                        echo "<tr><td colspan='7'>Please enter a search query</td></tr>";
                    }

                    $conn->close();
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
