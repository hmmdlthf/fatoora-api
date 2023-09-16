<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/invoiceDetailTemp/InvoiceDetailTemp.php";

try {
    if (isset($_GET['recID']) && isset($_GET['orderQuantity'])) {
        $recId = $_GET['recID'];
        $orderQuantity = $_GET['orderQuantity'];

        $invoiceDetailTemp = new InvoiceDetailTemp();
        $result = $invoiceDetailTemp->updateQuantity($recId, $orderQuantity);
        
    } else {
        throw new Exception("Both recID and orderQuantity must be set.");
    }
} catch (Exception $e) {
    die("$e");
}

if ($result) {
    header('Content-type: application/json');
    echo json_encode(['status'=> 'success']);
} else {
    echo "not successful";
}