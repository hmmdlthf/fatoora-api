<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";
require_once $ROOT . "/app/inventory/Inventory.php";

$barcode = $_GET['barcode'];

$credentials = session_get();

$inventory = new Inventory();

$record = $inventory->findInventoryRecordsByBarcode($credentials['username'], $credentials['password'], $barcode);

header('Content-type: application/json');
echo json_encode($record);