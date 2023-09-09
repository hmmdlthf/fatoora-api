<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class Customer extends Db
{
    public function find($customerCode, $customerNo, $customerName)
    {
        $query = "SELECT TOP 1 * FROM Business.Customer WHERE (Code = ? OR Phone = ? OR NameAR = ?) AND RecID <> 1";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$customerCode, $customerNo, $customerName]);

        $result = $stmt->fetch();

        if ($result > 0) {
            return $result;
        } else {
            return false;
        }
    }

    
}
