<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "salesdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$receiptID = generateUniqueReceiptID($conn);
$dateOfSale = date("Y-m-d");

$shoppingCart = [
    'I780' => ['Apples', 4],
    'I765' => ['Oranges', 3],
    'I700' => ['Bananas', 3],
    'I781' => ['Watermelons', 6],
    'I785' => ['Lemons', 2]
];

foreach ($shoppingCart as $itemID => $itemInfo) {
    $itemName = $itemInfo[0];
    $itemPrice = $itemInfo[1];
    $quantity = $_POST[$itemID];

    $totalPrice = $itemPrice * $quantity;

    $updateSql = "UPDATE stock SET NumOfStock = NumOfStock - $quantity WHERE StockName = '$itemName'";

    if ($conn->query($updateSql) !== TRUE) {
        $_SESSION['errorMessage'] = "Error updating stock table: " . $conn->error;
        break;
    }

    $insertSql = "INSERT INTO sales (ReceiptID, ItemID, ItemName, ItemPrice, Quantity, TotalPrice, DateofSale) VALUES ('$receiptID', '$itemID', '$itemName', $itemPrice, $quantity, $totalPrice, '$dateOfSale')";

    if ($conn->query($insertSql) !== TRUE) {
        $_SESSION['errorMessage'] = "Error inserting sales record: " . $conn->error;
        break;
    }
}
if (!isset($_SESSION['errorMessage'])) {
    $_SESSION['successMessage'] = "Order confirmed and paid successfully!";
}

$conn->close();

header("Location: index.php");
exit();

function generateUniqueReceiptID($conn)
{
    $prefix = "RC";
    $uniqueID = generateRandomID();
    $flag = false;

    do {
        $checkSql = "SELECT ReceiptID FROM sales WHERE ReceiptID = '$prefix$uniqueID'";
        $result = $conn->query($checkSql);

        if ($result->num_rows === 0) {
            $flag = true;
        } else {
            $uniqueID = generateRandomID();
        }
    } while (!$flag);

    return $prefix . $uniqueID;
}


function generateRandomID()
{
    return str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
}
?>
