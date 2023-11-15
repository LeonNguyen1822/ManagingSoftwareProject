<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit stock</title>
    <link rel="stylesheet" href="edit-stock-style.css">
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
                <button class="notif-stk-button">Stock Notifications</button>
            </form>
            <form id="redirectForm" action="-">
                <button class="return-dash-button">Return to Dashboard</button>
            </form>
        </div>
        <div class="main">
            <h1>Edit Stock</h1>

            <!-- Display error message or success message if there is one -->
            <?php if (isset($_SESSION['errorMessage']) && !empty($_SESSION['errorMessage'])) { ?>
                <p style="color: red;"><?php echo $_SESSION['errorMessage']; ?></p>
                <?php unset($_SESSION['errorMessage']); ?>
            <?php } ?>

            <?php if (isset($_SESSION['successMessage']) && !empty($_SESSION['successMessage'])) { ?>
                <p style="color: green;"><?php echo $_SESSION['successMessage']; ?></p>
                <?php unset($_SESSION['successMessage']); ?>
            <?php } ?>

            <form method="POST" action="edit-stock-function.php">
                <label for="stockId">Stock ID:</label>
                <input type="text" id="stockId" name="stockId">

                <label for="stockName">Stock Name:</label>
                <input type="text" id="stockName" name="stockName">

                <label for="numberOfStock">No. of Stock:</label>
                <input type="number" id="numberOfStock" name="numberOfStock">

                <label for="minStock">Minimum Stock:</label>
                <input type="number" id="minStock" name="minStock">

                <label for="maxStock">Maximum Stock:</label>
                <input type="number" id="maxStock" name="maxStock">
                
                <button class="edit-stock-button" type="submit">Edit Stock</button>
            </form>
        </div>
    </div>
</body>
</html>