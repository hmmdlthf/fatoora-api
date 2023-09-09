<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class InvoiceTemp extends Db
{
    public function findById($recId)
    {
        $query = "SELECT
        [RecID]
        ,[TotalSubTotal]
        ,[TotalVATAmount]
        ,[GrandTotal]
        ,[BalanceAmount]
        FROM [saudipos].[POS].[InvoiceTemporary]
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

    public function create()
    {
        $query = "INSERT INTO [saudipos].[POS].[InvoiceTemporary] OUTPUT Inserted.RecID DEFAULT VALUES";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function updateTotals($recId, $totalSubTotal, $totalVATAmount, $grandTotal, $balanceAmount)
    {
        $query = "UPDATE [saudipos].[POS].[InvoiceTemporary]
              SET [TotalSubTotal] = ?,
                  [TotalVATAmount] = ?,
                  [GrandTotal] = ?,
                  [BalanceAmount] = ?
              WHERE [RecID] = ?";

        $statement = $this->connect()->prepare($query);
        $result = $statement->execute([$totalSubTotal, $totalVATAmount, $grandTotal, $balanceAmount, $recId]);

        return $result;
    }

    public function delete($recId)
    {
        $query = "DELETE FROM [saudipos].[POS].[InvoiceTemporary] WHERE [RecID] = ?";

        $statement = $this->connect()->prepare($query);
        $result = $statement->execute([$recId]);

        return $result;
    }

    public function calculateTotalsAndUpdate($recId)
    {
        $invoiceDetailTemp = new InvoiceDetailTemp(); 

        // Calculate the new totals
        $invoiceDetailRecords = $invoiceDetailTemp->findAllByInvoiceRecID($recId); // Retrieve related InvoiceDetailTMP records
        $totalSubTotal = 0;
        $totalVATAmount = 0;
        $grandTotal = 0;
        $balanceAmount = 0;

        foreach ($invoiceDetailRecords as $record) {
            $totalSubTotal += $record['TotalAmount'];
            $VATAmount = $record['TotalAmount'] * 0.15;
            $totalVATAmount += $VATAmount; // Assuming 15% VAT
            $grandTotal += $record['TotalAmount'] + $VATAmount;
        }

        $results = $this->updateTotals($recId, $totalSubTotal, $totalVATAmount, $grandTotal, $balanceAmount);

        return $results;
    }

    public function updateTotalsIncremental($recId, $totalAmountChange)
    {
        // Check if the record exists
        $existingRecord = $this->findById($recId);
        if ($existingRecord === false) {
            return false; // Record not found
        }

        // Incrementally update the totals
        $totalSubTotal = $existingRecord['TotalSubTotal'] + $totalAmountChange;
        // Calculate VAT amount based on your logic
        $VATAmount = $totalAmountChange * 0.15; // Assuming 15% VAT
        $totalVATAmount = $existingRecord['TotalVATAmount'] + $VATAmount;
        $grandTotal = $existingRecord['GrandTotal'] + $totalAmountChange + $VATAmount;
        $balanceAmount = $existingRecord['BalanceAmount'] + $grandTotal;

        $results = $this->updateTotals($recId, $totalSubTotal, $totalVATAmount, $grandTotal, $balanceAmount);

        return $results;
    }
}
