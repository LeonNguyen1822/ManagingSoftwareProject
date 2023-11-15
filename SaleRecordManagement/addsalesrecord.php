<?php
// Database connection details
$username = "root";
$password = "";
$dbname = "SalesDatabase"; // Database name where you created the table

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process user input (assuming POST method)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $receipt_id = $_POST["receipt_id"];
    $item_id = $_POST["item_id"];
    $item_name = $_POST["item_name"];
    $quantity = $_POST["quantity"];
    $item_price = $_POST["item_price"];
    $total_price = $_POST["total_price"];
    
    // Check if a sale record with the same Receipt ID already exists
    $check_sql = "SELECT * FROM SaleRecords WHERE ReceiptID = ?";
    $check_stmt = $conn->prepare($check_sql);
    
    if ($check_stmt) {
        // Bind parameters and execute the statement
        $check_stmt->bind_param("i", $receipt_id);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo '<script language="javascript">';
            echo 'alert("A sale record with the same Receipt ID already exists.")';
            echo '</script>';
        } else {
            // Prepare and execute the SQL query to insert the new sale record
            $insert_sql = "INSERT INTO SaleRecords (ReceiptID, ItemId, ItemName, Quantity, ItemPrice, TotalPrice) 
                           VALUES (?, ?, ?, ?, ?, ?)";
            
            $insert_stmt = $conn->prepare($insert_sql);            
            if ($insert_stmt) {
                // Bind parameters and execute the statement
                $insert_stmt->bind_param("iissdd", $receipt_id, $item_id, $item_name, $quantity, $item_price, $total_price);
                if ($insert_stmt->execute()) {
                    echo '<script language="javascript">';
                    echo 'alert("A sale record added succesfully")';
                    echo '</script>';
                } else {
                    echo "Error: " . $insert_stmt->error;
                }
                $insert_stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
        }
        
        $check_stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Sale Record</title>
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
    <h2>Add Sale Record</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="receipt_id">Receipt ID:</label>
        <input type="number" name="receipt_id" required><br><br>
        
        <label for="item_id">Item ID:</label>
        <input type="number" name="item_id" required><br><br>
        
        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" required><br><br>
        
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required><br><br>
        
        <label for="item_price">Item Price:</label>
        <input type="text" name="item_price" required><br><br>
        
        <label for="total_price">Total Price:</label>
        <input type="text" name="total_price" required><br><br>
        <br>
        <br>
    <input class ="button" type="submit" value="Add Sale Record">  
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
