<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class Invoice extends Db
{
    public function findInvoiceRecordsByUser($limit_start = 0, $range = 100, $username)
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
        FROM [saudipos].[POS].[V_Invoice]
        WHERE [CreatedBy] = '" . $username . "'
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
        FROM [saudipos].[POS].[V_Invoice]
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

    public function findInvoiceHeaderFooter($recID)
    {
        $query = "SELECT 
        InvoiceNumber, 
        convert (varchar,InvoiceDate) as Date, 
        convert (varchar, CreatedTime, 8) as Time, 
        CashierID, 
        CashAmount, 
        CardAmount, 
        BalanceAmount, 
        TotalSubTotal, 
        TotalVATAmount, 
        GrandTotal, 
        CustomerName, 
        CustomerNameAR, 
        VATNumber, 
        Remarks 
        FROM POS.V_InvoiceHeaderFooter 
        WHERE RecID = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$recID]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }
}
