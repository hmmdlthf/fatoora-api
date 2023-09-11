<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/invoiceDetailTemp/InvoiceDetailTemp.php";

try {
    $invoiceRecId = $_GET['invoiceRecID'];
    $barcode = $_GET['barcode'];
    $invoiceDetailTemp = (new InvoiceDetailTemp())->addByBarcode($invoiceRecId, $barcode);
} catch (Exception $e) {
    die($e);
}

header('Content-type: application/json');
echo json_encode(['status'=> 'success']);