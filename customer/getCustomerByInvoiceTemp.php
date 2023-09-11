<?php


$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";
require_once $ROOT . "/app/customerInvoiceTemp/CustomerInvoiceTemp.php";

session_check();

try {
    if (isset($_GET['recID'])) {
        $recID = $_GET['recID'];
        $result = (new CustomerInvoiceTemp())->findCustomerByInvoiceTempRecID($recID);

        if ($result) {
            header('Content-type: application/json');
            echo json_encode($result);
        } else {
            die('unsuccess');
        }
    } else {
        die('enter recID');
    }
} catch (Exception $e) {
    die("$e");
}