<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/invoiceTemp/invoiceTemp.php";
require_once $ROOT . "/login/utils.php";

$credentials = session_get();

// try {

// }catch(Exception $e) {
//     echo "$e";
// }



// $invoiceNumber = (new InvoiceTemp())->updateInvoiceNumber(9916, 'INV/00009916');

$invoiceNumber = (new Invoice())->generateInvoiceNumber();

echo $invoiceNumber;