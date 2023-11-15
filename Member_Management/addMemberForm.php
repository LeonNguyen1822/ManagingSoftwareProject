<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Customer</title>
</head>
<body>
    <h1>Add New Customer</h1>
	
    <form action="addMemberProcess.php" method="post">
	
		<label for ="Id">Id:</label>
		<input type="text" id="id" name="id" required><br><br>
		
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}" placeholder="e.g., 1234567890"><br><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" required></textarea><br><br>
       
        <input type="submit" value="Add Customer">
    </form>
</body>
</html>
