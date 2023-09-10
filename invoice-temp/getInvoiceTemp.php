<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/invoiceTemp/invoiceTemp.php";
require_once $ROOT . "/login/utils.php";

session_check();
$credentials = session_get();

if (!isset($_SESSION['InvoiceTempRecID'])) {
    $invoiceTemp = (new InvoiceTemp())->create($credentials['username']);
    $_SESSION['InvoiceTempRecID'] = $invoiceTemp;
} else {
    $invoiceTemp = $_SESSION['InvoiceTempRecID'];
}

header('Content-type: application/json');
echo json_encode($invoiceTemp);
