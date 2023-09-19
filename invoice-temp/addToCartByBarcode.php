<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . "/pos/app/invoiceDetailTemp/InvoiceDetailTemp.php";

try {
    $invoiceRecId = $_GET['invoiceRecID'];
    $barcode = $_GET['barcode'];
    $mode = $_GET['mode'] ?? null;
    $invoiceDetailTemp = (new InvoiceDetailTemp())->addByBarcode($invoiceRecId, $barcode, $mode);
} catch (Exception $e) {
    die($e);
}

header('Content-type: application/json');
echo json_encode(['status'=> 'success']);