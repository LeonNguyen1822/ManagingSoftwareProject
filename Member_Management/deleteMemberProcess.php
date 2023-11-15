<?php
// Check if the form has been submitted with a member ID for deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["member_id_delete"])) {
    // Retrieve the member ID to be deleted
    $memberIDToDelete = $_POST["member_id_delete"];

    // Establish a database connection (replace with your database details)
    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "customer";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete the member from the database based on the provided member ID
    $sql = "DELETE FROM customers WHERE customer_id = $memberIDToDelete";

    if (mysqli_query($conn, $sql)) {
        echo "Member with ID $memberIDToDelete has been successfully deleted.";
    } else {
        echo "Error deleting member: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
