<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sale Report</title>
    <!-- Styles -->
    <link href="salesreportstyle/salesreportstyle.css" rel="stylesheet" type="text/css" />
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

    <!-- Reports -->
    <div>
        <h2 id="main">Sales Report Generator</h2><br/><br/>
    </div>

    <!-- Data list table --> 
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
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
       <?php 
       // Database configuration 
        $dbHost     = "127.0.0.1"; 
        $dbUsername = "root"; 
        $dbPassword = ""; 
        $dbName     = "salesdatabase"; 
         
        // Create database connection 
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        // Fetch records from database 
        $result = $db->query("SELECT * FROM sales ORDER BY ReceiptID ASC"); 
        if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){ 
        ?>
            <tr>
                <td><?php echo $row['ReceiptID']; ?></td>
                <td><?php echo $row['ItemID']; ?></td>
                <td><?php echo $row['ItemName']; ?></td>
                <td><?php echo $row['ItemPrice']; ?></td>
                <td><?php echo $row['Quantity']; ?></td>
                <td><?php echo $row['TotalPrice']; ?></td>
                <td><?php echo $row['DateofSale']; ?></td>
                
            </tr>
        <?php } }else{ ?>
            <tr><td colspan="7">No Stock(s) found...</td></tr>
        <?php } ?>
        </tbody>
    </table>
     <!-- Export link -->
    <div class="col-md-12 head">
        <div class="dwn5">
            <a href="allexportData.php" class="dwn5"> Download Report</a> 
        </div>
        <div class="dwn5">     
            <a href="index.html" class="dwn5">Go Back</a>
        </div>
    </div>
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
