<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/login/utils.php';
require_once $ROOT . '/app/utils/encrypt.php';

session_check();

echo $_SESSION['username'] . "\n";

$encypt = new Encrytp();
$d_password = $encypt->decrypt_string($_SESSION['password']);
echo $d_password;