<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . "/pos/app/invoiceDetailTemp/InvoiceDetailTemp.php";

$invoiceRecId = $_GET['invoiceRecID'];

$invoiceDetails = (new InvoiceDetailTemp())->findAllInventoryByInvoiceRecID($invoiceRecId);

header('Content-type: application/json');
echo json_encode($invoiceDetails);

