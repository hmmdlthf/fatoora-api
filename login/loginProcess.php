<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/database/Db.php';
require_once $ROOT . '/login/utils.php';

$db = new Db();

$username = $_POST['username'];
$password = $_POST['password'];

if (!isset($username) || !isset($password)) {
    $error_message = "Fill all the fields";
    header('Location: /index.php');
    exit();
}

try {
    $conn = $db->connect($username, $password);
} catch (Exception $e) {
    $error_message = "Login failed! wrong login or password";
    header('Location: /index.php');
    exit();
}

if ($conn) {
    session_config($username, $password);
    header('Location: /dashboard-css.php');
} else {
    $error_message = "Login failed! wrong login or password";
    header('Location: /index.php');
    exit();
}

?>
