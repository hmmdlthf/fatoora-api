<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class Inventory extends Db
{
    public function findInventoryRecords($username, $password, $limit_start = 0, $range = 100)
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
        FROM [saudipos].[POS].[V_ProductRetail_Inventory]
        ORDER BY RecID
        OFFSET ". $limit_start . " ROWS
        FETCH NEXT ". ($range) . " ROWS ONLY";

        $statement = $this->connect($username, $password)->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetchAll();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findInventoryRecordsBySearchTerm($username, $password, $searchTerm, $limit_start = 0, $range = 100)
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
        FROM [saudipos].[POS].[V_ProductRetail_Inventory]
        WHERE [ProductName] LIKE '%". $searchTerm . "%' 
        ORDER BY RecID
        OFFSET ". $limit_start . " ROWS
        FETCH NEXT ". ($range) . " ROWS ONLY";

        $statement = $this->connect($username, $password)->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetchAll();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findInventoryRecordsByBarcode($username, $password, $barcode)
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
        FROM [saudipos].[POS].[V_ProductRetail_Inventory]
        WHERE [UPC] LIKE '". $barcode . "' ";

        $statement = $this->connect($username, $password)->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }
}
