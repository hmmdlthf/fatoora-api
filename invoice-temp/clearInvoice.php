<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/login/utils.php";

session_check();

unset($_SESSION['InvoiceTempRecID']);

echo 'hold success';