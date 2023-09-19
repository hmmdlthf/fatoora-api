<?php


$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . "/pos/login/utils.php";
require_once $ROOT . "/pos/app/customerInvoiceTemp/CustomerInvoiceTemp.php";

session_check();

try {
    if (isset($_GET['recID']) && (isset($_GET['name']) || isset($_GET['code']) || isset($_GET['phone']))) {
        $recID = $_GET['recID'];
        $name = $_GET['name'];
        $code = $_GET['code'];
        $phone = $_GET['phone'];
        $result = (new CustomerInvoiceTemp())->addCustomerToInvoiceTemp($code, $phone, $name, $recID);

        if ($result) {
            header('Content-type: application/json');
            echo json_encode($result);
        } else {
            die('unsuccess');
        }
    }
} catch (Exception $e) {
    die("$e");
}
