<?php 

$ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . '/pos/app/inventory/Inventory.php';

try {
    $barcode = $_GET['barcode'] ?? null;
    $mode = $_GET['mode'] ?? null;
    $records = (new Inventory())->findSubstituteProductsByBarcode($barcode, $mode);
} catch (Exception $e) {
    die("$e");
}

header('Content-type: application/json');
echo json_encode($records);
