<?php
require 'vendor/autoload.php'; // Include PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Database connection details
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "stockdatabase";

try {
    // Create a database connection using PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
// Define the file name
$excelFileName = "low_stock_data.xlsx";

// SQL query to select data where NumOfStock is less than MinStock
$query = "SELECT * FROM stock WHERE NumOfStock < MinStock";

try {
    // Prepare and execute the query
    $stmt = $pdo->query($query);

    // Create a new PhpSpreadsheet instance
    $spreadsheet = new Spreadsheet();
    $worksheet = $spreadsheet->getActiveSheet();
    $columns = ['A','B','C','D','E','F','G'];

    foreach ($columns as $column) {
        $worksheet->getColumnDimension($column)->setWidth(20);
    }
    // Style for header cells
    $headerStyle = [
        'font' => ['bold' => true],
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'CAF0FA']],
    ];
    
    // Set headers with styling
    $headers = ['Stock ID', 'Stock Name', 'No. of Stock', 'Minimum Stock', 'Maximum Stock', 'Stock Status', 'Delivery'];
    $column = 'A';
    foreach ($headers as $header) {
        $worksheet->setCellValue($column . '1', $header);
        $worksheet->getStyle($column . '1')->applyFromArray($headerStyle);
        $column++;
    }

    // Write data rows
    $rowNumber = 2;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $worksheet->fromArray($row, null, 'A' . $rowNumber);
        $rowNumber++;
    }

    // Create an Xlsx writer and save the spreadsheet
    $writer = new Xlsx($spreadsheet);
    $writer->save($excelFileName);

    // Set headers for Excel file download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $excelFileName . '"');
    header('Cache-Control: max-age=0');

    // Output the file to the browser
    $writer->save('php://output');
    exit;

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
