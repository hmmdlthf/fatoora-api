<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';

class Db
{
    public function connect($username, $password)
    {
        $servername = '(local)';
        $dbname = 'saudipos';

        try {
            $pdo = new PDO("sqlsrv:server=$servername ; Database=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $th) {
            //echo "Connection Failed " . $th->getMessage() . "<br>";
        }
    }
}
