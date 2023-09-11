<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";
require_once $ROOT . "/app/invoiceHold/InvoiceHold.php";
require_once $ROOT . "/app/invoiceDetailHold/InvoiceDetailHold.php";

$limit_start = (int)$_GET['start']; // Cast to integer
$range = (int)$_GET['range']; // Cast to integer
$q = $_GET['q'];

$credentials = session_get();

$invoice = new InvoiceHold();

$records_with_invoiceDetail = [];

function getInvoiceDetailForAllInvoices($records)
{
    $invoiceDetail = new InvoiceDetailHold();
    foreach ($records as $x) { // Use &$x to modify the array elements in-place
        $invoiceDetailRecords = $invoiceDetail->findAllInventoryByInvoiceRecID($x['RecID']);
        $x['InvoiceDetails'] = $invoiceDetailRecords;
    }
    return $records;
}

if (isset($q)) {
    // $records = $invoice->findInvoiceHoldRecordsByUser($limit_start, $range, $credentials['username'], $q);
} else {
    try {
        $records = $invoice->findInvoiceHoldRecordsByUser($limit_start, $range, $credentials['username']); // Reordered parameters
        $records = getInvoiceDetailForAllInvoices($records);
    } catch (Exception $e) {
        die("$e");
    }
}

header('Content-type: application/json');
echo json_encode($records);

