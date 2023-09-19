<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . "/pos/login/utils.php";
require_once $ROOT . "/pos/app/invoiceTemp/invoiceTemp.php";

$credentials = session_get();

try {
    if (isset($_GET['recID'])) {
        $recId = $_GET['recID'];
        $invoiceTemp = (new InvoiceTemp())->InsertInvoiceTempToInvoice($recId);
        header('Content-type: application/json');
        echo json_encode($invoiceTemp);
    }
} catch(Exception $e) {
    die("$e");
}

// header('Content-type: application/json');
// echo json_encode($records);