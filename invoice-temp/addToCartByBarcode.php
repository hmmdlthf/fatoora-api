<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . "/pos/app/invoiceDetailTemp/InvoiceDetailTemp.php";
require_once $ROOT . "/pos/app/inventory/Inventory.php";

try {
    $invoiceRecId = $_GET['invoiceRecID'];
    $barcode = $_GET['barcode'];
    $mode = $_GET['mode'] ?? null;
    
    $inventory = new Inventory();
    $is_weighted_barcode = $inventory->checkWeightedBarcode($barcode);

    if ($is_weighted_barcode) {
        $array = $inventory->processWeightedBarcode($barcode);
        $invoiceDetailTemp = (new InvoiceDetailTemp())->addWeightedByBarcode($invoiceRecId, $array['barcode'], $mode, $array['quantity']);
    } else {
        $invoiceDetailTemp = (new InvoiceDetailTemp())->addByBarcode($invoiceRecId, $barcode, $mode);
    }
} catch (Exception $e) {
    die($e);
}

header('Content-type: application/json');
echo json_encode(['status' => 'success']);
