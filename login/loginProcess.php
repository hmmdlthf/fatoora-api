<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/database/Db.php';

$db = new Db();

$username = $_POST['username'];
$password = $_POST['password'];

try {
    $conn = $db->connect($username, $password);
} catch (Exception $e) {
    echo "Wrong credentials";
    exit();
}

if ($conn) {
    header('Location: /dashboard-css.php');
} else {
    die("Login failed! wrong login or password");
}

