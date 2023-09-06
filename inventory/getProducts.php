<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";
require_once $ROOT . "/app/inventory/Inventory.php";

$limit_start = $_GET['start'];
$range = $_GET['range'];

$credentials = session_get();

$inventory = new Inventory();

$records = $inventory->findInventoryRecords($credentials['username'], $credentials['password'], $limit_start, $range);

header('Content-type: application/json');
echo json_encode($records);







