<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";
require_once $ROOT . "/app/invoiceTemp/invoiceTemp.php";
require_once $ROOT . "/app/constants/Constants.php";

try {
    if (isset($_GET['recID']) && isset($_GET['paymentMethod']) && isset($_GET['paymentAmount'])) {
        $recID = $_GET['recID'];
        $method = $_GET['paymentMethod'];
        $amount = $_GET['paymentAmount'];
        $invoiceTemp = (new InvoiceTemp())->addPayment($recID, $method, $amount);
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
