<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/invoiceTemp/invoiceTemp.php";
require_once $ROOT . "/login/utils.php";

session_check();

if (!isset($_GET['invoiceRecID'])) {
    die("No invoice with that id");
}

$invoiceRecId = $_GET['invoiceRecID'];
$invoiceTemp = (new InvoiceTemp())->findById($invoiceRecId);

header('Content-type: application/json');
echo json_encode($invoiceTemp);