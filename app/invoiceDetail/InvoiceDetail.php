<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

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
}
