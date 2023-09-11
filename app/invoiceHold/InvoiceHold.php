<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class InvoiceHold extends Db
{
    public function findInvoiceHoldRecordsByUser($username)
    {
        $query = "SELECT [Code] AS CustomerCode,
                     [Name],
                     [NameAR],
                     [RecID],
                     [CustomerRecID],
                     [PriceTypeRecID],
                     [InvoiceNumber],
                     [InvoiceDate],
                     [CashierPerson],
                     [GrandTotal]
              FROM [saudipos].[POS].[V_InvoiceHold]
              WHERE [CreatedBy] = ? -- :username
              ORDER BY RecID";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$username]);
        $resultSet = $statement->fetchAll();

        if ($resultSet) {
            return $resultSet;
        } else {
            return false;
        }
    }


    public function findInvoiceRecordsByUserBySearchTerm($limit_start = 0, $range = 100, $userRecID, $term)
    {
        $query = "SELECT [Code] CustomerCode
        ,[Name]
        ,[NameAR]
        ,[RecID]
        ,[CustomerRecID]
        ,[PriceTypeRecID]
        ,[InvoiceNumber]
        ,[InvoiceDate]
        ,[CashierPerson]
        ,[GrandTotal]
        FROM [saudipos].[POS].[V_InvoiceHold]
        WHERE [CashierPerson] = $userRecID
        ORDER BY RecID
        OFFSET " . $limit_start . " ROWS
        FETCH NEXT " . ($range) . " ROWS ONLY";

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
