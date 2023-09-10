<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";
require_once $ROOT . "/app/invoice/Invoice.php";

$limit_start = $_GET['start'];
$range = $_GET['range'];
$q = $_GET['q'];

$credentials = session_get();

$invoice = new Invoice();

if (isset($q)) {
    $records = $invoice->findInvoiceRecordsByUserBySearchTerm($limit_start, $range, $credentials['username'], $q);
} else {
    $records = $invoice->findInvoiceRecordsByUser($limit_start, $range, $credentials['username']);
}

header('Content-type: application/json');
echo json_encode($records);
