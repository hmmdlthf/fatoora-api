<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . "/pos/app/database/Db.php";

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
        WHERE [CreatedBy] = '" . $userRecID . "'
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

    public function findInvoiceRecordsOnHoldByUser($username)
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
        WHERE [CreatedBy] = ? AND [StatusRecID] = 4
        ORDER BY RecID";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$username]);
        $resultSet = $statement->fetchAll();

        return ($resultSet) ? $resultSet : false;
    }

    public function findInvoiceRecordsOnHoldByUserBySearchTerm($limit_start = 0, $range = 100, $userRecID, $term)
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
        WHERE [CreatedBy] = '" . $userRecID . "', [StatusRecID] = 4
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

    public function findByInvoiceNumber($invoiceNumber)
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
        WHERE [InvoiceNumber] = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceNumber]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function generateInvoiceNumber()
    {
        // Query for the last entered invoice number
        $query = "SELECT TOP 1 [InvoiceNumber]
                  FROM [saudipos].[POS].[Invoice]
                  ORDER BY [RecID] DESC";
    
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $lastInvoiceNumber = $statement->fetch()['InvoiceNumber'];
    
        // Extract the integer part of the invoice number using regex
        if (preg_match('/(\d+)/', $lastInvoiceNumber, $matches)) {
            $lastInvoiceNumberInt = (int)$matches[0];
            // Add 1 to the integer part
            $newInvoiceNumberInt = $lastInvoiceNumberInt + 1;
            // Format the new invoice number with leading zeros
            $prefix = 'INV/';
            $formattedInvoiceNumber = $prefix . '00000' . $newInvoiceNumberInt;
            return $formattedInvoiceNumber;
        }
    }

    public function makeInvoiceHold($recID)
    {
        $query = "UPDATE [saudipos].[POS].[Invoice]
        SET StatusRecID = 4
        WHERE RecID = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$recID]);

        return $recID;
    }
}
