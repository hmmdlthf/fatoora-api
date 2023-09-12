<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";
require_once $ROOT . "/app/invoiceHold/InvoiceHold.php";
require_once $ROOT . "/app/invoiceDetailHold/InvoiceDetailHold.php";

$credentials = session_get();

$invoice = new InvoiceHold();

function getInvoiceDetailForAllInvoices($records)
{
    $records_with_invoiceDetail = [];
    $invoiceDetail = new InvoiceDetailHold();
    foreach ($records as &$x) { // Use &$x to modify the array elements in-place
        $invoiceDetailRecords = $invoiceDetail->findAllInventoryByInvoiceRecID($x['RecID']);
        $x['InvoiceDetails'] = $invoiceDetailRecords;
        array_push($records_with_invoiceDetail, $x);
    }
    return $records_with_invoiceDetail; // Return the modified array
}

if (isset($q)) {
    // $records = $invoice->findInvoiceHoldRecordsByUser($limit_start, $range, $credentials['username'], $q);
} else {
    try {
        $records = $invoice->findInvoiceHoldRecordsByUser($credentials['username']); // Reordered parameters
        $records = getInvoiceDetailForAllInvoices($records);
    } catch (Exception $e) {
        die("$e");
    }
}

header('Content-type: application/json');
echo json_encode($records);

