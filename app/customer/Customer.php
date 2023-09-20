<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . "/pos/app/database/Db.php";

class Customer extends Db
{
    public function find($recID)
    {
        $query = "SELECT
        [RecID]
        ,[Code]
        ,[Name]
        ,[NameAR]
        ,[Phone]
        FROM [Emtyaz].[Business].[Customer]
        WHERE [RecID] = '" . $recID . "'";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findByCode($customerCode, $customerNo, $customerName)
    {
        $query = "SELECT TOP 1 * FROM Business.Customer WHERE (Code = ? OR Phone = ? OR Name = ?) AND RecID <> 1";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$customerCode, $customerNo, $customerName]);

        $result = $stmt->fetch();

        if ($result > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function findBySearchTerm($term)
    {
        $query = "SELECT TOP (8) [RecID]
        ,[Code]
        ,[Name]
        ,[NameAR]
        ,[Phone]
        FROM [Emtyaz].[Business].[Customer]
        WHERE [Name] LIKE '%" . $term . "%'";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetchAll();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }
}
