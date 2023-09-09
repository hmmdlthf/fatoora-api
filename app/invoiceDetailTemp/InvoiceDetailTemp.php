<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/inventory/Inventory.php";

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

    public function findAllInventoryByInvoiceRecID($invoiceRecID)
    {
        $query = "SELECT [InvoiceDetailRecID]
        ,[InvoiceRecID]
        ,[Barcode]
        ,[ProductRecID]
        ,[ProductFullName]
        ,[ProductPackageTypeRecID]
        ,[ProductPackageTypeCodeAR]
        ,[OrderQuantity]
        ,[UnitAmount]
        ,[WholesalePrice]
        ,[TotalAmount]
        FROM [saudipos].[POS].[V_InvoiceDetailTemporary]
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
        // $totalAmount = $this->calculateTotalAmount($dic['UnitAmount'], $dic['OrderQuantity']);

        $query = "INSERT INTO [saudipos].[POS].[InvoiceDetailTemporary]
        ([InvoiceRecID]
        ,[ProductRecID]
        ,[UnitAmount]
        ,[OrderQuantity]
        ,[PriceTypeRecID])
        VALUES (?, ?, ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceTempId, $dic['ProductRecID'], $dic['UnitAmount'], $dic['OrderQuantity'], $dic['PriceTypeRecID']]);
        return true;
    }

    public function updatePriceType($recId, $priceTypeRecID, $newUnitAmount)
    {
        // Check if the record exists
        $existingRecord = $this->findById($recId);
        if ($existingRecord === false) {
            return false; // Record not found
        }

        // $totalAmount = $this->calculateTotalAmount($newUnitAmount, $existingRecord['OrderQuantity']);

        $query = "UPDATE [saudipos].[POS].[InvoiceDetailTemporary]
                  SET [PriceTypeRecID] = ?,
                      [UnitAmount] = ?
                  WHERE [RecID] = ?";

        $statement = $this->connect()->prepare($query);
        $result = $statement->execute([$priceTypeRecID, $newUnitAmount, $recId]);

        return $result;
    }

    public function updateQuantity($recId, $newQuantity)
    {
        // Check if the record exists
        $existingRecord = $this->findById($recId);
        if ($existingRecord === false) {
            return false; // Record not found
        }

        // $totalAmount = $this->calculateTotalAmount($existingRecord['UnitAmount'], $newQuantity);

        $query = "UPDATE [saudipos].[POS].[InvoiceDetailTemporary]
                  SET [OrderQuantity] = ?
                  WHERE [RecID] = ?";

        $statement = $this->connect()->prepare($query);
        $result = $statement->execute([$newQuantity, $recId]);

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

    public function addByBarcode($invoiceRecID, $barcode)
    {
        $product = (new Inventory())->findInventoryRecordsByBarcode($barcode);

        if ($product) {
            // Check if a record with the same ProductRecID already exists
            $existingRecord = $this->findRecordByProductRecID($invoiceRecID, $product['RecID']);

            if ($existingRecord) {
                // If record already exists, update the quantity
                $newQuantity = $existingRecord['OrderQuantity'] + 1;
                return $this->updateQuantity($existingRecord['RecID'], $newQuantity);
            } else {
                // If no record exists, create a new one
                $dic = ['ProductRecID' => $product['RecID'], 'UnitAmount' => $product['RetailPrice'], 'OrderQuantity' => 1, 'PriceTypeRecID' => 1];
                return $this->create($invoiceRecID, $dic);
            }
        }

        return false;
    }

    private function findRecordByProductRecID($invoiceRecID, $productRecID)
    {
        $query = "SELECT [RecID]
                  FROM [saudipos].[POS].[InvoiceDetailTemporary]
                  WHERE [InvoiceRecID] = ? AND [ProductRecID] = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceRecID, $productRecID]);
        $result = $statement->fetch();

        return $result;
    }
}
