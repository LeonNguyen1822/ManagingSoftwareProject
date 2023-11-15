<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted to update customer data
    if (isset($_POST["update_customer"])) {
        // Retrieve data from the edit form
        $customerID = $_POST["customer_id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        // Connect to your database (replace with your database details)
        $host = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "customer";

        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Update customer data in the database
        $sql = "UPDATE customers SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE customer_id = $customerID";

        if (mysqli_query($conn, $sql)) {
            echo "Customer data has been successfully updated.";
        } else {
            echo "Error updating customer data: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // Retrieve the member ID from the first form
        $customerID = $_POST["member_id"];

        // Sanitize and validate the customer ID if needed

        // Connect to your database (replace with your database details)
        $host = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "customer";

        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch customer data based on the provided customer ID
        $sql = "SELECT * FROM customers WHERE customer_id = '$customerID'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $address = $row['address'];

            // Display the retrieved customer data in an edit form
            echo "<h2>Edit Customer</h2>";
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='customer_id' value='$customerID'>";
            echo "Name: <input type='text' name='name' value='$name'><br>";
            echo "Email: <input type='text' name='email' value='$email'><br>";
            echo "Phone: <input type='text' name='phone' value='$phone'><br>";
            echo "Address: <input type='text' name='address' value='$address'><br>";
            echo "<input type='submit' name='update_customer' value='Update Customer'>";
            echo "</form>";
        } else {
            echo "Customer not found.";
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>
