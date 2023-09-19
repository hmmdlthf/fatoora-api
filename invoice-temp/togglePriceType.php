<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . "/pos/app/invoiceDetailTemp/InvoiceDetailTemp.php";

try {
    if (isset($_GET['recID']) && isset($_GET['priceTypeID'])) {
        $recId = $_GET['recID'];
        $priceTypeID = $_GET['priceTypeID'];

        $invoiceDetailTemp = new InvoiceDetailTemp();

        if ($priceTypeID == 2) {
            $result = $invoiceDetailTemp->updatePriceType($recId, 1);
        } else if ($priceTypeID == 1) {
            $result = $invoiceDetailTemp->updatePriceType($recId, 2);
        }
    } else {
        throw new Exception("Both recID and priceTypeID must be set.");
    }
} catch (Exception $e) {
    die("$e");
}

if ($result) {
    echo "update success";
} else {
    echo "not successful";
}