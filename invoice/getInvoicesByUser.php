<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . "/pos/login/utils.php";
require_once $ROOT . "/pos/app/invoice/Invoice.php";

$limit_start = $_GET['start'] ?? null;
$range = $_GET['range'] ?? null;
$q = $_GET['q'] ?? null;

$credentials = session_get();

$invoice = new Invoice();

if (isset($q)) {
    $records = $invoice->findInvoiceRecordsByUserBySearchTerm($limit_start, $range, $credentials['username'], $q);
} else {
    $records = $invoice->findInvoiceRecordsByUser($limit_start, $range, $credentials['username']);
}

header('Content-type: application/json');
echo json_encode($records);
