<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";
require_once $ROOT . "/app/inventory/Inventory.php";

$limit_start = $_GET['start'] ?? null;
$range = $_GET['range'] ?? null;
$q = $_GET['q'] ?? null;
$mode = $_GET['mode'] ?? null;
$productTypeRecID = $_GET['productTypeRecID'] ?? null;

$credentials = session_get();

$inventory = new Inventory();

try {
    if (isset($q)) {
        $records = $inventory->findInventoryRecordsBySearchTerm($q, $limit_start, $range, $mode);
    } else {
        $records = $inventory->findInventoryRecords($limit_start, $range, $mode, $productTypeRecID);
    }
} catch (Exception $e) {
    die("$e");
}



header('Content-type: application/json');
echo json_encode($records);
