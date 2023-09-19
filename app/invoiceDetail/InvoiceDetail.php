<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/pos/vendor/autoload.php';
require_once $ROOT . "/pos/app/database/Db.php";

class InvoiceDetail extends Db
{
    public function findAllByInvoiceRecID($invoiceRecID)
    {
        $query = "SELECT 
                RecordNumber, 
                Barcode, 
                ProductFullName, 
                ProductFullNameAR, 
                OrderQuantity, 
                UnitAmountVAT, 
                TotalAmount, 
                UPCTypeRecID 
                FROM POS. V_InvoiceDetail 
                WHERE InvoiceRecID = ? and StatusRecID =1";

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
        $query = "SELECT [RecordNumber]
        ,vidt.[InvoiceDetailRecID]
        ,vidt.[InvoiceRecID]
        ,vidt.[Barcode]
        ,vidt.[ProductRecID]
        ,vidt.[ProductFullName]
        ,vidt.[ProductPackageTypeRecID]
        ,vidt.[ProductPackageTypeCodeAR]
        ,vidt.[OrderQuantity]
        ,vidt.[UnitAmount]
        ,vidt.[WholesalePrice]
        ,vidt.[TotalAmount]
        ,idt.[PriceTypeRecID]
        FROM [saudipos].[POS].[V_InvoiceDetail] vidt
        INNER JOIN [saudipos].[POS].[InvoiceDetail] idt ON vidt.InvoiceRecID = idt.RecID
        WHERE vidt.InvoiceRecID = ? 
        ORDER BY idt.RecID DESC";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceRecID]);
        $result = $statement->fetchAll();

        if ($result > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function deleteAllByInvoiceNumber($invoiceNumber)
    {
        $query = "DELETE FROM [saudipos].[POS].[InvoiceDetail]
        WHERE [saudipos].[POS].[InvoiceDetail].[InvoiceRecID] = 
            (SELECT [RecID] FROM [saudipos].[POS].[Invoice] WHERE [InvoiceNumber] = ?)";

        $statement = $this->connect()->prepare($query);
        $statement->execute([$invoiceNumber]);

        return true;
    }
}
