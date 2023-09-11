<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";
require_once $ROOT . "/app/invoiceTemp/invoiceTemp.php";

$credentials = session_get();

try {
    if (isset($_GET['recID'])) {
        $recId = $_GET['recID'];
        $invoiceTemp = (new InvoiceTemp())->InsertInvoiceTempToInvoiceHold($recId);
        unset($_SESSION['InvoiceTempRecID']);
        echo "success";
    }
} catch(Exception $e) {
    die("$e");
}