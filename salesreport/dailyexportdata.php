<?php 
 
// Load the database configuration file 
include_once 'dbConfig.php'; 
 
// Fetch records from database 
$query = $db->query("SELECT * FROM `sales` WHERE DateofSale=(CURRENT_DATE);"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "sales_data" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ReceiptID', 'ItemID', 'ItemName', 'ItemPrice', 'Quantity', 'TotalPrice', 'DateofSale'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        //$status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['ReceiptID'], $row['ItemID'], $row['ItemName'], $row['ItemPrice'], $row['Quantity'], $row['TotalPrice'], $row['DateofSale']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>