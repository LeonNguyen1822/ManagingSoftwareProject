<!DOCTYPE html>
<html>
<head>
    <title>Delete Sale Records</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<section>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
   <a class="navbar-brand" href="#">
    <img src="GotoGro.jpg" alt="Logo" style="width: 70px">
  </a>
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="addsalesrecord.php">Add Sale Records</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="deletesalesrecord.php">Delete Sale Records</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="editsalesrecord.php">Edit Sale Records</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="viewsalesrecord.php">View Sale Records</a>
    </li>
  </ul>
</nav>
</section>
    <h2>Delete Items</h2>
    <?php
    // Your database connection details
    $username = "root";
    $password = "";
    $dbname = "SalesDatabase"; // Replace with your database name

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the form is submitted
        if (isset($_POST["delete_by"])) {
            $delete_by = $_POST["delete_by"];
            $criteria = $_POST["criteria"];

            // Define the SQL query based on the selected deletion criteria
            $sql = "";
            if ($delete_by === "receipt_id") {
                $sql = "DELETE FROM SaleRecords WHERE ReceiptID = ?";
            } elseif ($delete_by === "item_id") {
                $sql = "DELETE FROM SaleRecords WHERE ItemId = ?";
            } elseif ($delete_by === "item_name") {
                $sql = "DELETE FROM SaleRecords WHERE ItemName = ?";
            }

            // Prepare and execute the SQL query for deletion
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                // Bind parameters and execute the statement
                $stmt->bind_param("s", $criteria);
                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                      echo '<script language="javascript">';
                      echo 'alert("Items deleted successfully.")';
                      echo '</script>';
                    } else {
                      echo '<script language="javascript">';
                      echo 'alert("No matching items found for deletion.")';
                      echo '</script>';
                    }
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="delete_by">Delete by:</label>
        <select name="delete_by" required>
            <option value="receipt_id">Receipt ID</option>
            <option value="item_id">Item ID</option>
            <option value="item_name">Item Name</option>
        </select>
        <br>

        <label for="criteria">Criteria:</label>
        <input type="text" name="criteria" required><br>
        
        <input type="submit" name="delete" value="Delete Items">
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
</body>
</html>
