<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="view port" content="width=device-width,initial-scale=1"/>
  <meta name="author" content="Yasith Kudagamage"/>
  <title>Add to Cart</title>
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
  <script src="script.js"></script> 
</head>
<body>
<header>
    <section>
     <!--Company logo -->
     <div class="logo">
		<img src="GotoGro.jpg" alt="logo"/>	
	 </div>
	 <h1>Submit Order</h1>
	 <p>Refresh page to edit and start new order</p>
	</section> 
</header>	
<!-- Display the menu of items -->
    <div id="cart-icon" onclick="toggleCart()">&#128722;</div>
	
     <div id="menu">
      <div class="item">
        <img src="apple.jpeg" alt="Apple Image">
        <h2>Apples</h2>
        <p>Price: $4 per piece</p>
        <label for="apple-quantity">Quantity:</label>
        <input type="number" id="apple-quantity" class="quantity-input" min="0" value="0">
        <button onclick="addToCart('Apples', 4, 'apple-quantity')">Add to Cart</button>
      </div>

      <div class="item">
        <img src="watermelon.jpg" alt="Watermelon Image">
        <h2>Watermelons</h2>
        <p>Price: $6 per piece</p>
        <label for="watermelon-quantity">Quantity:</label>
        <input type="number" id="watermelon-quantity" class="quantity-input" min="0" value="0">
        <button onclick="addToCart('Watermelons', 6, 'watermelon-quantity')">Add to Cart</button>
      </div>

      <div class="item">
        <img src="banana.jpeg" alt="Banana Image">
        <h2>Bananas</h2>
        <p>Price: $3 per piece</p>
        <label for="banana-quantity">Quantity:</label>
        <input type="number" id="banana-quantity" class="quantity-input" min="0" value="0">
        <button onclick="addToCart('Bananas', 3, 'banana-quantity')">Add to Cart</button>
      </div>

      <div class="item">
        <img src="lemon.jpg" alt="Lemon Image">
        <h2>Lemons</h2>
        <p>Price: $2 per piece</p>
        <label for="lemon-quantity">Quantity:</label>
        <input type="number" id="lemon-quantity" class="quantity-input" min="0" value="0">
        <button onclick="addToCart('Lemons', 2, 'lemon-quantity')">Add to Cart</button>
      </div>

      <div class="item">
        <img src="orange.jpeg" alt="Orange Image">
        <h2>Oranges</h2>
        <p>Price: $3 per piece</p>
        <label for="orange-quantity">Quantity:</label>
        <input type="number" id="orange-quantity" class="quantity-input" min="0" value="0">
        <button onclick="addToCart('Oranges', 3, 'orange-quantity')">Add to Cart</button>
      </div>
      </div>
	
      <!-- Cart section -->
	  <form action="process.php" method="post"> 
      <div id="cart">
        <h2>Your Cart:</h2>
        <ul id="cart-items"></ul>
		<div id="total-bill">Total Bill: $</div>
		<button id="confirm-pay-button" onclick="confirmAndPay()">Confirm & Pay</button>
      </div>
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
	<div id="confirmation-message" class="hidden">Item added to cart!</div>
	<?php
session_start();
if (isset($_SESSION['errorMessage'])) {
    echo '<div class="error-message">' . $_SESSION['errorMessage'] . '</div>';
    unset($_SESSION['errorMessage']); // Clear the message
}

if (isset($_SESSION['successMessage'])) {
    echo '<div class="success-message">' . $_SESSION['successMessage'] . '</div>';
    unset($_SESSION['successMessage']); // Clear the message
}
?>
	<script>
	    const itemPriceMap = {
        "Apples": 4.00,
        "Watermelons": 6.00,
        "Bananas": 3.00,
        "Lemons": 2.00,
        "Oranges": 3.00
        };
        function toggleCart() {
            var cart = document.getElementById("cart");
            cart.classList.toggle("hidden");
        }

        function addToCart(itemName, itemPrice, quantityInputId) {
         const quantity = document.getElementById(quantityInputId).value;
         if (quantity > 0) {
           const cartItem = document.createElement("li");
           cartItem.textContent = `${itemName} x${quantity} - Price: $${(itemPrice * quantity).toFixed(2)}`;
           document.getElementById("cart-items").appendChild(cartItem);

           // Calculate and update the total bill
           updateTotalBill();

           // Show the confirmation message
           const confirmationMessage = document.getElementById("confirmation-message");
           confirmationMessage.style.display = "block";

           // Hide the message after a few seconds (e.g., 3 seconds)
           setTimeout(function() {
           confirmationMessage.style.display = "none";
           }, 3000);
         }
        }


		function updateTotalBill() {
            const cartItems = document.querySelectorAll("#cart-items li");
            let totalBill = 0;

            cartItems.forEach((item) => {
                const [itemName, quantity] = item.textContent.split(" x");
                totalBill += parseFloat(quantity) * parseFloat(itemPriceMap[itemName]);
            });

            const totalBillElement = document.getElementById("total-bill");
            totalBillElement.textContent = `Total Bill: $${totalBill.toFixed(2)}`;
        }
		function confirmAndPay() {
           // Get cart items and total bill
           const cartItems = document.querySelectorAll("#cart-items li");
           const totalBill = document.getElementById("total-bill").textContent;

           // Prepare the data to send to the server
           const data = {
              items: Array.from(cartItems, (item) => item.textContent),
              totalBill: totalBill,
           };

           // Send the data to the server for processing
           fetch('process.php', {
             method: 'POST',
             headers: {
                 'Content-Type': 'application/json',
             },
             body: JSON.stringify(data),
           })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the server, e.g., show a confirmation message or receipt.
                if (data.success) {
                    alert('Order confirmed and paid successfully! Receipt: ' + data.receipt);
                    // Optionally, clear the cart or perform other actions.
                } else {
                    alert('Order confirmation failed.');
            }
           })
           .catch(error => {
                console.error('Error:', error);
           });
        }
    </script>

    <style>
        .item {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            display: inline-block;
        }

        .quantity-input {
            width: 50px;
            margin-right: 10px;
        }

        #cart {
            margin-top: 20px;
            position: absolute;
            top: 0;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .hidden {
            display: none;
        }

        #cart-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }
    </style>  
</body>
</html>
