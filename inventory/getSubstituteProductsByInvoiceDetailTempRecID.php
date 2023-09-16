<?php 

$ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/inventory/Inventory.php';

try {
    $invoiceDetailTempRecID = $_GET['invoiceDetailTempRecID'] ?? null;
    $mode = $_GET['mode'] ?? null;
    $records = (new Inventory())->findSubstituteProductsByInvoiceDetailTempRecID($invoiceDetailTempRecID, $mode);
} catch (Exception $e) {
    die("$e");
}

header('Content-type: application/json');
echo json_encode($records);
