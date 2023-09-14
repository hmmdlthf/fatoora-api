<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";
require_once $ROOT . "/app/invoiceTemp/invoiceTemp.php";
require_once $ROOT . "/app/constants/Constants.php";

try {
    if (isset($_GET['recID']) && (isset($_GET['cardAmount']) || isset($_GET['cashAmount']))) {
        $recID = $_GET['recID'];
        $cashAmount = $_GET['cashAmount'];
        $cardAmount = $_GET['cardAmount'];
        $invoiceTemp = (new InvoiceTemp())->addPayment($recID, $cashAmount, $cardAmount);
    }
} catch (Exception $e) {
    die("$e");
}


if ($invoiceTemp) {
    header('Content-type: application/json');
    echo json_encode(['status' => 'success']);
} else {
    die('unsuccess');
}
