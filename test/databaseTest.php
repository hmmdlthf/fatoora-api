<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

$db = new Db();

$query = "SELECT * FROM Product";
$statement = $db->connect()->prepare($query);
$statement->execute([1]);
$resultSet = $statement->fetch();

if ($resultSet > 0) {
    var_dump($resultSet);
}

?>