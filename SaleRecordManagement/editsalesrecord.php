<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="view port" content="width=device-width,initial-scale=1"/>
	<meta name="author" content="Yasith Kudagamage"/>
    <title>Edit Sales</title>
	<link rel="stylesheet" href="editviewstyle.css">
</head>
<body>
    <header>
    <section>
     <!--Company logo -->
     <div class="logo">
		<img src="GotoGro.jpg" alt="logo"/>	
	 </div>
	 <h1>Sales Record Management</h1>
	 <div class="nav">
	  <!-- Website main menu,Use of unordered list-->
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
      <h2>Edit Sales Record</h2>
	  <!-- Display error message if it exists -->
        <?php
        session_start();
        if (isset($_SESSION['errorMessage'])) {
            echo '<div class="error-message">' . $_SESSION['errorMessage'] . '</div>';
            unset($_SESSION['errorMessage']); // Clear the error message after displaying it
        }
        ?>

        <!-- Display success message if it exists -->
        <?php
        if (isset($_SESSION['successMessage'])) {
            echo '<div class="success-message">' . $_SESSION['successMessage'] . '</div>';
            unset($_SESSION['successMessage']); // Clear the success message after displaying it
        }
        ?>
      <form action="updatesales.php" method="POST">
          <label for="receiptID">Receipt ID:</label>
          <input type="text" name="receiptID" required><br><br>

          <label for="itemID">Item ID:</label>
          <input type="text" name="itemID" required><br><br>

          <label for="itemName">Item Name:</label>
          <input type="text" name="itemName" required><br><br>

          <label for="itemPrice">Item Price:</label>
          <input type="text" name="itemPrice" required><br><br>

          <label for="quantity">Quantity:</label>
          <input type="text" name="quantity" required><br><br>

          <label for="totalPrice">Total Price:</label>
          <input type="text" name="totalPrice" required><br><br>

          <label for="dateofSale">Date of Sale:</label>
          <input type="text" name="dateofSale" required><br><br>

          <button class="edit-sales-button" type="submit">Edit Record</button>
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
	 </div> 
</body>
</html>
