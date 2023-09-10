<?php


$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";
require_once $ROOT . "/app/customer/Customer.php";

session_check();

try {
    if (isset($_GET['term'])) {
        $term = $_GET['term'];
        $customers = (new Customer())->findBySearchTerm($term);
        header('Content-type: application/json');
        echo json_encode($customers);
    }
} catch(Exception $e) {
    die("$e");
}

