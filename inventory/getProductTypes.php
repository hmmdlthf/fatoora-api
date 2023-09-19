<?php 

$ROOT = $_SERVER['DOCUMENT_ROOT'];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . '/pos/app/inventory/Inventory.php';

try {
    $records = (new Inventory())->findProductTypes();
} catch (Exception $e) {
    die("$e");
}

header('Content-type: application/json');
echo json_encode($records);
