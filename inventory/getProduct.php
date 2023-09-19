<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . "/pos/login/utils.php";
require_once $ROOT . "/pos/app/inventory/Inventory.php";

$barcode = $_GET['barcode'];

$credentials = session_get();

$inventory = new Inventory();

$record = $inventory->findInventoryRecordsByBarcode($barcode);

header('Content-type: application/json');
echo json_encode($record);