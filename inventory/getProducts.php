<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";
require_once $ROOT . "/app/inventory/Inventory.php";

$limit_start = $_GET['start'];
$range = $_GET['range'];
$q = $_GET['q'];

$credentials = session_get();

$inventory = new Inventory();

if (isset($q)) {
    $records = $inventory->findInventoryRecordsBySearchTerm($q, $limit_start, $range);
} else {
    $records = $inventory->findInventoryRecords($limit_start, $range);
}

header('Content-type: application/json');
echo json_encode($records);
