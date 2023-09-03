<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';

class Db
{
    public function connect()
    {
        // $servername = getenv('DB_HOST');
        // $username = getenv('DB_USERNAME');
        // $password = getenv('DB_PASSWORD');
        // $dbname = getenv('DB_DATABASE');
        // $port = getenv('DB_PORT');

        $servername = 'local';
        $username = 'root';
        $password = 'cs50root';
        $dbname = 'pos';

        try {
            $pdo = new PDO("sqlsrv:server=$servername ; Database=pos", "", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $th) {
            echo "Connection Failed " . $th->getMessage() . "<br>";
        }
    }
}
