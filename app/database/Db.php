<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';

class Db
{
    public function connect()
    {
        $servername = '(local)';
        $dbname = 'saudipos';
        $username = 'posadmin';
        $password = '123';

        try {
            $pdo = new PDO("sqlsrv:server=$servername ; Database=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $th) {
            //echo "Connection Failed " . $th->getMessage() . "<br>";
        }
    }
}
