<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // You can perform actions with the data here, such as storing it in a database
    // For example, to insert data into a MySQL database:

    // Establish a database connection (replace these with your database details)
    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "customer";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert data into the database
    $sql = "INSERT INTO customers (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";

    if (mysqli_query($conn, $sql)) {
        echo "Customer data has been successfully added to the database.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
