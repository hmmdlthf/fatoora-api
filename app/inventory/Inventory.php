<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . "/pos/app/database/Db.php";
require_once $ROOT . "/pos/app/constants/Constants.php";
require_once $ROOT . "/pos/app/invoiceDetailTemp/InvoiceDetailTemp.php";

class Inventory extends Db
{
    public function findInventoryRecords($limit_start = 0, $range = 100, $mode = InventoryModes::WAREHOUSE, $productTypeRecID)
    {
        $table = getTableNameByMode($mode);
        $recID_columnName = getRecIDColumnName($mode);
        $condition = $productTypeRecID ? "AND [ProductTypeRecID] = $productTypeRecID" : '';
        $query = "SELECT [Warehouse]
        ,$recID_columnName AS RecID
        ,[UPC]
        ,[SKU]
        ,[Description] AS ProductName
        ,[DescriptionAR] AS ProductNameAR
        ,[WholesalePrice]
        ,[RetailPrice]
        ,[ProductPackageTypeCode]
        ,[ProductPackageTypeCodeAR]
        ,[StockOnHand]
        FROM $table 
        -- WHERE SalableQuantityMaximum >= 1 $condition
        ORDER BY $recID_columnName
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

    public function findInventoryRecordsBySearchTerm($searchTerm, $limit_start = 0, $range = 100, $mode = InventoryModes::WAREHOUSE)
    {
        $table = getTableNameByMode($mode);
        $recID_columnName = getRecIDColumnName($mode);
        $query = "SELECT [Warehouse]
        ,$recID_columnName AS RecID
        ,[UPC]
        ,[SKU]
        ,[Description] AS ProductName
        ,[DescriptionAR] AS ProductNameAR
        ,[WholesalePrice]
        ,[RetailPrice]
        ,[ProductPackageTypeCode]
        ,[ProductPackageTypeCodeAR]
        ,[StockOnHand]
        FROM $table
        -- WHERE SalableQuantityMaximum >= 1 
        WHERE 
        [ProductName] LIKE '%" . $searchTerm . "%' OR
        [ProductNameAR] LIKE '%" . $searchTerm . "%' OR
        [Description] LIKE '%" . $searchTerm . "%' OR
        [DescriptionAR] LIKE '%" . $searchTerm . "%' OR
        [SKU] LIKE '%" . $searchTerm . "%' OR
        [UPC] LIKE '%" . $searchTerm . "%'
        ORDER BY $recID_columnName
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

    public function findInventoryRecordsByBarcode($barcode, $mode = InventoryModes::WAREHOUSE)
    {
        $table = getTableNameByMode($mode);
        $recID_columnName = getRecIDColumnName($mode);
        $query = "SELECT [Warehouse]
        ,$recID_columnName AS RecID
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
        WHERE [UPC] LIKE '" . $barcode . "' ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findInventoryRecordsByRecID($recID, $mode = InventoryModes::WAREHOUSE)
    {
        $table = getTableNameByMode($mode);
        $recID_columnName = getRecIDColumnName($mode);
        $query = "SELECT [Warehouse]
        ,$recID_columnName AS RecID
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
        WHERE $recID_columnName = ?";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$recID]);
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
        FROM [Emtyaz].[CodeMaster].[ProductType]";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetchAll();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function hasEnoughStock($productRecID, $quantity, $mode)
    {
        $table = getTableNameByMode($mode);
        $recID_columnName = getRecIDColumnName($mode);

        // Query the database to get the current stock quantity for the product with the given RecID.
        $query = "SELECT [StockOnHand], [SalableQuantityMaximum], [WholesalePrice], [CostPrice] FROM $table WHERE $recID_columnName = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$productRecID]);
        $row = $statement->fetch();

        if ($row && isset($row['StockOnHand'])) {
            $currentStock = $row['StockOnHand'];
            $sellableMax = $row['SalableQuantityMaximum'];
            $costPrice = $row['CostPrice'];
            $wholesalePrice = $row['WholesalePrice'];

            // check if the quantity is under sellabla quantity maximum
            if ($wholesalePrice < $costPrice) {
                header('Content-type: application/json');
                echo json_encode(['status' => 'unsuccess', 'type' => 'higher-cost-price']);
                exit();
            }
            else if ($quantity > $sellableMax) {
                header('Content-type: application/json');
                echo json_encode(['status' => 'unsuccess', 'type' => 'exceeds-sellable-max']);
                exit();
            // Check if there is enough stock.
            } else if ($currentStock >= $quantity) {
                return ['status'=> true]; // There is enough stock.
            } else {
                return ['status'=> false, 'StockOnHand'=> $currentStock];
            }
        }

        return false; // Not enough stock.
    }

    public function findSubstituteProductsByBarcode($barcode, $mode = InventoryModes::WAREHOUSE)
    {
        $table = getTableNameByMode($mode);
        $recID_columnName = getRecIDColumnName($mode);
        $query = "SELECT DISTINCT
        psd.ProductSubstituteRecID, 
        priw.$recID_columnName AS RecID,
        priw.Warehouse,
        priw.UPC, 
        priw.SKU, 
        priw.Description AS ProductName, 
        priw.DescriptionAR AS ProductNameAR, 
        priw.WholesalePrice, 
        priw.RetailPrice, 
        priw.ProductPackageTypeCode, 
        priw.ProductPackageTypeCodeAR,
        priw.ProductTypeRecID,
		priw.ProductCategoryRecID,
        priw.StockOnHand
        FROM
            $table AS priw
            INNER JOIN
            Inventory.ProductSubstituteDetail AS psd
            ON 
                priw.$recID_columnName = psd.ProductRecID
        WHERE psd.ProductSubstituteRecID IN 
        ((SELECT
            psd.ProductSubstituteRecID
            FROM Inventory.ProductSubstituteDetail AS psd
            INNER JOIN    
            Inventory.Product AS p
            ON psd.ProductRecID = p.RecID
            WHERE p.UPC = ?)) 
        AND
        priw.UPC <> ?
        AND
        priw.StockOnHand >= 1";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$barcode, $barcode]);
        $resultSet = $statement->fetchAll();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findSubstituteProductsByInvoiceDetailTempRecID($invoiceDetailTempRecID, $mode = InventoryModes::WAREHOUSE)
    {
        $table = getTableNameByMode($mode);
        $recID_columnName = getRecIDColumnName($mode);
        $query = "SELECT DISTINCT
        psd.ProductSubstituteRecID, 
        priw.$recID_columnName AS RecID,
        priw.Warehouse,
        priw.UPC, 
        priw.SKU, 
        priw.Description AS ProductName, 
        priw.DescriptionAR AS ProductNameAR,  
        priw.WholesalePrice, 
        priw.RetailPrice, 
        priw.ProductPackageTypeCode, 
        priw.ProductPackageTypeCodeAR,
        priw.ProductTypeRecID,
		priw.ProductCategoryRecID,
        priw.StockOnHand
        FROM
            $table AS priw
            INNER JOIN
            Inventory.ProductSubstituteDetail AS psd
            ON priw.$recID_columnName = psd.ProductRecID
        WHERE
            psd.ProductSubstituteRecID IN 
            ((SELECT
                    psd.ProductSubstituteRecID
                    FROM Inventory.ProductSubstituteDetail AS psd
                    INNER JOIN
                    Inventory.Product AS p
                    ON psd.ProductRecID = p.RecID
                    WHERE
                        p.RecID = (SELECT
                                    idt.ProductRecID
                                    FROM POS.InvoiceDetailTemporary AS idt
                                    WHERE idt.RecID = ?)
                )) 
            AND
            priw.$recID_columnName <> (SELECT
                            idt.ProductRecID
                            FROM POS.InvoiceDetailTemporary AS idt
                            WHERE idt.RecID = ?)
            AND
            priw.StockOnHand >= 1";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceDetailTempRecID, $invoiceDetailTempRecID]);
        $resultSet = $statement->fetchAll();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }
}
