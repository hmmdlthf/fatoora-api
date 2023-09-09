<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/invoiceDetailTemp/InvoiceDetailTemp.php";

try {
    $recId = $_GET['recID'];
    if ($recId) {
        $result = (new InvoiceDetailTemp())->delete($recId);
    }
} catch(Exception $e) {
    die("$e");
}

if ($result) {
    echo "delete success";
} else {
    echo "not successfull";
}

