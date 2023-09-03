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

        $servername = 'KEVIN-JORN-PC';
        $dbname = 'pos';

        try {
            $pdo = new PDO("sqlsrv:server=$servername ; Database=$dbname", "", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $th) {
            echo "Connection Failed " . $th->getMessage() . "<br>";
        }
    }
}
