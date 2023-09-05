<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/database/Db.php';
require_once $ROOT . '/login/utils.php';

$db = new Db();

$username = $_POST['username'];
$password = $_POST['password'];

if (!isset($username) || !isset($password)) {
    die("Fill all the fields");
}

try {
    $conn = $db->connect($username, $password);
} catch (Exception $e) {
    echo "Wrong credentials";
    exit();
}

if ($conn) {
    session_config($username, $password);
    header('Location: /dashboard-css.php');
} else {
    die("Login failed! wrong login or password");
}
