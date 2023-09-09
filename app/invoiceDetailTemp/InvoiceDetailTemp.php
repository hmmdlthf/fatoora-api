<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class InvoiceDetailTemp extends Db
{
    public function findById($recId)
    {
        $query = "SELECT [RecID]
        ,[InvoiceRecID]
        ,[ProductRecID]
        ,[UnitAmount]
        ,[OrderQuantity]
        ,[PriceTypeRecID]
        ,[TotalAmount]
        FROM [saudipos].[POS].[InvoiceDetailTemporary] 
        WHERE [RecID] = '" . $recId . "'";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findAllByInvoiceRecID($invoiceRecID)
    {
        $query = "SELECT [RecID]
                         ,[InvoiceRecID]
                         ,[ProductRecID]
                         ,[UnitAmount]
                         ,[OrderQuantity]
                         ,[PriceTypeRecID]
                         ,[TotalAmount]
                  FROM [saudipos].[POS].[InvoiceDetailTemporary]
                  WHERE [InvoiceRecID] = ?";
        
        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceRecID]);
        $result = $statement->fetchAll();

        if ($result > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function calculateTotalAmount($unitAmount, $orderQuantity)
    {
        return $unitAmount * $orderQuantity;
    }

    public function create($invoiceTempId, $dic)
    {
        $totalAmount = $this->calculateTotalAmount($dic['UnitAmount'], $dic['OrderQuantity']);

        $query = "INSERT INTO [saudipos].[POS].[InvoiceDetailTemporary]
        ([InvoiceRecID]
        ,[ProductRecID]
        ,[UnitAmount]
        ,[OrderQuantity]
        ,[PriceTypeRecID]
        ,[TotalAmount])
        VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceTempId, $dic['ProductRecID'], $dic['UnitAmount'], $dic['OrderQuantity'], $dic['PriceTypeRecID'], $totalAmount]);
        return true;
    }

    public function updatePriceType($recId, $priceTypeRecID, $newUnitAmount)
    {
        // Check if the record exists
        $existingRecord = $this->findById($recId);
        if ($existingRecord === false) {
            return false; // Record not found
        }

        $totalAmount = $this->calculateTotalAmount($newUnitAmount, $existingRecord['OrderQuantity']);

        $query = "UPDATE [saudipos].[POS].[InvoiceDetailTemporary]
                  SET [PriceTypeRecID] = ?,
                      [UnitAmount] = ?,
                      [TotalAmount] = ?
                  WHERE [RecID] = ?";

        $statement = $this->connect()->prepare($query);
        $result = $statement->execute([$priceTypeRecID, $newUnitAmount, $totalAmount, $recId]);

        return $result;
    }

    public function updateQuantity($recId, $newQuantity)
    {
        // Check if the record exists
        $existingRecord = $this->findById($recId);
        if ($existingRecord === false) {
            return false; // Record not found
        }

        $totalAmount = $this->calculateTotalAmount($existingRecord['UnitAmount'], $newQuantity);

        $query = "UPDATE [saudipos].[POS].[InvoiceDetailTemporary]
                  SET [OrderQuantity] = ?,
                      [TotalAmount] = ?
                  WHERE [RecID] = ?";

        $statement = $this->connect()->prepare($query);
        $result = $statement->execute([$newQuantity, $totalAmount, $recId]);

        return $result;
    }

    public function delete($recId)
    {
        // Check if the record exists
        $existingRecord = $this->findById($recId);
        if ($existingRecord === false) {
            return false; // Record not found
        }

        // Delete the record
        $query = "DELETE FROM [saudipos].[POS].[InvoiceDetailTemporary] WHERE [RecID] = ?";

        $statement = $this->connect()->prepare($query);
        $result = $statement->execute([$recId]);

        return $result;
    }
}
