<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class Inventory extends Db
{
    public function findInventoryRecords($limit_start = 0, $range = 100)
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
        ORDER BY RecID
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

    public function findInventoryRecordsBySearchTerm($searchTerm, $limit_start = 0, $range = 100)
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
        WHERE [ProductName] LIKE '%". $searchTerm . "%' 
        ORDER BY RecID
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
}
