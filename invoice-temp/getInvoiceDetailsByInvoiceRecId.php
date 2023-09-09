<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/invoiceDetailTemp/InvoiceDetailTemp.php";

$invoiceRecId = $_GET['invoiceRecID'];

$invoiceDetails = (new InvoiceDetailTemp())->findAllInventoryByInvoiceRecID($invoiceRecId);

header('Content-type: application/json');
echo json_encode($invoiceDetails);

