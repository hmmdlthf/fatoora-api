<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";


$query = "SELECT * FROM Product";
$statement = $this->connect()->prepare($query);
$statement->execute([1]);
$resultSet = $statement->fetch();

if ($resultSet > 0) {
    echo "$resultSet";
}

?>