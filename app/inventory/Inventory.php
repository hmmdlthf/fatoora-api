<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/constants/Constants.php";
require_once $ROOT . "/app/invoiceDetailTemp/InvoiceDetailTemp.php";

class Inventory extends Db
{
    public function findInventoryRecords($limit_start = 0, $range = 100, $mode = InventoryModes::WAREHOUSE, $productTypeRecID)
    {
        $table = $mode == InventoryModes::WAREHOUSE ? '[saudipos].[POS].[V_ProductRetail_InventoryW]' : '[saudipos].[POS].[V_ProductRetail_InventoryR]';
        $recID_columnName = $mode == InventoryModes::WAREHOUSE ? '[RecID]' : '[ProductRecID]';
        $condition = $productTypeRecID ? "WHERE [ProductTypeRecID] = $productTypeRecID" : '';
        $query = "SELECT [Warehouse]
        ,$recID_columnName
        ,[UPC]
        ,[SKU]
        ,[ProductName]
        ,[ProductNameAR]
        ,[WholesalePrice]
        ,[RetailPrice]
        ,[ProductPackageTypeCode]
        ,[ProductPackageTypeCodeAR]
        ,[StockOnHand]
        FROM $table $condition
        ORDER BY $recID_columnName
        OFFSET ". $limit_start . " ROWS
        FETCH NEXT ". ($range) . " ROWS ONLY";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetchAll();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findInventoryRecordsBySearchTerm($searchTerm, $limit_start = 0, $range = 100, $mode = InventoryModes::WAREHOUSE)
    {
        $table = $mode == InventoryModes::WAREHOUSE ? '[saudipos].[POS].[V_ProductRetail_InventoryW]' : '[saudipos].[POS].[V_ProductRetail_InventoryR]';
        $recID_columnName = $mode == InventoryModes::WAREHOUSE ? '[RecID]' : '[ProductRecID]';
        $query = "SELECT [Warehouse]
        ,$recID_columnName
        ,[UPC]
        ,[SKU]
        ,[ProductName]
        ,[ProductNameAR]
        ,[WholesalePrice]
        ,[RetailPrice]
        ,[ProductPackageTypeCode]
        ,[ProductPackageTypeCodeAR]
        ,[StockOnHand]
        FROM $table
        WHERE [ProductName] LIKE '%". $searchTerm . "%' 
        ORDER BY $recID_columnName
        OFFSET ". $limit_start . " ROWS
        FETCH NEXT ". ($range) . " ROWS ONLY";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetchAll();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findInventoryRecordsByBarcode($barcode)
    {
        $query = "SELECT [Warehouse]
        ,[RecID]
        ,[UPC]
        ,[SKU]
        ,[ProductName]
        ,[ProductNameAR]
        ,[WholesalePrice]
        ,[RetailPrice]
        ,[ProductPackageTypeCode]
        ,[ProductPackageTypeCodeAR]
        ,[StockOnHand]
        FROM [saudipos].[POS].[V_ProductRetail_Inventory_No_WE]
        WHERE [UPC] LIKE '". $barcode . "' ";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findProductTypes()
    {
        $query = "SELECT [RecID]
        ,[ProductGroupRecID]
        ,[Code]
        ,[Name]
        ,[NameAR]
        FROM [saudipos].[CodeMaster].[ProductType]";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetchAll();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function hasEnoughStock($productRecID, $quantity)
    {
        // Query the database to get the current stock quantity for the product with the given RecID.
        $query = "SELECT [StockOnHand] FROM [saudipos].[POS].[V_ProductRetail_InventoryW] WHERE [RecID] = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$productRecID]);
        $row = $statement->fetch();

        if ($row && isset($row['StockOnHand'])) {
            $currentStock = $row['StockOnHand'];

            // Check if there is enough stock.
            if ($currentStock >= $quantity) {
                return true; // There is enough stock.
            }
        }

        return false; // Not enough stock.
    }

    public function findSubstituteProductsByBarcode($barcode, $mode = InventoryModes::WAREHOUSE)
    {
        $table = $mode == InventoryModes::WAREHOUSE ? '[saudipos].[POS].[V_ProductRetail_InventoryW]' : '[saudipos].[POS].[V_ProductRetail_InventoryR]';
        $recID_columnName = $mode == InventoryModes::WAREHOUSE ? '[RecID]' : '[ProductRecID]';
        $query = "SELECT TOP(50) [Warehouse]
        ,$recID_columnName
        ,[UPC]
        ,[SKU]
        ,[ProductName]
        ,[ProductNameAR]
        ,[WholesalePrice]
        ,[RetailPrice]
        ,[ProductPackageTypeCode]
        ,[ProductPackageTypeCodeAR]
        ,[ProductTypeRecID]
		,[ProductCategoryRecID]
        ,[StockOnHand]
        FROM $table
        WHERE [ProductCategoryRecID] = 
            (SELECT [ProductCategoryRecID] 
			FROM $table 
			WHERE [UPC] = ? )
        AND [StockOnHand] > 0
        ORDER BY [StockOnHand]";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$barcode]);
        $resultSet = $statement->fetchAll();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findSubstituteProductsByInvoiceDetailTempRecID($invoiceDetailTempRecID, $mode = InventoryModes::WAREHOUSE)
    {
        $table = $mode == InventoryModes::WAREHOUSE ? '[saudipos].[POS].[V_ProductRetail_InventoryW]' : '[saudipos].[POS].[V_ProductRetail_InventoryR]';
        $recID_columnName = $mode == InventoryModes::WAREHOUSE ? '[RecID]' : '[ProductRecID]';
        $query = "SELECT TOP(50) [Warehouse]
        ,$recID_columnName
        ,[UPC]
        ,[SKU]
        ,[ProductName]
        ,[ProductNameAR]
        ,[WholesalePrice]
        ,[RetailPrice]
        ,[ProductPackageTypeCode]
        ,[ProductPackageTypeCodeAR]
        ,[ProductTypeRecID]
		,[ProductCategoryRecID]
        ,[StockOnHand]
        FROM $table
        WHERE [ProductCategoryRecID] = 
            (SELECT [ProductCategoryRecID] 
			FROM $table 
			WHERE $recID_columnName = (SELECT [ProductRecID] FROM [saudipos].[POS].[V_InvoiceDetailTemporary] WHERE [InvoiceDetailRecID] = ?))
        AND [StockOnHand] > 0
        ORDER BY [StockOnHand]";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceDetailTempRecID]);
        $resultSet = $statement->fetchAll();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }
}
