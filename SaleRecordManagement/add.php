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
                    echo "Sale record added successfully.";
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
</head>
<body>
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
        
        <input type="submit" value="Add Sale Record">
    </form>
</body>
</html>
